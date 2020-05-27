<?php 
  
  session_start();

  include('server.php');

  if ($_SESSION["userid"] == "") {
    header("location: index.php");
    exit();
  }

  if ($_SESSION["status"] != "admin") {
    echo "This page for admin only!";
    exit();
  }

  $sql = "SELECT * FROM admin WHERE id = '".$_SESSION['userid']."' ";
  $query = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Welcome <?php echo $result["username"]; ?>!</h1>
  </header>
  <section>
    <nav>
      <ul>
        <li><a href="dashboard.php">Dashboard</a><br></li>
        <li><a href="product_list.php">จัดการสินค้า</a><br></li>
        <li><a href="product_type.php">จัดการประเภทสินค้า</a><br></li>
        <li><a href="view_orders.php">จัดการออเดอร์</a><br></li>
        <li class="logout"><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    <div class="info">
        <h1>ฟอร์มเพิ่มสมาชิก</h1>
          <form  class="adduser" action="member_add_db.php" method="POST">
            <input name="user_name" type="text" placeholder="ใส่ชื่อผู้ใช้" required>
            <br>
            <input name="user_password" type="password" placeholder="ใส่รหัสผ่าน" required>
            <br>
            <input name="user_email" type="text" placeholder="ใส่อีเมล์" required>
            <br>
            <input name="user_phone" placeholder="ใส่เบอร์โทรสัพท์" type="text"placeholder="">
            <br>
            <textarea name="user_address" placeholder="ใส่ที่อยู่" required></textarea> 
            <br>
            <input type="submit" name="reg_user">
          </form>
      <?php mysqli_close($conn); ?>
    </div>
  </section>

  <footer>
      <p>&copy; Copyright 2020. All Right Reserved MilerShop</p>
  </footer>
</body>
</html>





        

