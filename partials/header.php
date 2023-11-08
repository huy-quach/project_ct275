<?php
require_once  '../bootstrap.php';
include_once __DIR__ . '/../function.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Trang chủ</title>

    <!-- FontAwesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!-- Bootstrap JS  -->
    <script src="./js/bootstrap.js"></script>

    <!-- Jquery JS  -->
    <script src="./js/jquery.js"></script>

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="./css/style.css">

    <!-- Custom CSS Page  -->
    <link rel="stylesheet" href="./css/custom.css">

    <!-- Design Font  -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
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
                        <a class="nav-link dropdown-toggle active" href="dien_thoai.php" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Sản phẩm
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- ?php foreach($loai_dien_thoai2 as $loai_dien_thoai) : ?  -->
                            <a class="dropdown-item" href="#">Action</a>
                            <!-- php endforeach  -->
                        </div>
                    </div>
                    &nbsp;
                    <li class="nav-item">
                        <a class="nav-link active" href="news.php">Tin tức</a>
                    </li>
                </ul>
                <form name="frm-search" class="d-flex">
                    <input id="myInput" class="form-control me-2" name="words" type="search"
                        placeholder="Tìm kiếm từ khóa..." aria-label="Search">
                    <button id="myBtnSearch" class="btn btn-outline-success" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    &nbsp;
                    <button id="myBtnCart" class="btn btn-outline-success" type="button">
                        <i class="fa fa-shopping-basket"></i>
                    </button>
                </form>
                <div class="d-flex ms-4">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="login.php">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active me-3" href="signup.php">Đăng ký</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Header  -->
   <script src=./js/custom.js></script>