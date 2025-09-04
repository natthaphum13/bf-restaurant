<?php
session_start();
include 'condb.php';
include 'menu.php';

$type_id = isset($_GET['type']) ? (int)$_GET['type'] : 0;
$type_name = "";

if ($type_id > 0) {
    $sql_type = "SELECT type_name FROM type WHERE type_id = '$type_id'";
    $result_type = mysqli_query($conn, $sql_type);
    $row_type = mysqli_fetch_assoc($result_type);
    $type_name = $row_type['type_name'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เมนู <?= $type_name ?></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h3 class="text-center mb-4">เมนู <?= $type_name ?></h3>
        <div class="row">
        <?php
        $sql = "SELECT * FROM product WHERE type_id = '$type_id' ORDER BY pro_id DESC";
        $result = mysqli_query($conn, $sql);
        while ($row_pro = mysqli_fetch_array($result)) {
        ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <a href="sh_product_detail.php?id=<?= $row_pro['pro_id'] ?>">
                        <img src="img/<?= $row_pro['image'] ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?= $row_pro['pro_name'] ?></h5>
                        <p class="card-text text-danger"><?= number_format($row_pro['price'], 2) ?> บาท</p>
                    </div>
                    <div class="card-footer">
                        <a href="sh_product_detail.php?id=<?= $row_pro['pro_id'] ?>" class="btn btn-success w-100">ดูรายละเอียด</a>
                    </div>
                </div>
            </div>
        <?php
        }
        mysqli_close($conn);
        ?>
        </div>
    </div>
</body>
</html>