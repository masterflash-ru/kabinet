<?php

namespace Mf\Kabinet\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Exception;

/**
 * контроллер подтверждения регистрации
 */
class ConfirmController extends AbstractActionController
{
    
    protected $userManager;
    
    protected $locale_default;



    public function __construct($userManager)
    {
        $this->userManager = $userManager;
    }
    
    /**
     * 
     */
    public function indexAction()
    {
    }
    
}
