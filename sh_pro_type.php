<?php
require 'condb.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <br><br>
    <div class="container">

        <form method="POST" action="sh_pro_type.php">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-select" name="key_type" aria-label="Default select example">
                        <?php
                        $sql = "SELECT * FROM type ORDER BY type_name";
                        $hand = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($hand)) {
                        ?>


                            <option value="<?= $row['type_id'] ?>"><?= $row['type_name'] ?></option>

                        <?php
                        }
                        ?>


                    </select>

                </div>
                <div class="col-4">
                    <button type="submit" name="btt1" class="btn btn-success">ค้นหา</button>
                    <button type="submit" name="btt2" class="btn btn-success">ทั้งหมด</button>
                </div>

        </form>


        <div class="row">
            <?php
            $keyType = @$_POST['key_type'];
            if (isset($_POST['btt1'])) {
                 $sql = "SELECT * FROM product p, type t WHERE p.type_id=t.type_id and p.type_id= '$keyType' ORDER BY pro_id";
            } elseif (isset($_POST['btt2'])) {
                 $sql = "SELECT * FROM product p, type t WHERE p.type_id=t.type_id ORDER BY pro_id";
            } else {
                $sql = "SELECT * FROM product p, type t WHERE p.type_id=t.type_id ORDER BY pro_id";
            }



            $hand = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($hand)) {
            ?>
                <div class="col-md-3">
                    <img src="img/<?= $row['image'] ?>" width="200" height="200" class="mt-5 p-2 my-2 border">
                    <br>
                    ID: <?= $row['pro_id'] ?> <br>
                    <h5><?= $row['pro_name'] ?></h5><br>
                    ราคา: <?= $row['price'] ?> บาท
                </div>
            <?php
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>

</html>