<?php

class Application_Form_Lostpass extends Zend_Form
{

    public function init()
    {
        $this->setName('lostpass');

        $isEmptyMessage = 'Обовязкове поле.Необхідно заповнити';

        $userename = new Zend_Form_Element_Text('userename');

        $userename->setLabel('E-mail:')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('Db_RecordExists', true, array('table' => 'users', 'field' => 'email'))
                ->addValidator('EmailAddress', true)
                ->addValidator('NotEmpty', true, array('messages' => array('isEmpty' => $isEmptyMessage))
        );
        $submit = new Zend_Form_Element_Submit('login');

        $submit->setLabel('Відправити');

        $this->addElements(array($userename, $submit));

        $this->setMethod('post');
    }

}
