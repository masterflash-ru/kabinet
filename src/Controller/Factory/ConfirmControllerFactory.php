<?php
namespace Mf\Kabinet\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Mf\Users\Service\UserManager;


class ConfirmControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $userManager = $container->get(UserManager::class);
        return new $requestedName($userManager);
    }
}