<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vkontakte
 *
 * @author Kolya
 */
class Application_Model_Vkontakte extends App_Vkapi
{

    //Отримати інформацію про уокристувача
    public function getUserInfo($vkId)
    {
        $resp = $this->api('getProfiles', array('uids' => $vkId, 'fields' => 'first_name, photo_medium'));
        return $resp['response'][0];
    }

    
    //Отримати записи на стіні
    public function getUserWall($vkId)
    {
        $resp = $this->api('wall.get', array('owner_id' => $vkId, 'count' => '7','extendent'=>'1'));

        return $resp['response'];
    }

}

