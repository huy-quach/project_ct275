<?php
require_once __DIR__ . "/../bootstrap.php";
include_once __DIR__ . '/../partials/header.php';

use CT275\Labs\dien_thoai; 
use CT275\Labs\loai_dien_thoai;  

$dien_thoai = new dien_thoai($PDO); 
$dien_thoai2 = $dien_thoai->all(); 
$loai_dien_thoai = new loai_dien_thoai($PDO); 
$loai_dien_thoai2 = $loai_dien_thoai->all(); 

?>
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
                        <img src="uploads/<?= $dien_thoai->hinh ?>" width="200">
                        <div>
                            <!-- Product Name  -->
                            <br>
                            <h4><?= $dien_thoai->ten ?></h4>
                            <!-- Details Product Default -->
                            <h6 class="mt-0 text-black-50">Sản phẩm nổi bật</h6>
                            <!-- Product Price  -->
                            <h4><?= number_format($dien_thoai->gia, 0, ',', '.') ?>VND</h3>
                            <!-- Add to Cart  -->
                            <form action="">
                                <input type="submit" value="Thêm vào giỏ hàng" class="btn btn-primary">
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



<!-- End Content Main  -->
<!-- Footer  -->
<hr>
<?php include_once __DIR__ . '/../partials/footer.php'; ?>