<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>member</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

<body>
    <div class="container">
    <div class="h4 text-center alert alert-success mb-4 mt-4" role="alert">แสดงข้อมูลสมาชิก</div>
<a href="sr_member.php" class="btn btn-primary mb-4 mt-4">Add+</a>

        <table class="table table-striped">
            <tr>
                <th>รหัส</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>เบอร์โทรศัพท์</th>
                <th>edit</th>
                <th>delete</th>
            </tr>

            <?php
            $sql = "SELECT * FROM member";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["name"] ?></td>
                    <td><?= $row["surname"] ?></td>
                    <td><?= $row["telephone"] ?></td>
                    <td><a href="edit_member.php?id=<?= $row["id"] ?>" class="btn btn-warning">edit</a></td>
                     <td><a href="delete_member.php?id=<?= $row["id"] ?>" class="btn btn-danger" onclick="Del(this.href);return false;">delete</a></td>
                </tr>
            <?php
            }
            mysqli_close($conn); //ปิกการเชื่อมต่อฐานข้อมูล
            ?>
        </table>

    </div>
</body>

</html>

<script language="JavaScript">
function Del(mypage){
    var agree=confirm("คุณต้องการลบข้อมูลหรือไม่")
    if(agree){
        window.location=mypage;
    }
}

</script>