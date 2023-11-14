<?php

if (session_status() === PHP_SESSION_NONE) { // neu trang thai chua duoc bat 
    session_start(); //if(session_status() !== PHP_SESSION_ACTIVE) session_start();
}

require_once __DIR__ . '/../bootstrap.php';
use CT275\Labs\admin;
use CT275\Labs\khach_hang;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $khach_hang_db = new khach_hang($PDO);
    $khach_hang_formdbs = $khach_hang_db->all();
    $khach_hang_2 = new khach_hang($PDO);
    $khach_hang_dangnhap = $khach_hang_2->fill($_POST);
    foreach ($khach_hang_formdbs as $khach_hang_formdb) :
        if (($khach_hang_formdb->email == $khach_hang_dangnhap->email) && ($khach_hang_formdb->mat_khau) ==  $khach_hang_dangnhap->mat_khau) {
            $_SESSION['khach_hang_formdb'] = 'me';
            $_SESSION['id'] = $khach_hang_formdb->id;
            $_SESSION['email'] = $khach_hang_formdb->email;
            $_SESSION['mat_khau'] = $khach_hang_formdb->mat_khau;
            $_SESSION['ten'] = $khach_hang_formdb->ten;
            redirect('index.php');
           }   
    endforeach;
    
    

    $admin_db = new admin($PDO);
    $admin_formdbs = $admin_db->all();
    $admin_2 = new admin($PDO);
    $admin_dangnhap = $admin_2->fill($_POST);
    foreach ($admin_formdbs as $admin_formdb) :
        if (($admin_formdb->email == $admin_dangnhap->email) && $admin_formdb->mat_khau == $admin_dangnhap->mat_khau) {
        $_SESSION['admin_formdb'] = 'admin';
        $_SESSION['email'] = $admin_formdb->email;
        $_SESSION['mat_khau'] = $admin_formdb->mat_khau;
       $_SESSION['ten'] = $admin_formdb->ten;
        redirect('admin.php');
       }    
    endforeach;
}

include_once __DIR__ . '/../partials/header.php';

$pageTitle = "Đăng nhập";
?>

<title><?php echo $pageTitle; ?></title>

<section class="vh-5 py-5" style="background-color: #9A616D;">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-90">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="./uploads/logo_page_login.png" class="img-fluid"
                                style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form method="post">
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-user-circle fa-2x me-3" style="color: #000;"></i>
                                        <span class="h1 fw-bold mb-0">Đăng nhập</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng nhập bằng tài
                                        khoản của bạn!!!</h5>

                                    <div class="mb-4">
                                        <input type="email" class="form-control form-control-lg" name="email"
                                            placeholder="Điền Email của bạn...">
                                    </div>

                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-lg" name="mat_khau"
                                            placeholder="Điền mật khẩu của bạn...">
                                    </div>
                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Đăng
                                            nhập</button>
                                    </div>
                                    <a class="small text-muted" href="#!">Quên mật khẩu?</a>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn chưa có tài khoản? <a
                                            href="signup.php" style="color: #393f81; ">Đăng ký ngay</a></p>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<hr>
<?php include_once __DIR__ . '/../partials/footer.php' ?>