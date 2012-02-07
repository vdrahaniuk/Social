<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {

        $this->setName('login');
        $isEmptyMessage = 'Обовязкове поле.Необхідно заповнити';

        $username = new Zend_Form_Element_Text('username');

        $username->setLabel('E-mail:')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty', true, array('messages' => array('isEmpty' => $isEmptyMessage))
        );

        $password = new Zend_Form_Element_Password('password');

        $password->setLabel('Пароль:')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty', true, array('messages' => array('isEmpty' => $isEmptyMessage))
        );

        $submit = new Zend_Form_Element_Submit('login');
        $submit->setLabel('Увійти');

        $this->addElements(array($username, $password, $submit));

        $this->setMethod('post');
    }

}