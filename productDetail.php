<?php
    $link = mysqli_connect("localhost","uts","internet","assignment1");
        if(!$link){
            echo "Error: cannot connect to server!";
            die;            
        }
        $query_string = "select * from products where product_id = ".$_GET["code"];
        $result = mysqli_query($link, $query_string);
        $rows = mysqli_num_rows($result);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <Title>Product Details</Title>
</head>
<style type="text/css">           
    table {
        font-size: 18px;  
        font-family:sans-serif;
        width: 90%;
        border-collapse: collapse;
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
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Stock</th>
            </tr>
            <?php                
                if($rows > 0){
                    while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$row['product_id']."</td>";
                    echo "<td>".$row['product_name']."</td>";
                    echo "<td>".$row['unit_price']."</td>";
                    echo "<td>".$row['unit_quantity']."</td>";
                    echo "<td>".$row['in_stock']."</td>";
                    echo "</tr>";
                    $purchased_id = $row['product_id'];
                    $purchased_name = $row['product_name'];
                    $purchased_price = $row['unit_price'];
                    $purchased_quantity = $row['unit_quantity'];
                    }
                }
            mysqli_close($link);
            ?>
        </table>
        <form name="purchaseProducts" id="purchase" action="/ass1/shoppingCart.php" method="POST" target="shopcart">
            <input type="number" id="a" name="customer_list">
            <input type="hidden" name="purchased_id" value="<?php echo "$purchased_id" ?>">
            <input type="hidden" name="purchased_name" value="<?php echo "$purchased_name" ?>">
            <input type="hidden" name="purchased_price" value="<?php echo "$purchased_price" ?>">
            <input type="hidden" name="purchased_quantity" value="<?php echo "$purchased_quantity" ?>">
            <input type="submit" id="shopping" value="Add">
            <p>Maximum 20</p>
        </form>
    </body>
</html>