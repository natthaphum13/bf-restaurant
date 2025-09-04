<?php
session_start();
$password_correct = 'BFrestaurant';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password_input = $_POST['password'];
    if ($password_input === $password_correct) {
        $_SESSION['admin_logged_in'] = true;
        header('location: admin_order.php');
        exit();
    } else {
        $message = 'รหัสผ่านไม่ถูกต้อง โปรดลองอีกครั้ง';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>เข้าสู่ระบบ Admin</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="admin_login.php">
                            <div class="mb-3">
                                <label for="password" class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <?php if ($message): ?>
                                <div class="alert alert-danger"><?= $message ?></div>
                            <?php endif; ?>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> <br>
    <center><a href="show_product2.php" class="btn btn-success mb-4">ย้อนกลับ</a></center>
</body>
</html>