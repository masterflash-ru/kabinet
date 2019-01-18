<?php
namespace Mf\Kabinet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use ADO\Service\RecordSet;
use ADO\Service\Command;
use Mf\Users\Entity\Users;
use Zend\Mail;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Mime;
use Zend\Mime\Part as MimePart;
use Locale;
use Zend\Form\Factory;
use Exception;
use Zend\Validator\AbstractValidator;





class UserController extends AbstractActionController 
{
    
    protected $translator;
    
    protected $userManager;
    protected $config;
    protected $locale_default;
    protected $email_robot;
    protected $admin_emails=[];
    protected $captchaAdapter;
    protected $captchaAdapterOptions;
    
    public function __construct($connection, $userManager,$config,$translator)
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
     * вывод формы авторизации и обработка информации из нее (POST)
     */
    public function profileAction()
    {
        $locale=$this->params('locale',$this->locale_default);
        $this->translator->setLocale(Locale::getPrimaryLanguage($locale));
        
        $prg = $this->prg();
        if ($prg instanceof Response) {
            //сюда попадаем когда форма отправлена, производим редирект
            return $prg;
        }

        $view=new ViewModel();
        $alertMessage=null;
        $alert_type="success";
        /*если у нас AJAX запрос, отключим вывод макета*/
        $view->setTerminal($this->getRequest()->isXmlHttpRequest());

        //форма авторизации
        $factory = new Factory();
        $form    = $factory->createForm(include $this->config["forma_profile"]);
        
        if ($prg === false){
          //вывод страницы и формы
            //заполним форму данными из базы
            try{
                $user_profile=$this->userManager->GetUserIdInfo($this->user()->getUserId())->toArray();
                $form->setData($user_profile);
            } catch (Exception $e){
                $alertMessage="Ошибка чтения".$this->user()->getUserId();
                $alert_type="danger";
            }
            
          $view->setVariables(["form"=>$form,"alertMessage"=>$alertMessage,"alert_type"=>$alert_type]);
          return $view;
        }

        $form->setData($prg);        
        //данные валидные?
        if($form->isValid()) {
            try{
            $this->userManager->updateUserInfo ($this->user()->getUserId(),$form->getData());
            $alertMessage="Информация успешно обновлена";
            } catch (Exception $e){
                $alertMessage="Ошибка чтения";
                $alert_type="danger";
            }
        } else {
            $alertMessage="Ошибка обновления информации";
            $alert_type="danger";
        }
    
        $view->setVariables(["form"=>$form,"alertMessage"=>$alertMessage,"alert_type"=>$alert_type]);
        return $view;
    }
    
}

