<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="styles.css" rel="stylesheet">
        <title>Catalog</title>
    <style type="text/css">
    div.gallery {
    overflow: hidden;
    width: 30%;
    margin: 0 auto;
    bottom: 5px; 
    right: 5px;
    display: inline-block;
    }
    div.gallery:hover {
    border: 1px solid #777;
    }

    div.gallery img {
    width: 100%;
    height: auto;
    object-fit: scale-down;
    }
    div.desc {
    text-align: center;
    }
    .scale img {
    transition: 1s; 
    display: block; 
    }
   .scale img:hover {
    transform: scale(1.2);
    }
   .scale {
    width: 27%; 
    float: left; 
    margin: 0; 
    padding: 2%; 
    object-fit: scale-down;
    }
    row-padding:after,
   .row-padding:before{
    display:table;
    clear:both;
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
             <h2 align="center">Каталог стран</h2>
<div class="gallery" >
  <a target="_blank" href="europe.jpg">
    <img src="europe.jpg" width="600" height="400">
  </a>
  <div class="desc"><a href="list.php?continent=Европа" class="scale" text align="center">Европа</a></div>
</div>

<div class="gallery">
  <a target="_blank" href="asia.png">
    <img src="asia.png" alt="Asia" width="600" height="400">
  </a>
  <div class="desc"><a href="list.php?continent=Азия">Азия</a></div>
</div>

<div class="gallery">
  <a target="_blank" href="australia.jpg">
    <img src="australia.jpg" alt="Australia" width="600" height="400">
  </a>
  <div class="desc"><a href="list.php?continent=Австралия">Австралия</a></div>
</div>

<div class="gallery">
  <a target="_blank" href="africa.jpg">
    <img src="africa.jpg" alt="Africa" width="600" height="400">
  </a>
  <div class="desc"><a href="list.php?continent=Африка">Африка</a></div>
</div>
</div>
            </div>
        </div>
        <div id="footer">
            <p>© IU4-12B</p>
        </div>
    </body>
</html>


  
