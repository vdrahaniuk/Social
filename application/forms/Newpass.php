<?php

class Application_Form_Newpass extends Zend_Form
{

    public function init()
    {
        $this->setName('newpass');

        $isEmptyMessage = 'Обовязкове поле.Необхідно заповнити';

        $password = new Zend_Form_Element_Password('password');

        $password->setLabel('New password:')
                ->setRequired(true)
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty', true, array('messages' => array('isEmpty' => $isEmptyMessage)));

        $repassword = new Zend_Form_Element_Password('repassword');

        $repassword->setLabel('Повторіть пароль:')
                ->setRequired(true)
                ->addFilter('StringTrim');
            //    ->addValidator('EqualInputs', true, array('password'));


        $submit = new Zend_Form_Element_Submit('newpass');

        $submit->setLabel('Зберегти');

        $this->addElements(array($password, $repassword, $submit));
        echo $code;
        $this->setMethod('post');
    }

}

