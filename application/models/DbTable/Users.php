<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{

    //імя 
    protected $_name = 'users';

    //реэстрація користувача
    public function registerUser($useremail, $password, $firstname, $lastname, $sig)
    {
        //Створюємо масив для запису в БД 
        $date = date("Y-m-d");
        $data = array(
            'email' => $useremail,
            'password' => $password,
            'registerDate' => $date,
            'firstName' => $firstname,
            'lastname' => $lastname,
            'Activation' => $sig
        );

        //записуєм дані в таблицю
        $this->insert($data);
    }

    public function perevirkaSig($useremail, $sig)
    {

        //Створюємо масив для запису в БД 
        $data = array('Activation' => 'true');

        //задаємо умову скюл запиту
        $where = "email like '$useremail' and Activation like '$sig'";

        //оновлюєм записи в базі даних
        return $this->update($data, $where);
    }

    public function test()
    {
        
    }

}

