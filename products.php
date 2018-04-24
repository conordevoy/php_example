<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">    
</head>
<body>    
<?php include 'header.php';?> <!--PHP coded with the help of w3schools tutorials-->
<?php
    require_once 'dbconfig.php';
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT productLine FROM productlines");
    $stmt->execute();

    $result = $stmt->fetchAll();
    $resultProduct = [];
?>
    
<div class="wrapper">
    <div class="tableformat">
        <form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Products:
            <select name="products" id="productDrop">
                <?php
                foreach ($result as $row) {
                    echo "<option value='".$row['productLine']."'>".$row['productLine']."</option>"; 
                }
                ?>
            </select>
            <input type="submit">
        </form>
    </div>
</div>
    
<?php    
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = $_POST['products'];

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT productName, productDescription FROM products WHERE productLine='$product'");
    $stmt->execute();

    $resultProduct = $stmt->fetchAll();
}
?>

<div class="wrapper">
    <div class="tableformat">
        <table>
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<tr><th>Product Line</th><th>Description</th></tr>";
                foreach ($resultProduct as $rows) {
                    echo "<tr><td>".$rows['productName']."</td><td>".$rows['productDescription']."</td></tr>"; 
                }
            }
            ?>
        </table>
    </div>
</div>
    
<?php
    $conn = null;
    include 'footer.php';
?>

</body>
</html>