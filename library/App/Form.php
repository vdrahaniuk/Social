<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form
 *
 * @author Колян
 */
class App_Form extends Zend_Form
{

    /**
     * Инициализация формы
     * 
     * return void
     */
    public function init()
    {
        // Вызов родительского метода
        parent::init();

        // Создаем объект переводчика, он нам необходим для перевода сообщений об ошибках.
        // В качестве адаптера используется php массив
        $translator = new Zend_Translate('array', 'languages/errors.php');

        // Задаем объект переводчика для формы
        $this->setTranslator($translator);

        /* Задаем префиксы для самописных элементов, валидаторов, фильтров и декораторов.
          Благодаря этому Zend_Form будет знать где искать наши самописные элементы */
        //$this->addElementPrefixPath('App_Validate', 'App/Validate/', 'validate');
        //$this->addElementPrefixPath('App_Filter', 'App/Filter/', 'filter');
        //$this->addElementPrefixPath('App_Form_Decorator', 'App/Form/Decorator/', 'decorator');
    }

}

?>
