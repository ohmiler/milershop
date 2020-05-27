<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


    <div class="admin-index">
      <div class="container">
        <img src="../img/admin.jpg" alt="">
        <h1>ADMINISTRATOR LOGIN</h1>
       <form method="post" action="admin_login.php">
          <br><br>
          Username: <input name="adminname" type="text" placeholder="Enter username" required>
          <br>
          Password: <input name="adminpass" type="password" placeholder="Enter password" required>
          <br><br>
          <input name="admin_login" type="submit"  value="Login">
       </form>
      </div>
    </div>

	<footer>
		<div class="container">
			<p>&copy; Copyright 2020. All Right Reserved MilerShop</p>
		</div>
	</footer>
</body>
</html>