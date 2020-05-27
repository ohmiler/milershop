<?php 
   include('server.php');  


   if (isset($_POST['update'])) {
      $user_id = $_POST['user_id'];
      $user_name = $_POST['user_name'];
      $user_email = $_POST['user_email'];
      $user_password = $_POST['user_password'];
      $user_phone = $_POST['user_phone'];
      $user_address = $_POST['user_address'];
      $hash_password = md5($user_password);

      $sql = "UPDATE users SET username = '$user_name', email = '$user_email', password = '$hash_password', phone = '$user_phone', address = '$user_address' WHERE user_id = $user_id ";

      $result = mysqli_query($conn, $sql);

  
      if($result){
        echo "<script type='text/javascript'>";
        echo "alert('อัพเดตข้อมูลเรียบร้อยแล้ว!');";
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