<?php echo $this->doctype(); ?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <?php echo $this->headLink()->appendStylesheet($this->baseUrl . '/css/style.css'); ?>
        <?php echo $this->headScript(); ?>
        <script src="http://vkontakte.ru/js/api/openapi.js" type="text/javascript"></script>
        <?php echo $this->headTitle; ?>

        <script language="javascript">
            VK.init({
                apiId: 2782001
            });
            function authInfo(response) {
                if (response.session) {
                    alert('user: '+response.session.mid);
                } else {
                    alert('not auth');
                }
            }
            VK.Auth.getLoginStatus(authInfo);
            VK.UI.button('login_button');
            
            VK.Api.call('getVariable', {key: 1281}, function(r) {
                if(r.response) {
                    alert('Привет, ' + r.response);
                }
            });
 
            
            
        </script>


    </head>



    <body>

        <div id="wrap">
            <div id="header">
                <div id="user_info">
                    <? if (Zend_Auth::getInstance()->hasIdentity()): ?>
                        <div class="avatar">
                            <? if (!$this->avatar): ?>
                                <img src="images/noavatar.png" alt="Аватар відсутній"/>
                            <? else: ?>
                                <img height="119px" src="<? echo $this->avatar; ?>" alt="Аватар відсутній"/>  
                            <? endif; ?>
                        </div>

                        <div class="user_discription">
                            <? echo $this->firstname; ?><br/>
                            <? echo $this->lastname; ?><br/>
                            <a href="http://myproject/auth/logout">вихід</a>
                        </div>
                    <? endif; ?>           
                </div>

                <div id="site_title">
                    <h3>Соціальні мережі.<? echo $this->title; ?></h3>
                </div>



                <ul class="menu">
                    <li class="punkt_menu"><a href="http://myproject">Головна</a></li>
                    <li class="punkt_menu"><a href="http://myproject">Параметри</a></li>
                </ul>
            </div>

            <div class="clr"></div>