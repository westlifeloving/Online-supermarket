<?php
    session_start();
    $clearAll = $_REQUEST['id'];
    if(isset($clearAll)){
        unset($_SESSION['cart'][$clearAll]);
    }else{
        unset($_SESSION['cart']);
    }
    header("Location:shoppingCart.php");
?>