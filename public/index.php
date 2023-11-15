<?php
include('../partials/header.php');

use CT275\Labs\dien_thoai; 
use CT275\Labs\loai_dien_thoai;  

$dien_thoai = new dien_thoai($PDO); 
$dien_thoai2 = $dien_thoai->all(); 
$loai_dien_thoai = new loai_dien_thoai($PDO); 
$loai_dien_thoai2 = $loai_dien_thoai->all(); 

$pageTitle = "Trang chủ";
?>
<title><?php echo $pageTitle; ?></title>
<!-- Content Main  -->
<div class="container mt-5">
    <h2 style="text-align: center;">Sản phẩm mới nhất</h3>
        <br>
        <div class="row justify-content-center">
            <?php 
        foreach ($dien_thoai2 as $dien_thoai) : 
        ?>
            <div class="col-md-4 mb-3">
                <div class="card p-3 bg-white text-center">
                    <div class="text-center mt-2">
                        <!-- Images Product  -->
                        <div class="zoom">
                            <img src="uploads/<?= $dien_thoai->hinh ?>" width="200">
                        </div>
                        <div>
                            <!-- Product Name  -->
                            <br>
                            <h4><?= $dien_thoai->ten ?></h4>
                            <!-- Details Product Default -->
                            <h6 class="mt-0 text-black-50">Sản phẩm nổi bật</h6>
                            <!-- Product Price  -->
                            <h4><?= number_format($dien_thoai->gia, 0, ',', '.') ?> VND</h4>
                            <!-- Add to Cart  -->
                            <form action="addCart.php?id=<?= $dien_thoai->getId() ?>" method="POST">
                                <input type="submit" name="addCart" value="Thêm vào giỏ hàng" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
        endforeach;
        ?>
        </div>
</div>

<div class="container">
    <div class="container-fluid container-search container-index facts my-5 p-5">
        <div class="row g-5">
            <div class="col-md-6 col-xl-3 wow fadeIn"
                style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                <div class="text-center border p-5">
                    <i class="fa fa-certificate text-dark fa-3x mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">
                        <div class="div-animation-1">
                        </div>
                    </h1>
                    <span class="fs-5 fw-semi-bold text-dark">Sản phẩm</span>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 wow fadeIn"
                style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
                <div class="text-center border p-5">
                    <i class="fa fa-users-cog fa-3x text-dark  mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">
                        <div class="div-animation-2">
                        </div>
                    </h1>
                    <span class="fs-5 fw-semi-bold text-dark ">Nhân viên</span>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 wow fadeIn"
                style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;">
                <div class="text-center border p-5">
                    <i class="fa fa-users fa-3x text-dark  mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">
                        <div class="div-animation-3">
                        </div>
                    </h1>
                    <span class="fs-5 fw-semi-bold text-dark ">Chi nhánh</span>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 wow fadeIn"
                style="visibility: visible; animation-delay: 0.7s; animation-name: fadeIn;">
                <div class="text-center border p-5">
                    <i class="fa fa-check-double fa-3x text-dark  mb-3"></i>
                    <h1 class="display-2 text-primary mb-0" data-toggle="counter-up">
                        <div class="div-animation-4">
                        </div>
                    </h1>
                    <span class="fs-5 fw-semi-bold text-dark ">Sản phấm mới</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Content Main  -->
<!-- Footer  -->
<?php include('../partials/footer.php') ?>