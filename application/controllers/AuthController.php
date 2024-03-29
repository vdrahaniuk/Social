<?php

class AuthController extends Zend_Controller_Action {

    public function init()
    {
        /* Initialize action controller here */
    }

   
    public function indexAction() {

    }

    public function registerAction() {
        $this->view->headTitle('Реєстрація');
        $this->view->title = 'Реєстрація';

        print_r($_SERVER);

        //Створюємо форму
        $formRegister = new Application_Form_Register();

        //перевіряем чи є запит
        if ($this->_request->isPost()) {
            //записуєм в змінну дані запиту
            $formData = $this->getRequest()->getPost();

            //перевірка на валідність
            if ($formRegister->isValid($formData)) {

                //Зчитуємо логін і пароль і запиту
                $password = md5($formRegister->getValue('userpassword'));
                $useremail = $formRegister->getValue('email');
                $firstname = $formRegister->getValue('firstname');
                $lastname = $formRegister->getValue('lastname');

                //ініціалізація класу доступу до бд
                $database = new Application_Model_DbTable_Users();

                //створюємо ключ
                $sig = md5(uniqid(rand(), true));


                //реєструємо
                $database->registerUser($useremail, $password, $firstname, $lastname, $sig);



                //відправка емайлу
                $sendmail = new Zend_Mail('UTF-8');
                $sendmail->setBodyText("активація користувача для активації пройдіть по ссилці
                                http://myproject/auth/recover/?sig=$sig&mail=$useremail
                    ");
                $sendmail->setFrom('administrator@myproject', 'administrator');
                $sendmail->addTo($useremail);
                $sendmail->setSubject('Реєстрація на нашому сайті');
                $tr = new Zend_Mail_Transport_Sendmail();
                $sendmail->send($tr);






                $this->_helper->redirector('index', 'index');
            } else {
                $this->view->errMessage = "Деякі поля пусті або невірно заповнені";
                $this->view->showErrMessage = "showError";
            }
        }

        $this->view->formRegister = $formRegister;
    }

    public function loginAction() {

        if (Zend_Auth::getInstance()->hasIdentity()) {

            $this->_helper->redirector('index', 'index');
        }
            $this->view->headTitle('Вхід');
            $this->view->title = 'Вхід на сайт';

            $form = new Application_Form_Login();
            $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            //записуєм в змінну дані запиту
            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {
                $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());

                $authAdapter->setTableName('users')
                    ->setIdentityColumn('email')
                    ->setCredentialColumn('password');

                $username = $this->getRequest()->getPost('username');
                $password = md5($this->getRequest()->getPost('password'));

                $authAdapter->setIdentity($username)
                    ->setCredential($password);



                $result = $authAdapter->authenticate();
                $auth = Zend_Auth::getInstance();

                if ($result->isValid()) {
                    $identity = $authAdapter->getResultRowObject();
                    $authStorage = $auth->getStorage();
                    $authStorage->write($identity);
                    $this->_helper->redirector('index', 'index');

                } else {
                    $this->view->errMessage = 'Ви ввели невірний логін або пароль!';
                    $this->view->showErrMessage = "showError";
                }
            }
        }
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index', 'index');
    }

    public function activateAction() {
        if ($this->_request->isGet()) {
            $sig = $this->getRequest()->getParam('sig');
            $useremail = $this->getRequest()->getParam('email');

            $database = new Application_Model_DbTable_Users();
            if ($database->perevirkaSig($useremail, $sig))
                $this->view->msg = "ваш аккаунт активовано зараз ви бдуете переадресовані на головну сторінку";

        }
    }

   

    public function lostpassAction() {
    //створюємо форму
        $form = new Application_Form_Lostpass();
        $this->view->form = $form;

        //перевіряем чи є запит
        if ($this->getRequest()->isPost()) {
            //записуєм в змінну дані запиту
            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                $userename = $form->getValue('userename');
                $database = new Application_Model_DbTable_Users();

                $activation_code = md5(uniqid(rand(), true));

                $data = array('activation_code' => $activation_code);
                $where = "email like '$userename'";
                $database->update($data, $where);

                $sendmail = new Zend_Mail('UTF-8');
                $sendmail->setBodyText("Підтвердження паролю по ссилці:
                    http://myproject/auth/activatepass/?userename=$userename&activation_code=$activation_code
                ");
                $sendmail->setFrom('administrator@myproject', 'administrator');
                $sendmail->addTo($userename);
                $sendmail->setSubject('Відновлення паролю');
                $tr = new Zend_Mail_Transport_Sendmail();
                $sendmail->send($tr);
            } else {

                $this->view->errMessage = "Деякі поля пусті або невірно заповнені";

                $this->view->showErrMessage = "showError";
            }
        }
    }

     public function recoverAction()
    {
        $usersModel = new Application_Model_DbTable_Users();

        $resquest = $this->getRequest();
        $code = $this->_getParam('activation_code');

        $user = $usersModel->getByActivationCode($code);

        if ($user) {
            // тут генериш форму для змыни пароля ы передаэг туди ключ (hiddden field)
                $form = new Application_Form_Newpass($code);
                $this->view->formNewPass = $form;

            if ($resquest->isPost()) {
                $postData = $resquest->getPost();

                if ($form->isValid($postData)) {
                    // тут міняєш пароль на новаий і редіректиш юзера кудист
                    $password = md5($form->getValue('password'));

                    $database = new Application_Model_DbTable_Users();
                    $data = array('password' => $password);
                    $where = "email like '$userename' and activation_code like '$activation_code'";
                    $database->update($data, $where);
                    $this->view->msg = "ваш аккаунт активовано зараз ви бдуете переадресовані на головну сторінку";

                }else {

                    $this->view->errMessage = "Деякі поля пусті або невірно заповнені";
                    $this->view->showErrMessage = "showError";

                      }
            }

        } else {
                 // показуэш форму для введення емейла
                 $this->_helper->redirector('auth', 'login');
               }

    }


}

