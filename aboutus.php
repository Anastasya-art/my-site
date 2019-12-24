<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="styles.css" rel="stylesheet">
        <title>About</title>
        <style type="text/css">
            .contact{
                background: #f1f1f1;
                padding: 5px;
                padding-right: 20px; 
                border: solid 2px black; 
                position: relative;
                display: inline-block;
               
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h1 align="center">Travelbook</h1>
            <div id="nav">
                 <?php 
                
                $host = 'localhost';
                $user = 'u0882960_default';
                $pass = 'yBuy!X8P';
                $db_name = 'u0882960_default';
                $link = mysqli_connect($host, $user, $pass, $db_name);
                if($_GET['exit']){
                    $_SESSION['logged_user'] = NULL;
                }
                if($_SESSION['logged_user'] != NULL){
                    //echo $_SESSION['logged_user'];
                    $sql = mysqli_query($link, "SELECT * FROM `users` WHERE `login` ='" . $_SESSION['logged_user'] ."'");
                    //echo ("SELECT * FROM `users` WHERE `login` ='" . $_SESSION['logged_user'] ."'");
                    //$result = mysqli_fetch_array($sql);
                    echo("<div class='icon'> <style> .icon {height: 3%; padding-left:5px} </style>
                        <p text align ='center'>Вы вошли как <a href = 'user.php' >" . mysqli_fetch_array($sql)['login'] . "</a>
                         <a href = '?exit=1'></br>Выход</a></p></div>");
                } else {
                    echo("<p text align='center'><a href = '/login.php'>Представьтесь системе </a></p>");
                }
                ?>
            </div>
        </div>
        <div class="wrapper">
            <div id="sidebar1" class="aside">
                <h2 text align="center">Меню</h2>
            <ul>
            <li><a class="active" href="homepage.php">Главная</a></li>
            <li><a href="news.php">Новости</a></li>
            <li><a href="catalog.php">Каталог</a></li>
            <li><a href="aboutus.php">О проекте</a></li>
            <li><a href="signup.php">Регистрация</a></li>
            </ul>
            </div>
            <div id="sidebar2" class="aside">
                <h2 align="center">Полезные ссылки</h2>
                <p><a href="http://stranymira.com/">Странный мир</a></p>
                <p><a href="http://www.portalostranah.ru/">Портал о странах</a></p>
                <p><a href="http://strana.ru/">Путешествия по России</a></p>
            </div>
            <div id="article">
                <div class="form"><h2 align="center">Контакты</h2>
                <p>Вконтакте: <a href=" https://vk.com/ ">https://vk.com/ </a></p>
                <p>Инстраграм:<a href=" https://instagram.com/ ">https://instagram.com/ </a></p></p>
                <p>Facebook:<a href=" https://facebook.com/ ">https://facebook.com/ </a></p></p>
                <p>Телефон:+79044545466</p>
                <p><a href="mailto:anastasya12az@gmail.com">Задать вопросы по электронной почте</a></p></div>
            </div>
        </div>
        <div id="footer">
            <p>© IU4-12B</p>
        </div>
    </body>
</html>

  
