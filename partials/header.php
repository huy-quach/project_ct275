<?php
require_once '../bootstrap.php';
include __DIR__ . '/../function.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Trang chủ</title>

    <!-- Custom Css  -->
    <link rel="stylesheet" href=".//css/style.css">

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
</head>

<body>
    <style>

    </style>
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
                        <a class="nav-link dropdown-toggle active" href="product.php" id="navbarDropdown"
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
                    <input id="myInput" class="form-control me-2" type="search" placeholder="Tìm kiếm sản phẩm"
                        size="30">
                    <button id="myBtnSearch" class="btn btn-outline-success me-1" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    &nbsp;
                    <button id="myBtnCart" class="btn btn-outline-success me-5" type="button">
                        <i class="fa fa-shopping-basket"></i>
                    </button>
                </form>
                <div class="d-flex">
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
