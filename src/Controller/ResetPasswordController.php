<?php
namespace Mf\Kabinet\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Mail;
use Laminas\Mime\Message as MimeMessage;
use Laminas\Mime\Mime;
use Laminas\Mime\Part as MimePart;
use Locale;
use Laminas\Form\Factory;
use Exception;
use Mf\Users\Exception as UsersException;
use Laminas\Validator\AbstractValidator;






class ResetPasswordController extends AbstractActionController 
{
    
    protected $translator;
    
    protected $userManager;
    protected $config;
    protected $locale_default;
    protected $email_robot;
    protected $admin_emails=[];
    protected $captchaAdapter;
    protected $captchaAdapterOptions;
    
    public function __construct( $userManager,$config,$translator)
    {

        $this->userManager = $userManager;
        $this->config=$config["kabinet"];
        $this->translator=$translator;
        AbstractValidator::setDefaultTranslator($translator);
        $this->locale_default=$config["locale_default"];
        $this->email_robot=$config["email_robot"];
        $this->admin_emails=$config["admin_emails"];
        
        $this->captchaAdapterOptions=$config["captcha"]["options"][$config["captcha"]["adapter"]];
        $this->captchaAdapter= "\\".$config["captcha"]["adapter"];
    }
    
    
    /**
     * Сброс пароля, путем генерации временного и записи его в спец поле таблицы, 
     * юзеру отправляется письмо из "стат-страниц" 
     */
    public function indexAction()
    {
        $locale=$this->params('locale',$this->locale_default);
        $this->translator->setLocale(Locale::getPrimaryLanguage($locale));
        
        $prg = $this->prg();
        if ($prg instanceof Response) {
            //сюда попадаем когда форма отправлена, производим редирект
            return $prg;
        }

        $view=new ViewModel();
        $view->setTemplate($this->config["tpl"]["reset_password"]);
        $alertMessage=null;
        $alert_type="success";
        /*если у нас AJAX запрос, отключим вывод макета*/
        $view->setTerminal($this->getRequest()->isXmlHttpRequest());

        //форма авторизации
        $factory = new Factory();
        $form    = $factory->createForm(include $this->config["forma_reset"]);
        
        if ($prg === false){
          //вывод страницы и формы
          $view->setVariables(["form"=>$form,"alertMessage"=>$alertMessage,"alert_type"=>$alert_type]);
          return $view;
        }
        $form->setData($prg);

        if($form->isValid()) {
            $data = $form->getData();
            

            try  {
                $temp_pass=$this->userManager->PasswordReset($data['login']);
                $alertMessage="Вам на E-mail отправлено сообщение с инструкциями по восстановлению пароля";

                /*текст письма юзеру*/
                $mess=$this->Statpage("RESET_PASSWORD",["pageType"=>3,"errMode"=>"exception"]);
                
                /*адрес сервера-сайта*/
                $httpHost = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost';
                $mess=str_replace("{SERVER}",$httpHost,$mess);
                $mess=str_replace("{PASSWORD}",$temp_pass,$mess);

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
                $mail->setSubject('Password Reset');
                $transport = new Mail\Transport\Sendmail();
                $transport->send($mail);
                $form->setData(["login"=>""]);

            } catch (UsersException\NotFoundException $e){
                  $alertMessage="Такого пользователя не существует";
                  $alert_type="danger";
            }
            
              catch (Exception $e) {
                  $alertMessage="Что-то пошло не так: ".$e->getMessage();
                  $alert_type="danger";
              }
        }

        $view->setVariables(["form"=>$form,"alertMessage"=>$alertMessage,"alert_type"=>$alert_type]);
        return $view;
    }
    
}


