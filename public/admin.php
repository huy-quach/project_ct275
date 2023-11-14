<?php

include '../partials/header.php';

use CT275\Labs\dien_thoai;

$dien_thoai = new dien_thoai($PDO); 

if (!isset($_SESSION['admin_formdb'])) {
    echo('<div style="height: 300px; margin-top:150px;margin:" class="text-center">
    <h3><p>Bạn không có quyền truy xuất trang này</p></h3>
    <a href="' . BASE_URL_PATH . 'index.php"> <button class="btn btn-primary">Đi đến trang chủ</button></a>
    <a href="' . BASE_URL_PATH . 'dien_thoai.php"> <button class="btn btn-primary">Đi đến trang sản phẩm</button></a>');
    include('../partials/footer.php');
    exit();
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$pageTitle = "Admin";
?>

<title><?php echo $pageTitle; ?></title>
<style>
body {
    background-color: #f8f9fa;
}
.nav--product {
    background-color: #007bff;
    padding: 15px 0;
    color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.nav--product a {
    color: #ffffff;
    text-decoration: none;
}

.nav--product a:hover {
    text-decoration: underline;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.table th,
.table td {
    text-align: center;
}

.modal-body {
    font-size: 16px;
}
</style>
<section class="py-5">
    <main class="container">
        <form class="nav--product row mb-4" action="khach_hang.php" method="post">
            <div class="mt-2 d-flex form-header text-center">
                <h5 class="mx-auto">
                    <a class="text-white font-weight-bold" style="text-decoration: none">Trang của Admin</a>
                </h5>
            </div>
        </form>

        <section>
            <a href="<?= BASE_URL_PATH . 'them.php' ?>" class="btn btn-primary" style="margin-bottom: 20px;">
                <i class="fa fa-plus"></i> Thêm sản phẩm
            </a>
            <table id="addproduct" class="table table-hover table-bordered table-striped table-info">
                <thead class="thead-dark">
                    <tr class="text-uppercase">
                        <th scope="col">Stt</th>
                        <th scope="col">id</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Loại sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Ngày nhập</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody class="font-weight-bold">
                    <?php $i = 1; ?>
                    <?php foreach ($dien_thoais as $dien_thoai) : ?>
                    <tr>
                        <th scope="row"><?php echo $i++; ?></th>
                        <td><?= htmlspecialchars($dien_thoai->getID()) ?></td>
                        <td><?= htmlspecialchars($dien_thoai->ten_dien_thoai) ?></td>
                        <td><?= htmlspecialchars($dien_thoai->gia) . 'vnđ' ?></td>
                        <td><img style="width: 200px;" src="uploads/<?=$dien_thoai->hinh ?>" alt="..." /></td>

                        <td><?php
                                   if ($dien_thoai->id_loai == 1) {
                                       echo ("Laptop");
                                   } if ($dien_thoai->id_loai == 2) {
                                       echo ("SamSung");
                                   } else if ($dien_thoai->id_loai == 3) {
                                       echo ("Iphone");
                                   }
                                   ?></td>

                        <td><?= htmlspecialchars($dien_thoai->so_luong_hang) ?></td>
                        <td><?= date("d-m-Y", strtotime($dien_thoai->ngaynhap)) ?></td>
                        <td>
                            <a href="<?= BASE_URL_PATH . 'sua.php?id=' . $dien_thoai->getId() ?>"
                                class="btn btn-xs btn-warning">
                                <i alt="Edit" class="fa fa-pencil"> Edit</i>
                            </a>
                            <form class="delete" action="<?= BASE_URL_PATH . 'xoa.php' ?>" method="POST"
                                style="display: inline;">
                                <input type="hidden" name="id" value="<?= $dien_thoai->getId() ?>">
                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                    data-target="#exampleModal<?= $dien_thoai->getId() ?>">
                                    <i alt="Delete" class="fa fa-trash"> Delete</i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $dien_thoai->getId() ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc muốn xóa sản phẩm <span
                                                    class="text-danger"><?= $dien_thoai->ten_dien_thoai ?></span>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Hủy</button>
                                                <button type="submit" class="btn btn-danger">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </section>
    </main>
</section>