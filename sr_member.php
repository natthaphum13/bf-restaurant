<?php
include 'condb.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">


                <div class="h4 text-center alert alert-success mb-4 mt-4" role="alert">เพิ่มข้อมูลสมาชิก</div>
                <form method="POST" action="insert_member.php">
                    <label>ชื่อ:</label>
                    <input type="text" name="fname" class="form-control" placeholder="...ชื่อ" required ><br>   <!-- required คือบังคับกรอกข้อมูลให้ครบ-->
                    <label>นามสกุล:</label>
                    <input type="text" name="lname" class="form-control" placeholder="...นามสกุล" required ><br>
                    <label>เบอร์โทรศัพท์:</label>
                    <input type="number" name="telephone" class="form-control" placeholder="...เบอร์โทรศัพท์" required ><br>
                    <input type="submit" value="submit" class="btn btn-success">
                    <a href="show_member.php" class="btn btn-danger">cancel</a>
                </form>
            </div>
        </div>

    </div>

</body>

</html>