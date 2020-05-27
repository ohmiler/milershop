<?php
  include('server.php'); 


  if (isset($_GET['delete'])) {

      $order_id = $_GET['delete'];

      $sql1 = "DELETE FROM orders WHERE order_id = $order_id";
      $result1 = mysqli_query($conn, $sql1);

      $sql2 = "DELETE FROM orders_detail WHERE order_id = $order_id";
      $result2 = mysqli_query($conn, $sql2);

  
      if($result1 && $result2){
        echo "<script type='text/javascript'>";
        echo "alert('ลบข้อมูลเรียบร้อยแล้ว!');";
        echo "window.location = 'view_orders.php'; ";
        echo "</script>";
      } else {
        echo "<script type='text/javascript'>";
        echo "alert('มีบางอย่างผิดพลาด');";
        echo "window.location = 'view_orders.php'; ";
        echo "</script>";
      }

      mysqli_close($conn);

  }
  
  
?>