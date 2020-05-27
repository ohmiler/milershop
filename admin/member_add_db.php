<?php
  include('server.php');  
  
  if (isset($_POST['reg_user'])) {

      $user_name = mysqli_real_escape_string($conn, $_POST["user_name"]);
      $user_email = mysqli_real_escape_string($conn, $_POST["user_email"]);
      $user_password = mysqli_real_escape_string($conn, $_POST["user_password"]);
      $user_phone = mysqli_real_escape_string($conn, $_POST["user_phone"]);
      $user_address = mysqli_real_escape_string($conn, $_POST["user_address"]);
      $hash_password = md5($user_password);

      $sql = "INSERT INTO users (username, email, password, phone, address)
              VALUES('$user_name', '$user_email', '$hash_password', '$user_phone', '$user_address')";
      $result = mysqli_query($conn, $sql);

  
      if($result){
        echo "<script type='text/javascript'>";
        echo "alert('สมัครสมาชิกเรียบร้อยแล้ว');";
        echo "window.location = 'dashboard.php'; ";
        echo "</script>";
      } else {
        echo "<script type='text/javascript'>";
        echo "alert('มีบางอย่างผิดพลาด');";
        echo "</script>";
      }

      mysqli_close($conn);

  }
  
  
?>