<?php
namespace Mf\Kabinet\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController 
{
    
    /**
     * config kabinet
     */
    protected $config;
    
    /**
     * Constructor. 
     */
    public function __construct($config)
    {
        $this->config = $config;
    }
    
    /**
     * вывод страницы с кабинетом
     */
    public function indexAction() 
    {
        
        if (!$this->user()->identity()){
            $view=new ViewModel(["config"=>$this->config["tabs_login"]]);
            
        } else {
            $view=new ViewModel(["config"=>$this->config["tabs"]]);
        }
        $view->setTemplate($this->config["tpl"]["index"]);
        return $view;
    } 

}


