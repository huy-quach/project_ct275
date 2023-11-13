<?php


require_once '../bootstrap.php';


use CT275\Labs\dien_thoai;
use CT275\Labs\loai_dien_thoai;

if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
}

$loai_dien_thoai = new loai_dien_thoai($PDO);
$loai_dien_thoai2 = $loai_dien_thoai->all();

if(isset($_SESSION['carts'])){
    $count = count($_SESSION['carts']);
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom Css  -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- FontAwesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Favicon Icon Web  -->
    <link rel="shortcut icon" href="./uploads/favicon.png" type="image/x-icon">

    <!-- Jquery JS  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Bootstrap CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Design Font  -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Bootstrap JS  -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <!-- Style Script  -->
    <script src=./js/style.js></script>
    <style>
    a {
        text-decoration: none;
    }
    </style>
</head>

<body>
    <!-- Loader  -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Loader  -->

    <!-- Header  -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><b>PhoneHA</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    &nbsp;
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
                    </li>
                    &nbsp;
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="product.php" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sản phẩm
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach($loai_dien_thoai2 as $loai_dien_thoai) : ?>
                            <a class="dropdown-item"
                                href="<?= BASE_URL_PATH ."product.php?id=".$loai_dien_thoai->getId()?>"
                                value="<?= $loai_dien_thoai->getId() ?>">
                                <?= $loai_dien_thoai->ten_loai ?>
                            </a>
                            <?php endforeach ?>
                        </div>
                    </div>
                    &nbsp;
                    <li class="nav-item">
                        <a class="nav-link active" href="news.php">Tin tức</a>
                    </li>
                </ul>
                <form action="product.php" class="d-flex">
                    <input id="myInput" class="form-control me-2" type="search" id="search" name="search"
                        value="<?php if(isset($_GET['search'])){ echo($_GET['search']);}?>"
                        placeholder="Tìm kiếm sản phẩm" size="30">
                    <button class="btn btn-outline-success me-1" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    &nbsp;
                </form>
                <button id="myBtnCart" class="btn btn-outline-success me-5 d-flex align-items-center" type="button">
                    <a href="cart.php" class="align-items-center" style="text-decoration: none; color: #000;">
                        <i class="fas fa-shopping-cart"></i>
                        <span class='badge badge-warning' id='lblCartCount'>
                            <?php 
                                    if(isset($count)){
                                        echo $count;
                                    }  else {echo 0;} 
                                ?>
                        </span>
                    </a>
                </button>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if(!isset($_SESSION['ten'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="login.php">Đăng nhập</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="signup.php">Đăng ký</a>
                            </li>
                        <?php endif ?>
                        <?php if(isset($_SESSION['ten'])) : ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link active item-header_user dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; color: #F2B686;">
                                    <i class="fa-regular fa-user"></i> <?php echo $_SESSION['ten'] ?>
                                </a>
                            
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width: 8rem;">
                                    <li>
                                        <form action="<?= BASE_URL_PATH . 'logout.php' ?>" method="post">
                                            <input type="submit" class="btn btn-danger btn-block mx-3" value="Đăng Xuất">
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Header  -->