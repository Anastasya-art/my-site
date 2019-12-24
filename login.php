<?php
	session_start();
	require "db.php";

	$data = $_POST;

	if(isset($data['do_login']))
	{
		$errors = array();
		$user = R::findOne('users', 'login = ?', array($data['login']));
		
		if($user){
			if(password_verify($data['password'], $user->password)){
				
				$_SESSION['logged_user'] = $user->login;
                if(isset($_SESSION['url'])){
                    header('Location: ' . $_SESSION['url']);
                    $_SESSION['url'] = NULL;
                } else {
				    header('Location: homepage.php');
                }
			}else{
				$errors[] = 'Неверный пароль!';
			}

		}else{
			$errors[] = 'Пользователь с таким логином не найден';
		}

		if (! empty($errors))
		{
			echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
		}
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="styles.css" rel="stylesheet">
        <title>log</title>
    </head>
    <body>
        <div class="header">
            <h1 align="center">Travelbook</h1>
           
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
                <h2 align="center">Авторизация!</h2>
                <p><form action="login.php" method="post"> 
                <p>
		<input type="text" name="login" placeholder="Введите логин" value="<?php echo @$data['login']; ?>">
	</p>
	<p>
		<input type="password" name="password" placeholder="Введите пароль">
	</p>
	<p>
		<button type="submit" name="do_login">Войти</button>
	</p>
	<p>
		Нет аккаунта? <a href="signup.php">Зарегистрируйтесь</a>
	</p>
	</form></p>
            </div>
        </div>
        <div id="footer">
            <p>© IU4-12B</p>
        </div>
    </body>
</html>

  
