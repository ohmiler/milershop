<?php
  include('server.php'); 


  if (isset($_GET['delete'])) {

      $type_id = $_GET['delete'];

      $sql = "DELETE FROM products_type WHERE type_id = $type_id ";
      $result = mysqli_query($conn, $sql);

  
      if($result){
        echo "<script type='text/javascript'>";
        echo "alert('ลบข้อมูลเรียบร้อยแล้ว!');";
        echo "window.location = 'product_type.php'; ";
        echo "</script>";
      } else {
        echo "<script type='text/javascript'>";
        echo "alert('มีบางอย่างผิดพลาด');";
        echo "window.location = 'product_type.php'; ";
        echo "</script>";
      }

      mysqli_close($conn);

  }
  
  
?>