<?php

namespace Application\Form;

use Laminas\Form\Element\Button;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

/**
 * Class Login
 * @package Application\Form
 */
class Login extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct('Login');
        $this->setAttributes([
            'method' => 'POST'
        ]);

        $username = new Text('username');
        $username->setOptions([
                'required' => true
            ])
            ->setAttributes([
                'required' => 'required',
                'class' => 'form-control fadeIn second',
                'placeholder' => 'User Name'
            ]);

        $password = new Password('password');
        $password->setOptions([
                'required' => true
            ])
            ->setAttributes([
                'required' => 'required',
                'class' => 'form-control fadeIn third',
                'placeholder' => 'Password'
            ]);

        $submit = new Button('submit');
        $submit->setAttributes([
            'type' => 'submit',
            'class' => 'btn btn-outline-success fadeIn fourth'
        ]);

        $this->add($username)
            ->add($password)
            ->add($submit)
        ;
    }
}