<?php

namespace Mf\Kabinet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Locale;
use Zend\Mail;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Mime;
use Zend\Mime\Part as MimePart;
use Zend\Form\Factory;
use Exception;
use Mf\Users\Exception as UsersException;
use Zend\Validator\AbstractValidator;

/**
 * контроллер выводящий форму аутентификация и собственно сама аутентификация при помощи сервиса
 */
class RegistrationController extends AbstractActionController
{
    
    protected $userManager;
    
    protected $translator;
    
    protected $config;
    protected $locale_default;
    protected $email_robot;
    protected $admin_emails=[];
    protected $ServerDefaultUri;


    public function __construct($userManager,$config,$translator)
    {
        $this->userManager = $userManager;
        $this->config=$config["kabinet"];
        $this->ServerDefaultUri=$config["ServerDefaultUri"];
        $translator->setLocale("ru");       //ставим ru, пока нет поддержки мультиязычности
        $this->translator=$translator;
        AbstractValidator::setDefaultTranslator($translator);
        $this->locale_default=$config["locale_default"];
        $this->email_robot=$config["email_robot"];
        $this->admin_emails=$config["admin_emails"];

    }
    
    /**
     * вывод формы  обработка информации из нее (POST)
     */
    public function indexAction()
    {
        $locale=$this->params('locale',$this->locale_default);
        $this->translator->setLocale(Locale::getPrimaryLanguage($locale));
        
        /*проверим авторизован ли юзер?
        *вариант когда аутентифицированный опять заходит на форму входа
        */
        if ($this->user()->identity()){
            //да, переходим на страницу после авторизации, из конфига
            
        }

        $prg = $this->prg();
        if ($prg instanceof Response) {
            //сюда попадаем когда форма отправлена, производим редирект
            return $prg;
        }

        $view=new ViewModel(["routeNameAfterLogin"=>$this->config["routeNameAfterLogin"]]);
        /*если у нас AJAX запрос, отключим вывод макета*/
        $view->setTerminal($this->getRequest()->isXmlHttpRequest());

        $alertMessage=null;
        $alert_type="success";

        //форма авторизации
        $factory = new Factory();
        $form    = $factory->createForm(include $this->config["forma_registration"]);

        
        if ($prg === false){
          //вывод страницы и формы
          $view->setVariables(["form"=>$form,"alertMessage"=>$alertMessage,"alert_type"=>$alert_type]);
          return $view;
        }

        $form->setData($prg);        
        //данные валидные?
        if($form->isValid()) {
            $data = $form->getData();
             try  {
                 /*сама регистрация*/
                 $user=$this->userManager->addUser($data);

                $alertMessage="Вам на E-mail отправлено письмо с инструкциями";

                /*текст письма юзеру*/
                $mess=$this->Statpage("USER_REGISTRATION",["pageType"=>3,"errMode"=>"exception"]);
                
                /*адрес для подтверждения регистрации*/
                $confirm = $this->ServerDefaultUri.$this->url()->fromRoute("confirm",["confirm"=>$user->getConfirm_hash()]);
                $mess=str_replace("{CONFIRM}",$confirm,$mess);
                

                $text           = new MimePart($mess);
                $text->type     = Mime::TYPE_HTML;
                $text->charset  = 'utf-8';
                $text->encoding = Mime::ENCODING_QUOTEDPRINTABLE;
                $body = new MimeMessage();
                $body->setParts([ $text]);
                
                $mail = new Mail\Message();
                $mail->setEncoding("UTF-8");
                $mail->setBody($body);
                $mail->setFrom($this->email_robot);
                $mail->addTo($data['login']);
                $mail->setSubject('Registration');
                $transport = new Mail\Transport\Sendmail();
                $transport->send($mail);
                $form->setData(array_fill_keys(array_keys($data),""));

             } catch (UsersException\AlreadyExistException $e){
                  $alertMessage="Вы уже зарегистрированы";
                  $alert_type="danger";
               } catch (Exception $e) {
                  $alertMessage="Что-то пошло не так: ".$e->getMessage();
                  $alert_type="danger";
              }

        } else {
            $alertMessage="Ошибка";
            $alert_type="danger";
        }
        
        $view->setVariables(["form"=>$form,"alertMessage"=>$alertMessage,"alert_type"=>$alert_type]);
        return $view;
    }
    
}
