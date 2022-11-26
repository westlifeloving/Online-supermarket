<?php
    session_start();
    $shoppingCart = @$_SESSION['cart'];
    $productID = @$_REQUEST['purchased_id'];
    $productName = @$_REQUEST['purchased_name'];
    $productPrice = @$_REQUEST['purchased_price'];
    $productQuantity = @$_REQUEST['purchased_quantity'];
    $productList = @$_REQUEST['customer_list'];
    if(empty($shoppingCart)){
        if(empty($productList)){
            echo "<p>Please choose the product and add to shopping cart</p>";
        }
    }
    if(!empty($productList)){
        if(empty($shoppingCart)){
            $shoppingCart[$productID] = array("id" => $productID, "name" => $productName, "price" => $productPrice, "quantity" => "$productQuantity", "qty" => $productList);
            $_SESSION['cart'] = $shoppingCart;
        }elseif(!array_key_exists($productID,$shoppingCart)){
            $shoppingCart[$productID] = array("id" => $productID, "name" => $productName, "price" => $productPrice, "quantity" => "$productQuantity", "qty" => $productList);
            $_SESSION['cart'] = $shoppingCart;
        }elseif(!empty($productList)){
            $shoppingCart[$productID]['qty'] = $shoppingCart[$productID]['qty'] + $productList;
            $_SESSION['cart'] = $shoppingCart;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <Title>Shopping Cart</Title>
</head>
<style type="text/css">           
    table {
        font-family:sans-serif;
        width: 90%;
        border-collapse: collapse;
        overflow: hidden;
    }
    
    th,td {
        height: 45px;
        line-height: 45px;
        text-align: center;
        border: 1px solid #eee;
    }
    
    th {
        font-weight: bold;
    }
    
    td {
        font-weight: bold;
    } 
</style>
<body>
    <table>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        <?php
            $sum = 0;
            if(isset($shoppingCart)){
                foreach($shoppingCart as $i){
                    echo "<tr>";
                    echo "<td>".$i['name']."</td>";
                    echo "<td>".$i['price']."</td>";
                    echo "<td>".$i['quantity']."</td>";
                    echo "<td>".$i['qty']."</td>";
                    echo "<td>".($i['price'] * $i['qty'])."</td>";
                    echo "</tr>";
                    $sum += $i['price'] * $i['qty'];
                }
            }
        ?>
        <tr>
            <th>Total</th>
            <td colspan="2">
                <?php
                    echo "$sum";
                ?>
            </td>
            <td>
                <form action="clearAll.php">
                    <input type="submit" value="Clear All">
                </form>
            </td>
            <td>
                <form action="checkOut.php" target="shopcart">
                    <input type="submit" value="Check Out">
                </form>
            </td>
        </tr>
    </table>
</body>
</html>