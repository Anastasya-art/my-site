<?php 
    session_start(); 
    if($_SESSION['logged_user'] == NULL){
        $_SESSION['url'] = '/newcount.php';
        header('Location: /login.php');
    }
    $host = 'localhost';
    $user = 'u0882960_default';
    $pass = 'yBuy!X8P';
    $db_name = 'u0882960_default';
    $link = mysqli_connect($host, $user, $pass, $db_name);
    if($_SESSION['logged_user']){
        if($_POST['submit']){
            $sql = mysqli_query($link, 'INSERT INTO `country`(`countryname`, `text`, `food`, `transport`, `kindness`, `continent`, `username`) VALUES ("' . $_POST['countryname'] . '", "' . $_POST['text'] . '", ' . $_POST['food'] . ', ' . $_POST['transport'] . ', ' . $_POST['kindness'] . ', "' . $_POST['continent'] . '", "'.$_SESSION['logged_user'].'")');

            $sql = mysqli_query($link, 'SELECT * FROM `country` ORDER BY `id` DESC LIMIT 1');
            header('Location: count.php?id='.mysqli_fetch_array($sql)['id']);
        }
    } else {
        header('Location: login.php');
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
                if($_SESSION['logged_user']){
                    //echo $_SESSION['logged_user'];
                    $sql = mysqli_query($link, "SELECT * FROM `users` WHERE `login` ='" . $_SESSION['logged_user'] ."'");
                    //echo ("SELECT * FROM `users` WHERE `login` ='" . $_SESSION['logged_user'] ."'");
                    //$result = mysqli_fetch_array($sql);
                     echo("<div class='icon'> <style> .icon {height: 3%; padding-left:5px} </style>
                        <p text align ='center'>Вы вошли как <a href = '' >" . mysqli_fetch_array($sql)['login'] . "</a>
                         <a href = '?exit=1'></br>Выход</a></p></div>");
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
  <li><a href="aboutus.php">Конаткты</a></li>
</ul>
                </div>
            <div id="sidebar2" class="aside">
                <h2 align="center">Полезные ссылки</h2>
                <p><a href="http://stranymira.com/">Странный мир</a></p>
                <p><a href="http://www.portalostranah.ru/">Портал о стрнах</a></p>
                <p><a href="http://strana.ru/">Путешествия по России</a></p>
            </div>
            <div id="article">
                
                <h2 align="center">Добавление страны</h2>
                <form action = "" method="POST">
                    <p>Еда <input type = 'radio' name = 'food' value = '1'><input type = 'radio' name = 'food' value = '2'><input type = 'radio' name = 'food' value = '3'><input type = 'radio' name = 'food' value = '4'><input type = 'radio' name = 'food' value = '5'></p>
                <p>Транспорт <input type = 'radio' name = 'transport' value = '1'><input type = 'radio' name = 'transport' value = '2'><input type = 'radio' name = 'transport' value = '3'><input type = 'radio' name = 'transport' value = '4'><input type = 'radio' name = 'transport' value = '5'></p>
                <p>Доброжелательность <input type = 'radio' name = 'kindness' value = '1'><input type = 'radio' name = 'kindness' value = '2'><input type = 'radio' name = 'kindness' value = '3'><input type = 'radio' name = 'kindness' value = '4'><input type = 'radio' name = 'kindness' value = '5'></p>
                <select name = 'continent'>
                    <option value="Европа">Европа</option>
                    <option value="Азия">Азия</option>
                    <option value="Австралия">Австралия</option>
                    <option value="Африка">Африка</option>
                </select>
                    <p>
                        <input type="text" name="countryname" placeholder="Введите название страны...">
                    </p>
                    
                    <textarea cols="80" rows = "20" name = 'text' placeholder="Описание"></textarea><br>
                    <input type = 'submit' name = 'submit' value = 'Добавить'>
                </form>

            </div>
        </div>
        <div id="footer">
            <p>© IU4-12B</p>
        </div>
    </body>
</html>
