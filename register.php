<?php 
	
	session_start();
	include('server.php'); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

   <header>
   		<div class="container">
			<div class="banner">
				<img style="width: 100%;" src="img/banner.jpg" alt="">
			</div>
   		</div>
   </header>

	<nav>
		<div class="container">
			<div class="nav-c">
				<ul class="menu">
					<li><a href="index.php">HOME</a></li>
					<li><a href="#">ABOUT</a></li>
					<li><a href="#">CONTACT</a></li>
				</ul>

				<ul class="login">
					<li><a href="login.php">LOGIN</a></li>
					<li><a href="register.php">REGISTER</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<section>
		<div class="container">
			<div class="register-form">
				<img style="width: 25%;" src="img/register.jpg" alt="">
				<br><br>
				<?php if (isset($_SESSION['error'])) : ?>
			      <div class="error" >
			      	<h3>
			          <?php 
			          	echo $_SESSION['error']; 
			          	unset($_SESSION['error']);
			          ?>
			      	</h3>
			      </div>
		  		<?php endif ?>
				<h1>Register - สมัครสมาชิก</h1>
				<br>
				<form action="register_process.php" method="post">
					<?php include('errors.php'); ?>
					<input type="text" name="username" placeholder="Enter your username" required>
					<br>
					<input type="text" name="email" placeholder="Enter your email" required>
					<br>
					<input type="password" name="password" placeholder="Enter your password" required>
					<br>
					<input type="password" name="c_password" placeholder="Confirm your password" required>  
					<br>
					<input type="text" name="phone" placeholder="Enter your phone number" required>
					<br>
					<textarea name="address" placeholder="Enter your address" required></textarea>
					<br>
					<input type="submit" name="reg_user" value="Register">
				</form>
				<a style="color: blue; font-size: 12px;" href="login.php">เข้าสู่ระบบ</a>
			</div>
		</div>
	</section>

	<footer>
		<div class="container">
			<p>&copy; Copyright 2020. All Right Reserved MilerShop</p>
		</div>
	</footer>
</body>
</html>