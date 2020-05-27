<?php 

	session_start();

	include('server.php');	

	if (isset($_POST['admin_login'])) {
		$username = mysqli_real_escape_string($conn, $_POST['adminname']);
		$password = mysqli_real_escape_string($conn, $_POST['adminpass']);

		$query = "SELECT * FROM admin WHERE username = '$username' and password = '$password'";
		$result = mysqli_query($conn, $query);
		$fetch_result = mysqli_fetch_assoc($result);

		if ($fetch_result) {

			$_SESSION["userid"] = $fetch_result['id'];
			$_SESSION["status"] = $fetch_result['status'];
			if ($fetch_result["status"] == "admin") {
				header("location: dashboard.php");
			} else {
				header("location: index.php");
			}
		} else {
			header("location: index.php");
		}

		mysqli_close($conn);
	}

?>