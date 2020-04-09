<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Employee;

use Employee\Controller\IndexController;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Predicate\In;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements configProviderInterface
{
    public function getConfig() : array
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * @return array
     */
    public function getServiceConfig(): array
    {
        return [
            'factories' => [
                Modal\EmployeeTable::class => function($container) {
                    $tableGateway = $container->get(Modal\EmployeeTableGateway::class);

                    return new Modal\EmployeeTable($tableGateway);
                },
                Modal\EmployeeTableGateway::class => function($container) {
                    $adapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Modal\Employee);
                    return new tableGateway('employee', $adapter, null, $resultSetPrototype);
                }
            ]
        ];
    }

    /**
     * @return array
     */
    public function getControllerConfig(): array
    {
        return [
            'factories' => [
                Controller\IndexController::class => function($container) {
                    return new Controller\IndexController($container->get(Modal\EmployeeTable::class));
                }
            ]
        ];
    }
}
