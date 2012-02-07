<?php

class Application_Form_Register extends Zend_Form
{

    public function init()
    {

        parent::init();
        $this->setName('registerForm');

        // сообщение о незаполненном поле
        $isEmptyMessage = 'Обовязкове поле.Необхідно заповнити';


        // создаём текстовый элемент
        $useremail = new Zend_Form_Element_Text('email');

        // задаём ему label и отмечаем как обязательное поле;
        // также добавляем фильтры и валидатор с переводом
        $useremail->setLabel('E-mail');
        $useremail->setName('email');
        $useremail->setRequired(true);
        $useremail->addFilter('StripTags');
        $useremail->addFilter('StringTrim');
        $useremail->addValidator('EmailAddress', true);
        $useremail->addValidator('Db_NoRecordExists', true, array('table' => 'users', 'field' => 'email'));


        //пароль користувача
        $userpassword = new Zend_Form_Element_Password('userpassword');
        $userpassword->setLabel('Пароль')
                ->setRequired('true')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty', true, array('messages' => array('isEmpty' => $isEmptyMessage)));


        //пароль користувача ще раз
        $userpassword2 = new Zend_Form_Element_Password('userpassword2');
        $userpassword2->setLabel('Пароль ще раз')
                ->setRequired('true')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('Identical', true, array('userpassword'));


        //firstname
        $firstname = new Zend_Form_Element_Text('firstname');
        $firstname->setLabel('Ім\'я')
                //->setRequired('true')
                ->addFilter('StripTags')
                ->addFilter('StringTrim');
        //->addValidator('NotEmpty', true,array('messages' => array('isEmpty' => $isEmptyMessage)));        
        //lastname
        $lastname = new Zend_Form_Element_Text('lastname');
        $lastname->setLabel('Фамілія')
                //->setRequired('true')
                ->addFilter('StripTags')
                ->addFilter('StringTrim');
        //->addValidator('NotEmpty', true,array('messages' => array('isEmpty' => $isEmptyMessage))); 

        $captcha = new Zend_Form_Element_Captcha('captcha', array(
                    'label' => "Введите символы:",
                    'captcha' => array(
                        'captcha' => 'Image', // Тип CAPTCHA
                        'wordLen' => 4,
                        'width' => 260,
                        'timeout' => 120,
                        'expiration' => 300,
                        'font' => '/fonts/arial.ttf',
                        'imgDir' => '/images/captcha/',
                        'imgUrl' => '/images/captcha/',
                        'gcFreq' => 5
                    ),
                ));


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Зареєструватися');

        //кнопка експорту даних з контактів
        $button_export_vk = new Zend_Form_Element_Button('button_export_vk');
        $button_export_vk->setAttrib('title', 'експортувати дані з vkontakte.ru')
                ->setAttrib('onclick', 'VK.Auth.login(authInfo);');

        //експорт з фесбука
        $button_export_fc = new Zend_Form_Element_Button('button_export_fc');
        $button_export_fc->setAttrib('title', 'експортувати дані з facebook.com');


        $this->addDisplayGroup(
                array($useremail, $userpassword, $userpassword2), 'registerDataGroup', array('legend' => 'Дані Реєстації')
        );
        $this->addDisplayGroup(
                array($button_export_vk, $button_export_fc, $firstname, $lastname,), 'registerPrivateDataGroup', array('legend' => 'Ваші персональні дані')
        );


        // добавляем элементы в форму
        $this->addElements(array(/* $captcha, */$submit));



        // указываем метод передачи данных
        $this->setMethod('post');
    }

}

