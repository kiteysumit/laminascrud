<?php

namespace Employee\Form;

use Employee\Modal\Employee;
use Laminas\Form\Element\Button;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\MultiCheckbox;
use Laminas\Form\Element\Radio;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

/**
 * Class EmployeeForm
 * @package Employee\Form
 */
class EmployeeForm extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct('Employee');
        $this->setAttributes([
            'method' => 'POST'
        ]);

        $id = new Hidden('id');

        $firstName = new Text('firstName');
        $firstName->setLabel('First Name:')
            ->setOptions([
                'required' => true
            ])
            ->setAttributes([
                'required' => 'required',
                'class' => 'form-control'
            ]);

        $lastName = clone $firstName;
        $lastName->setName('lastName')
            ->setLabel('Last Name:');

        $gender = new Radio('gender');
        $gender->setLabel('Gender:')
            ->setAttributes([
                'required' => 'required',
                'class' => 'form-check-input',
                'separator' => '</div><div class="form-check form-check-inline">'
            ])
            ->setLabelAttributes([
                'class' => 'form-check-label ml-2'
            ])
            ->setValueOptions(Employee::GENDER_LIST);

        $birthDate = clone $firstName;
        $birthDate->setName('birthDate')
            ->setLabel('Date of Birth:');

        $department = new Select('department');
        $department->setLabel('Department:')
            ->setOptions([
                'required' => true
            ])
            ->setAttributes([
                'required' => 'required',
                'class' => 'form-control'
            ])
            ->setValueOptions(Employee::DEPARTMENT_LIST);

        $skills = new MultiCheckbox('skills');
        $skills->setLabel('Skills:')
            ->setAttributes([
                'class' => 'form-check-input',
                'separator' => 'ddd'
            ])
            ->setLabelAttributes([
                'class' => 'form-check-label ml-5'
            ])
            ->setOption('separator', '</div><div class="form-check form-check-inline">')
            ->setValueOptions(Employee::SKILL_LIST);;

        $submit = new Button('submit');
        $submit->setAttributes([
            'type' => 'submit',
            'class' => 'btn btn-outline-success float-right'
        ]);

        $this->add($id)
            ->add($firstName)
            ->add($lastName)
            ->add($gender)
            ->add($birthDate)
            ->add($department)
            ->add($skills)
            ->add($submit)
        ;
    }
}
