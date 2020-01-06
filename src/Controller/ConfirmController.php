<?php

namespace Mf\Kabinet\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Exception;

/**
 * контроллер подтверждения регистрации
 */
class ConfirmController extends AbstractActionController
{
    
    protected $userManager;
    
    public function __construct($userManager)
    {
        $this->userManager = $userManager;
    }
    
    /**
     * 
     */
    public function indexAction()
    {
        
        try{
            $confirm=$this->params('confirm',"");
            $this->userManager->userConfirm($confirm);

        } catch (Exception $e){
            /*любая ошибка - 404*/
            $this->getResponse()->setStatusCode(404);
        }
        
        
        
    }
    
}
