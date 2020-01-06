<?php
namespace Mf\Kabinet\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Mf\Users\Service\UserManager;

use Laminas\Validator\Translator\TranslatorInterface;

class ResetPasswordControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        $userManager = $container->get(UserManager::class);
        $translator = $container->get(TranslatorInterface::class);

        return new $requestedName($userManager,$config,$translator);
    }
}