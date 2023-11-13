<?php
include('../partials/header.php');

use CT275\Labs\khach_hang;

$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$khach_hang = new khach_hang($PDO);
	$khach_hang->fill($_POST);
	if ($khach_hang->validate()) {
		if($khach_hang->save()){
            $message = "Bạn đã đăng ký thành công";
            $alertClass = 'alert-success';
        }
	} else {
        $message = "Bạn đã đăng ký không thành công";
        $alertClass = 'alert-danger';
    }

    // làm rỗng các trường sao khi đăng ký thành công
    $_POST['ten'] = '';
    $_POST['email'] = '';
    $_POST['dia_chi'] = '';
    $_POST['so_dt'] = '';
    $_POST['mat_khau'] = '';

	$errors = $khach_hang->getValidationErrors();
}

include_once __DIR__ . '/../partials/header.php'; //header
$pageTitle = "Đăng ký";
?>
<title><?php echo $pageTitle; ?></title>

<?php if (isset($message)) : ?>
    <!-- nếu có lỗi thì hiện thông báo lỗi -->
    <div class="alert <?= $alertClass ?>">
        <?= $message ?>
    </div> 
<?php endif ?>


<section class="vh-5 py-5" style="background-color: #9A616D;">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-90">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="./uploads/logo_page_login.png" class="img-fluid"
                                style="border-radius: 1rem 0 0 1rem; position: relative; top: 20%;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form method="post">
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-id-card-alt fa-2x me-3" style="color: #000;"></i>
                                        <span class="h1 fw-bold mb-0">Đăng ký</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng ký tài khoản của
                                        bạn!!!</h5>
                                    <label class="form-label">Họ tên</label>
                                    <div class="mb-4">
                                        <input type="text" class="form-control form-control-lg" name="ten"
                                            placeholder="Tên tài khoản của bạn..." />
                                    </div>
                                    <label class="form-label">Tài khoản</label>
                                    <div class="mb-4">
                                        <input type="email" class="form-control form-control-lg" name="email"
                                            placeholder="Email của bạn..." />
                                    </div>
                                    <label class="form-label">Số điện thoại</label>
                                    <div class="mb-4">
                                        <input type="text" class="form-control form-control-lg" name="so_dt"
                                            placeholder="Số điện thoại..." />
                                    </div>
                                    <div class="mb-4">
                                        <input type="text" class="form-control form-control-lg" name="dia_chi"
                                            placeholder="Địa chỉ của bạn..." />
                                    </div>
                                    <label class="form-label">Nhập lại mật khẩu</label>
                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-lg" name="mat_khau"
                                            placeholder="Mật khẩu của bạn..." />
                                    </div>
                                    <label class="form-label">Mật khẩu</label>
                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-lg" name="mat_khau"
                                            placeholder="Mật khẩu của bạn..." />
                                    </div>
                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Đăng
                                            ký</button>
                                    </div>
                                    <a class="small text-muted" href="#!">Quên mật khẩu?</a>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn đã có tài khoản? <a
                                            href="login.php" style="color: #393f81; ">Đăng nhập ngay</a></p>
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
<?php include('../partials/footer.php') ?>