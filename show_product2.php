<?php
include 'condb.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=EDGE">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script scr="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<?php include 'menu.php' ; ?>

    <div class="container">
<br><br><br>
  <div class="row">
 <?php
        $sql = "SELECT * FROM product ORDER BY pro_id";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
        ?>
    <div class="col-sm-3">
        <div class="text-center">
      <img src="img/<?=$row['image']?>" width="200px" height="200" class="mt-5 p-2 my-2 border"> <br>
      ID: <?=$row['pro_id']?> <br>
       <h5 class="text-success"><?=$row['pro_name']?></h5> <br>
       ราคา <b class="text-danger"><?=$row['price']?> บาท</b> <br>
       <a href="sh_product_detail.php?id=<?=$row['pro_id']?>" class="btn btn-outline-success mt-3">รายละเอียด</a>
</div>
<br>
    </div>
    <?php
    }
    mysqli_close($conn);
?>
  </div>
</div>




</body>
</html>