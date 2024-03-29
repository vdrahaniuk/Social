<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_helper->redirector('login', 'auth');
        }
        $userData = $auth->getStorage()->Read();
        $userId = $userData->id;

        $database = new Application_Model_DbTable_Users();

        $userinfo = $database->fetchRow("`id`='$userId'");

        $this->view->firstname = $userinfo->firstName;
        $this->view->lastname = $userinfo->lastName;

        $this->view->headTitle('Соціальні мережі');
        $this->view->title = 'Головна сторінка';


        $vkontakte = new Application_Model_Vkontakte('2782001', '07Gp7JrZGWRoItScuSBU');

        $database = new Application_Model_DbTable_Users();

        $vkId = $userinfo->vkId;
        $vkInfo = $vkontakte->getUserinfo($vkId);

        $this->view->avatar = $vkInfo['photo_medium'];

        $this->view->vkWall = $vkontakte->getUserWall($vkId);

        print_r($this->view->vkWall);
    }

}