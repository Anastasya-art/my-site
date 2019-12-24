<?php session_start(); 

if($_SESSION['logged_user'] == NULL){
     header('Location: /login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="styles.css" rel="stylesheet">
        <title>home</title>
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
                     echo("<div class='icon'> <style> .icon {height: 2%; padding-left:5px} </style>
                        <p text align ='center'>Вы вошли как <a href = '' >" . mysqli_fetch_array($sql)['login'] . "</a>
                         <a href = '?exit=1'></br>Выход</a></p></div>");

                    $sql = mysqli_query($link, "SELECT * FROM `users` WHERE `login` ='" . $_SESSION['logged_user'] ."'");
                    $user = mysqli_fetch_array($sql);
                } else {
                    echo("<a href = '/login.php'>Представьтесь системе </a>");
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
            <li><a href="aboutus.php">Контакты</a></li>
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
                <h2 align="center">Личный кабинет</h2>

                <h3><? echo $user['login']; ?></h3>
                <span>
                <?php
                echo "<img src = 'img/" . $user['login'] . ".png' class = 'ava'>";
                ?>
                <form action = '' method = 'POST' enctype='multipart/form-data'>
                    <p>Загрузить аву</p>
                    <input type = 'file' name = 'img' accept='image/png'><br>
                    <?php
                    if ($_FILES['img']['size'] != 0){
                        move_uploaded_file($_FILES["img"]["tmp_name"], "img/" . $user['login'] . ".png");
                    }
                    ?>
                    <input type="submit" value ="Загрузить">
                </form>
                </span>
                <span>
                    <h3> Мои статьи </h3>
                    <?
                        $sql = mysqli_query($link, "SELECT * FROM `country` where `username` = '" . $user['login'] . "'");
                        while($result = mysqli_fetch_array($sql)){
                            echo("<div><a href = '/count.php?id=" . $result['id'] . "'>" . $result['countryname'] . "</a></div>");
                        }
                    ?>
                </span>
            </div>
        </div>
        <div id="footer">
            <p>© IU4-12B</p>
        </div>
    </body>
</html>

