<?php
include('../partials/header.php');

use CT275\Labs\dien_thoai;
use CT275\Labs\loai_dien_thoai;

$dien_thoai = new dien_thoai($PDO);
$dien_thoai2 = $dien_thoai->all();
$loai_dien_thoai = new loai_dien_thoai($PDO);
$loai_dien_thoai2 = $loai_dien_thoai->all();

?>
<!-- Content Main  -->
<div class="container mt-5">
    <?php 
    $count = 0; // Số sản phẩm trên mỗi dòng
    foreach ($dien_thoai2 as $dien_thoai) : 
        if ($count % 4 == 0) {
            echo '<div class="row">';
        }
    ?>
    <div class="col-md-3 p-3">
        <div class="card p-3 bg-white">
            <div class="text-center mt-2">
                <!-- Images Product  -->
                <img src="uploads/<?= $dien_thoai->hinh ?>" width="200">
                <div>
                    <!-- Product Name  -->
                    <h4><?= $dien_thoai->ten_dien_thoai ?></h4>
                    <!-- Details Product Default -->
                    <h6 class="mt-0 text-black-50">Sản phẩm nổi bật</h6>
                    <!-- Product Price  -->
                    <h4><?= $dien_thoai->gia_dien_thoai ?>VND</h3>
                    <!-- Add to Cart  -->
                    <form action="">
                        <input type="submit" value="Thêm vào giỏ hàng" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php 
        $count++;
        if ($count % 4 == 0) {
            echo '</div>'; // Đóng dòng
        }
    endforeach;
    ?>
</div>

<!-- End Content Main  -->
<!-- Footer  -->
<?php include('../partials/footer.php') ?>