<?php 
    session_start();
	require "db.php";

	$data = $_POST;
	if(isset($data['do_signup'])){
		if(trim($data['login']) == ''){
			$errors[] = 'Введите логин!';
		}
		if(trim($data['email']) == ''){
			$errors[] = 'Введите почту!';
		}
		if($data['password'] == ''){
			$errors[] = 'Введите пароль!';
		}
		if($data['password_2'] != $data['password']){
			$errors[] = 'Повторный пароль введен не верно!';
		}
		if(R::count('users',"login = ?", array($data['login'])) >0 ){
			$errors[] = 'Пользователь с таким логином уже существует!';
		}
		if(R::count('users',"email = ?", array($data['email'])) >0 ){
			$errors[] = 'Пользователь с таким email уже существует!';
		}
		if (empty($errors)){
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
			R::store($user);
			echo '<div style="color: green;">Регистрация успешна!</div><hr>';
			header('Location: /homepage.php');
		}else{
			echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
		}
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
               <div class="form">
<h3 align='center'>Регистрация!</h3></br>
<form action="signup.php" method="post" >
	<p>
		<input type="text" name="login" placeholder="Введите логин" value="<?php echo @$data['login']; ?>">
	</p>
	<p>
		<input type="email" name="email" placeholder="Введите email" value="<?php echo @$data['email']; ?>">
	</p>
	<p>
		<input type="password" name="password" placeholder="Введите пароль">
	</p>
	<p>
		<input type="password" name="password_2" placeholder="Введите пароль еще раз">
	</p>
	<p>
		<button type="submit" name="do_signup">Зарегистрироваться</button>
	</p>
	<p>Уже есть аккаунт?</br>
		<a href="login.php">Авторезируйся!</a></p>
</form>
</div>
            </div>
        </div>
        <div id="footer">
            <p>© IU4-12B</p>
        </div>
    </body>
</html>
