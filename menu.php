<?php
// ตรวจสอบจำนวนสินค้าในตะกร้า
$cart_count = 0;
if (isset($_SESSION['strQty']) && is_array($_SESSION['strQty'])) {
    foreach ($_SESSION['strQty'] as $qty) {
        $cart_count += $qty;
    }
}

// ตรวจสอบชื่อไฟล์ปัจจุบัน
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php"><img src="img/logo.jpg" height="100" width="100"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'index.php') ? 'active-link' : '' ?>" href="index.php">เมนูแนะนำ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'show_product2.php') ? 'active-link' : '' ?>" href="show_product2.php">เมนูทั้งหมด</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ประเภทอาหาร
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item <?= (isset($_GET['type']) && $_GET['type'] == 5) ? 'active-link' : '' ?>" href="show_products_by_type.php?type=5">เมนูข้าว</a></li>
            <li><a class="dropdown-item <?= (isset($_GET['type']) && $_GET['type'] == 2) ? 'active-link' : '' ?>" href="show_products_by_type.php?type=2">เมนูถาด</a></li>
            <li><a class="dropdown-item <?= (isset($_GET['type']) && $_GET['type'] == 4) ? 'active-link' : '' ?>" href="show_products_by_type.php?type=4">เมนูกับข้าว</a></li>
            <li><a class="dropdown-item <?= (isset($_GET['type']) && $_GET['type'] == 3) ? 'active-link' : '' ?>" href="show_products_by_type.php?type=3">เมนูเครื่องดื่ม</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" method="POST" action="sh_product.php">
        <input class="form-control me-2" type="search" name="keyword" placeholder="ค้นหา" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'cart.php') ? 'active-link' : '' ?>" href="cart.php">
            🛒 ตะกร้า <span class="badge rounded-pill bg-gold-dark-red cart-badge"><?= $cart_count ?></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'admin_login.php') ? 'active-link' : '' ?>" href="admin_login.php">Admin</a>
        </li>
      </ul>
    </div>
  </div>
</nav>