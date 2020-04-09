<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Employee\Controller;

use Employee\Form\EmployeeForm;
use Employee\Modal\Employee;
use Laminas\Form\FormInterface;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * Employee list action
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $employees = $this->table->fetchAll();

        return new ViewModel([
            'employees' => $employees
        ]);
    }

    /**
     * Create new employee
     *
     */
    public function createAction()
    {
        $form = new EmployeeForm();
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

        $employee = new Employee();
        $employee->exchangeArray($form->getData());
        $this->table->insertModel($employee);

        return $this->redirect()->toRoute('employee', ['controller' => 'index', 'action' => 'index']);
    }

    /**
     * View employee action
     *
     * @return ViewModel
     */
    public function viewAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id === 0) {
            return $this->notFoundAction();
        }

        try {
            $employee = $this->table->fetchById($id);
        } catch (\Exception $exception) {
            return $this->notFoundAction();
        }

        return new ViewModel([
            'employee' => $employee
        ]);
    }

    /**
     * Edit employee action
     */
    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if ($id === 0) {
            return $this->notFoundAction();
        }

        try {
            $employee = $this->table->fetchById($id);
        } catch (\Exception $exception) {
            return $this->notFoundAction();
        }

        $form = new EmployeeForm();
        $form->bind($employee);
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel([
                'form' => $form
            ]);
        }

        $form->setData($request->getPost());

        if (!$form->isValid()) {
            exit("invalid form");
        }

        $employee = new Employee();
        $employee->exchangeArray($form->getData(FormInterface::VALUES_AS_ARRAY));
        $this->table->updateModel($employee);

        return $this->redirect()->toRoute('employee', ['controller' => 'index', 'action' => 'index']);
    }
}
