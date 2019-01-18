<?php
namespace Mf\Kabinet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController 
{
    
    /**
     * User manager.
     */
    protected $userManager;
    
    /**
     * Constructor. 
     */
    public function __construct($userManager)
    {
        $this->userManager = $userManager;
    }
    
    /**
     * вывод страницы с кабинетом
     */
    public function indexAction() 
    {
        $view=new ViewModel;
        if (!$this->user()->identity()){
            /*выводим шаблон аутенификации, мы не вошли*/
            $view->setTemplate("mf/kabinet/index/login");
        }

        return $view;
    } 
    /**
     * вывод под страницы с профилем
     */
    public function profileAction() 
    {

        return new ViewModel();
    } 


}


