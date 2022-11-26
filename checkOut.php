<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--/*With help from Runoob.com*/-->
    <script src="http://static.runoob.com/assets/jquery-validation-1.14.0/lib/jquery.js"></script>
    <script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
    <title>Check Out</title>
</head>
<style type="text/css">           
    table {
        font-family:sans-serif;
        width: 90%;
        border-collapse: collapse;
        overflow: hidden;
    }
        
    th,td {
        height: 30px;
        line-height: 30px;
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
    <table align:"center">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        <?php
            session_start();
            $sum = 0;
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $i){
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
            <td colspan="4">
                <?php
                    echo "$sum";
                ?>
            </td>
        </tr>
    </table>
    <form class="detailForm" id="enterInfo" method="post" action="#" target="shopcart">
    <p>Please fill in the following details correctly</p>
    <table align:"center">
        <tr>
          <td for="name"><span style="color:red;">* </span>Name</td>
          <td><input id="name" name="01" class="required" minlength="2" type="text" placeholder="Dike Wang" required></td>
        </tr>
        <tr>
          <td for="address"><span style="color:red;">* </span>Address</td>
          <td><input id="address" name="02" minlength="2" type="text" placeholder="15 Broadway" required></td>
        </tr>
        <tr>
          <td for="suburb"><span style="color:red;">* </span>Suburb</td>
          <td><input id="suburb" name="03" minlength="2" type="text" placeholder="Sydney" required></td>
        </tr>
        <tr>
          <td for="state"><span style="color:red;">* </span>State</td>
          <td><input id="state" name="04" minlength="2" type="text" placeholder="NSW" required></td>
        </tr>
        <tr>
          <td for="country"><span style="color:red;">* </span>Country</td>
          <td><input id="country" name="05" minlength="2" type="text" placeholder="Australia" required></td>
        </tr>
        <tr>
          <td for="email"><span style="color:red;">* </span>Email</td>
          <td><input id="email" name="email" type="text" placeholder="DavidWang@gmail.com" required></td>
        </tr>
        <tr>
          <td colspan="2"><input class="submit" type="submit" value="Submit"></td>
        </tr>
    </table>
    </form>
    <?php
    $reply = "";
    if ( isset($_POST["email"]) )
    {
      $email = $_POST["email"];
      $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
      if ( preg_match( $pattern, $email ) )
      {
        $reply = "Thank you,Check has been send to your email.";
        $to = $email;
        $subject = "Checkout Mail";
        $message = "Thank you for purchasing our products.";
        $from = "westlifeloving@gmail.com";
        $headers = "From: $from";
        mail($to,$subject,$message,$headers);
      }
      else
      {
        $reply = "Please check the email address you entered.";
      }
    }
  ?>
  <?php
  echo $reply;
  ?>
</body>
</html>