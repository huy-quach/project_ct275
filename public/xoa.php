<?php
require_once '../bootstrap.php'; // tu dong nap lop,khong gian ten,dbconnect

use CT275\Labs\dien_thoai;

$dien_thoai = new dien_thoai($PDO);
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['id'])
    && ($dien_thoai->find($_POST['id'])) !== null
) {
    $dien_thoai->delete();
}
redirect('admin.php');
