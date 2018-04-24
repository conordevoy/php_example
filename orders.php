<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">    
</head>
<body>
<?php include 'header.php';?> <!--PHP coded with the help of w3schools tutorials-->

<?php 
require_once 'dbconfig.php';

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT orderNumber, orderDate, status FROM orders WHERE status='In Process'");
$stmt->execute();
    
$resultInProcess = $stmt->fetchAll();
?>
    
<div class="wrapper">
    <div class="tableformat">
        <table>
            <tr><th class='heads' colspan='3'>Orders in Process</th></tr>
            <tr><th>Order Number</th><th>Order Date</th><th>Status</th></tr>
            <?php
            foreach ($resultInProcess as $row) {
                echo "<tr><td><a href='orders.php?orderid=".$row['orderNumber']."#bottom'>".$row['orderNumber']."</a></td><td>".$row['orderDate']."</td><td>".$row['status']."</td></tr>"; 
            }
            ?>
        </table>
    </div>
</div>
    
<?php 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT orderNumber, orderDate, status FROM orders WHERE status='Cancelled'");
$stmt->execute();
    
$resultCancelled = $stmt->fetchAll();
?>
    
<div class="wrapper">
    <div class="tableformat">
        <table>
            <tr><th class='heads' colspan='3'>Orders Cancelled</th></tr>
            <tr><th>Order Number</th><th>Order Date</th><th>Status</th></tr>
            <?php
            foreach ($resultCancelled as $row) {
                echo "<tr><td><a href='orders.php?orderid=".$row['orderNumber']."#bottom'>".$row['orderNumber']."</a></td><td>".$row['orderDate']."</td><td>".$row['status']."</td></tr>"; 
            }
            ?>
        </table>
    </div>
</div>
    
<?php 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT orderNumber, orderDate, status FROM orders ORDER BY orderNumber DESC LIMIT 20");
$stmt->execute();
    
$resultRecent = $stmt->fetchAll();
?>
    
<div class="wrapper">
    <div class="tableformat">
        <table>
            <tr><th class='heads' colspan='3'>Last 20 Orders</th></tr>
            <tr><th>Order Number</th><th>Order Date</th><th>Status</th></tr>
            <?php
            foreach ($resultRecent as $row) {
                echo "<tr><td><a href='orders.php?orderid=".$row['orderNumber']."#bottom'>".$row['orderNumber']."</a></td><td>".$row['orderDate']."</td><td>".$row['status']."</td></tr>"; 
            }
            ?>
        </table>
    </div>
</div>

<?php
    if(isset($_GET['orderid'])){
        $orderid = $_GET['orderid'];
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT P.productCode, P.productLine, P.productName, O.comments FROM orders O JOIN orderdetails OD ON O.orderNumber = OD.orderNumber JOIN products P ON OD.productCode = P.productCode WHERE OD.orderNumber = '$orderid'");
        $stmt->execute();

        $resultOrder = $stmt->fetchAll();
}
?>
    
<div class="wrapper">
    <div class="tableformat">
        <table id="bottom">
            <?php
            if(isset($_GET['orderid'])){
                echo "<tr><th colspan='3'>Individual Order Details for ".$orderid."</th></tr><tr><th>Product Code</th><th>Product Line</th><th>Product Name</th></tr>";
                foreach ($resultOrder as $rows) {
                    echo "<tr><td>".$rows['productCode']."</td><td>".$rows['productLine']."</td><td>".$rows['productName']."</td></tr>"; 
                }
                if($rows['comments'] != NULL){
                    echo "<tr><td>Comments</td><td colspan='2'>".$rows['comments']."</td>";
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