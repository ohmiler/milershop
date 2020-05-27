
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
        <h1>ฟอร์มแก้ไขสมาชิก</h1>
        <?php 
            $user_id = $_GET['edit'];
            $sql = "SELECT * FROM users WHERE user_id = $user_id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        ?>
          <form  class="edituser" action="member_edit_db.php" method="POST" >
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input name="user_name" value="<?php echo $row['username']; ?>" type="text" placeholder="ใส่ชื่อผู้ใช้" required>
            <br>
            <input name="user_password" value="<?php echo $row['password']; ?>" type="password" placeholder="ใส่รหัสผ่าน" required>
            <br>
            <input name="user_email" value="<?php echo $row['email']; ?>" type="text" placeholder="ใส่อีเมล์" required>
            <br>
            <input name="user_phone" value="<?php echo $row['phone']; ?>" placeholder="ใส่เบอร์โทรสัพท์" type="text"placeholder="">
            <br>
            <textarea name="user_address" placeholder="ใส่ที่อยู่" required><?php echo $row['address']; ?></textarea> 
            <br>
            <input type="submit" name="update" value="update">
          </form>
      <?php mysqli_close($conn); ?>
    </div>
  </section>

  <footer>
      <p>&copy; Copyright 2020. All Right Reserved MilerShop</p>
  </footer>
</body>
</html>





        

