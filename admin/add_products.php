
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
        <h1>ฟอร์มเพิ่มสินค้า</h1>
          <?php
            $query = "SELECT * FROM products_type ORDER BY type_id";
            $result = mysqli_query($conn, $query);
          ?>
          <form class="adduser" action="add_products_db.php" method="POST" enctype="multipart/form-data">
            <input name="product_name" type="text" placeholder="ชื่อสินค้า" required>
            <br>
            <input name="product_price" type="text" placeholder="ราคาสินค้า" required>
            <br>
            <input name="product_qty" type="text" placeholder="จำนวนสินค้า" required>
            <br>
            <p>ประเภทสินค้า</p>
            <select name="type_id" required>
              <option value="type_id">--ประเภทสินค้า--</option>
              <?php foreach($result as $results) { ?>
              <option value="<?php echo $results["type_id"]; ?>">
                <?php echo $results["type_name"]; ?>
              </option>
              <?php } ?>
            </select>
            <br>
            <p>ภาพสินค้า</p>
            <input type="file" name="product_img" required>
            <br>
            <textarea name="product_detail" placeholder="รายละเอียดสินค้า" required></textarea> 
            <br>
            <input type="submit" name="add_product" value="add">
          </form>
      <?php mysqli_close($conn); ?>
    </div>
  </section>

  <footer>
      <p>&copy; Copyright 2020. All Right Reserved MilerShop</p>
  </footer>
</body>
</html>





        

