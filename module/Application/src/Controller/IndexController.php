<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application\Controller;

use Application\Form\Login;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * Login action
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $form = new Login();
        $request = $this->getRequest();

        // Show form
        if (!$request->isPost()) {
            return new ViewModel([
                'form' => $form
            ]);
        }

        $form->setData($request->getPost());

        if (!$form->isValid()) {
            exit("invalid form");
        }

        return $this->redirect()->toRoute('employee', ['controller' => 'index', 'action' => 'index']);
    }
}
