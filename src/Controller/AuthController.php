<?php

namespace Mf\Kabinet\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Authentication\Result;
use Locale;
use Laminas\Form\Factory;
use Exception;
use Laminas\Validator\AbstractValidator;

/**
 * контроллер выводящий форму аутентификация и собственно сама аутентификация при помощи сервиса
 */
class AuthController extends AbstractActionController
{
    
    /**
    * менеджер авторизации
     */
    protected $authManager;
    
    protected $translator;
    
    /**
    * config - модуля (секция kabinet)
    */
    protected $config;
    protected $locale_default;
    protected $email_robot;
    protected $admin_emails=[];


    public function __construct($authManager,$config,$translator)
    {
        $this->authManager = $authManager;
        $this->config=$config["kabinet"];
        $translator->setLocale("ru");       //ставим ru, пока нет поддержки мультиязычности
        $this->translator=$translator;
        AbstractValidator::setDefaultTranslator($translator);
        $this->locale_default=$config["locale_default"];
        $this->email_robot=$config["email_robot"];
        $this->admin_emails=$config["admin_emails"];

    }
    
    /**
     * вывод формы авторизации и обработка информации из нее (POST)
     */
    public function loginAction()
    {
        $locale=$this->params('locale',$this->locale_default);
        $this->translator->setLocale(Locale::getPrimaryLanguage($locale));
        
        
        $prg = $this->prg();
        if ($prg instanceof Response) {
            //сюда попадаем когда форма отправлена, производим редирект
            return $prg;
        }

        $view=new ViewModel(["routeNameAfterLogin"=>$this->config["routeNameAfterLogin"]]);
        $view->setTemplate($this->config["tpl"]["login"]);
        /*если у нас AJAX запрос, отключим вывод макета*/
        $view->setTerminal($this->getRequest()->isXmlHttpRequest());

        $alertMessage=null;
        $alert_type="success";

        //форма авторизации
        $factory = new Factory();
        $form    = $factory->createForm(include $this->config["forma_login"]);

        
        if ($prg === false){
          //вывод страницы и формы
          $view->setVariables(["form"=>$form,"alertMessage"=>$alertMessage,"alert_type"=>$alert_type]);
          return $view;
        }

        $form->setData($prg);        
        //данные валидные?
        if($form->isValid()) {
            $data = $form->getData();
            $result = $this->authManager->login($data['login'], $data['password'], $data['remember_me']);

            //авторизовался нормально?
            if ($result->getCode() != Result::SUCCESS) {
                $alertMessage="Неверный логин/пароль";
                $alert_type="danger";
                $view->setVariable("lost_password",1);
            }                
        } else {
            $alertMessage="Ошибка";
            $alert_type="danger";
        }
        
        $view->setVariables(["form"=>$form,"alertMessage"=>$alertMessage,"alert_type"=>$alert_type]);
        return $view;
    }
    
    /**
     * The "logout" action performs logout operation.
     */
    public function logoutAction() 
    {        
        $this->authManager->logout();
        
        return $this->redirect()->toRoute('kabinet');
    }
}
