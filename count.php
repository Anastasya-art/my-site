<?php 
    session_start(); 
    ob_start();
    $host = 'localhost';
    $user = 'u0882960_default';
    $pass = 'yBuy!X8P';
    $db_name = 'u0882960_default';
    $link = mysqli_connect($host, $user, $pass, $db_name);
    $sql = mysqli_query($link, 'SELECT * FROM `country` WHERE `id` = ' . $_GET['id']);
    $country = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="styles.css?%rand%" rel="stylesheet">
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
                        <p text align ='center'>Вы вошли как <a href = 'user.php' >" . mysqli_fetch_array($sql)['login'] . "</a>
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
            <li><a href="aboutus.php">Контакты</a></li>
            <li><a href="signup.php">Регистрация</a></li>
            </ul>
                </div>
            <div id="sidebar2" class="aside">
                <h2 align="center">Полезные ссылки</h2>
                <p><a href="http://stranymira.com/">Странный мир</a></p>
                <p><a href="http://www.portalostranah.ru/">Портал о стрнах</a></p>
                <p><a href="http://strana.ru/">Путешествия по России</a></p>
            </div>
            <div id="article">
            	<?php
            		$sql = mysqli_query($link, "SELECT * FROM `users` WHERE `login` ='" . $_SESSION['logged_user'] ."'");
            		$user = mysqli_fetch_array($sql);
            		if($user['roots'] == 2){
            			echo "<a href = '?delete=1&id=" . $_GET['id'] . "'>Удалить статью</a>";
            			
            		}

                    if(($_GET['delete']) && ($user['roots'] == 2)){
                        mysqli_query($link, "DELETE FROM `country` WHERE `id` = " . $_GET['id']);
                        mysqli_query($link, "DELETE FROM `comments` WHERE `countid` = " . $_GET['id']);

                        header('Location: /news.php');
                    }
                    if(($_GET['deletecomment']) && ($user['roots'] > 0)){
                        mysqli_query($link, "DELETE FROM `comments` WHERE `id` = " . $_GET["deletecomment"]);
                    }
            	?>
                <h3>Автор : <?php echo $country['username']; ?></h3>
                <h2 align="center"><?php echo $country['countryname']; ?></h2>
                <h3>Континент: <?php echo $country['continent']; ?></h3>
                <p><?php echo $country['text']; ?></p>
                <p>Еда:<?php echo $country['food'] ?></p>
                <p>Транспорт:<?php echo $country['transport'] ?></p>
                <p>Доброжелательность иностранцев:<?php echo $country['kindness'] ?></p>
                <div>
                    <?//комментарии
                    if($_SESSION['logged_user']){
                        echo 
                            "<form action = '' method = 'POST'>
                                            <textarea cols = '80' rows = '10' name = 'comment' placeholder='Комментарий...'>".$_GET['name'] . (($_GET['name'] == NULL)? "" : ",") .  "</textarea><br>
                                            <input type='submit' name='send' value = 'Отправить'>
                                        </form>";
                    } else {
                        echo "Чтобы оставить комментарий, пожалуйста, <a href = '/login.php'>представьтесь</a> системе.";
                        $_SESSION['url'] = '/count.php?id=' . $_GET['id'];
                    }
                    if($_POST['send']) {
                        

                        mysqli_query($link, 'INSERT INTO `comments`(`username`, `countid`, `text`, `commentid`) VALUES 
                            ("'.$_SESSION['logged_user'].'",' . $_GET['id'] . ',"' . $_POST['comment'] . '", ' . 
                            (($_GET['commentid'] == NULL)? "0" : $_GET["commentid"]) . ')');
                    }

                    $sql = mysqli_query($link, 'SELECT * FROM `comments` WHERE `countid` = ' . $_GET['id'] . ' AND `commentid` = 0 ORDER BY `id` DESC');
                    while($result = mysqli_fetch_array($sql)){
                        echo("<div style = 'border-top : 3px solid black;'><div> " . $result['username'] . "</div><div>" 
                        . $result['text'] . "</div><a href = '?commentid=".$result['id']."&name=".$result['username']
                        . "&id=".$_GET['id']."'>Ответить</a>");
                        if($user['roots'] > 0){
                            echo " <a href = '?id=".$_GET['id']."&deletecomment=" . $result['id'] . "'>Удалить коментарий</a>";
                        }

                        echo ("</div>");

                        $sql1 = mysqli_query($link, 'SELECT * FROM `comments` WHERE `commentid` = ' . $result['id']);
                        while($result1 = mysqli_fetch_array($sql1)){
                            echo("<div style = 'border-left : 3px solid black; margin-left : 10px'><div style = 'border-top : 2px solid black;'> " . $result1['username'] . "</div><div>" 
                        . $result1['text'] . "</div>");
                        if($user['roots'] > 0){
                            echo " <a href = '?id=".$_GET['id']."&deletecomment=" . $result1['id'] . "'>Удалить коментарий</a>";
                        }
                        echo ("</div>");
                        }
                    }
                    ?>

                </div>
            </div>
        </div>

        <div id="footer">
            <p>© IU4-12B</p>
        </div>
    </body>
</html>
<?php

ob_end_flush();

?>
