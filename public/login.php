<?php
include('../partials/header.php');
?>
<section class="vh-5 py-5" style="background-color: #9A616D;">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center h-90">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="./uploads/logo_page_login.png" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form>
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-user-circle fa-2x me-3" style="color: #000;"></i>
                                        <span class="h1 fw-bold mb-0">Đăng nhập</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng nhập bằng tài khoản của bạn!!!</h5>

                                    <div class="mb-4">
                                        <input type="email" class="form-control form-control-lg" placeholder="Điền Email của bạn..." />
                                        <!-- <label class="form-label" for="form2Example17">Email address</label>  -->
                                    </div>

                                    <div class="mb-4">
                                        <input type="password" 
                                            class="form-control form-control-lg" placeholder="Điền mật khẩu của bạn..."/>
                                        <!-- <label class="form-label" for="form2Example27">Password</label>  -->
                                    </div>
                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="button">Đăng nhập</button>
                                    </div>
                                    <a class="small text-muted" href="#!">Quên mật khẩu?</a>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn chưa có tài khoản? <a href="signup.php"
                                            style="color: #393f81; ">Đăng ký ngay</a></p>
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