<?php 

	session_start();

	$username = "";
	$email = "";
	$errors = array();

	// connect to the database
	include('server.php');

	// register user
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);	
		$address = mysqli_real_escape_string($conn, $_POST['address']);	
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$c_password = mysqli_real_escape_string($conn, $_POST['c_password']);	

		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($phone)) { array_push($errors, "Phone is required"); }
		if (empty($address)) { array_push($errors, "Address is required"); }
		if (empty($password)) { array_push($errors, "Password is required"); }
		if ($password != $c_password) {
			array_push($errors, "รหัสผ่านไม่ตรงกัน");
		}

		$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
		$result = mysqli_query($conn, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // if user exists
			if ($user['username'] === $username || $user['email'] === $email) {
				array_push($errors, "ชื่อผู้ใช้หรืออีเมล์นี้มีผู้ใช้งานแล้ว");
				$_SESSION['error'] = "ชื่อผู้ใช้หรืออีเมล์นี้มีผู้ใช้งานแล้ว!";
				header("location: register.php");

			}
		}

		if (count($errors) == 0) {
			$password = md5($password); // encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password, phone, address) 
					  VALUES ('$username', '$email', '$password', '$phone', '$address')";
			mysqli_query($conn, $query);
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "คุณได้เข้าสู่ระบบแล้ว";
			header("location: index.php");
		}
	}

?>