<?php
require_once __DIR__ . '/../bootstrap.php';
use CT275\Labs\dien_thoai;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//Xóa giỏ hàng
if (isset($_SESSION['carts'])) {
    if (isset($_GET['xoaall'])) {
        // Xóa toàn bộ giỏ hàng
        unset($_SESSION['carts']);
    } elseif (isset($_GET['xoa'])) {
        foreach ($_SESSION['carts'] as $key => $values) {
            if ($values['id'] == $_GET['xoa']) {
                unset($_SESSION['carts'][$key]);
                $_SESSION["carts"] = array_values($_SESSION["carts"]);
                break;
            }
        }
    }
    header("Location: cart.php");
}

// cộng số lượng sản phẩm
if(isset($_SESSION['carts'])&&isset($_GET['cong'])){
    foreach($_SESSION['carts'] as &$cart ) {
        if($cart['id'] == $_GET['cong'] && $cart['so_luong']<10) {
            $cart['so_luong'] += 1;
            break;
        }
    }
    header("Location:cart.php");
}

// trừ số lượng sản phẩm
if(isset($_SESSION['carts'])&&isset($_GET['tru'])){
    foreach($_SESSION['carts'] as &$cart) {
        if($cart['id'] == $_GET['tru'] && $cart['so_luong']>1) {
            $cart['so_luong'] -= 1;
            break;
        }
    }
    header("Location:cart.php");
}


// 
if(isset($_SESSION['carts'])&&isset($_GET['thanhtoan'])){
    foreach($_SESSION['carts'] as $key=>$values){
            unset($_SESSION['carts'][$key]);
            
    }
    $_SESSION["carts"] = array_values($_SESSION["carts"]);
    header("Location:cart.php");
} 





if(isset($_POST['addCart'])) {
// session_destroy();
    $id = $_GET['id'];
    $so_luong = 1;
    $dien_thoai = new dien_thoai($PDO);
    $row = $dien_thoai->have_id($id);

    if($row) {
        $add_cart = array(
            'id' => $id,
            'ten' => $row[0]->ten,
            'so_luong' => $so_luong,
            'gia' => $row[0]->gia,
            'hinh' => $row[0]->hinh
        );

        if(isset($_SESSION['carts'])) {
            $found = false;

            foreach($_SESSION['carts'] as &$cart) {
                if($cart['id'] == $id) {
                    $cart['so_luong'] += 1;
                    $found = true;
                }
            }

            if(!$found) {
                $_SESSION['carts'][] = $add_cart;
            }
        } else {
            $_SESSION['carts'][] = $add_cart;
        }
    }

    //print_r($_SESSION['carts']);
    $previous_url = $_SERVER['HTTP_REFERER'];

    header("Location:$previous_url");

}



?>