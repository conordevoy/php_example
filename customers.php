<!DOCTYPE html>
<html>
<head>
    <title>Customers</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php include 'header.php';?> <!--PHP coded with the help of w3schools tutorials-->
    
<?php
    require_once 'dbconfig.php';
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT customerNumber, customerName, country FROM customers ORDER BY country");
    $stmt->execute();

    $result = $stmt->fetchAll();
?>
    
<div class="wrapper">
    <div class="tableformat">
        <table>
            <tr><th>Customers</th><th>Country</th></tr>
            <?php
            foreach ($result as $row) {
                echo "<tr><td><a href='customers.php?rowid=".$row['customerNumber']."#bottom'>".$row['customerName']."</a></td><td>".$row['country']."</td></tr>"; 
            }
            ?>
        </table>
    </div>
</div>
    
<?php
    if(isset($_GET['rowid'])){
        $rowid = $_GET['rowid'];
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT customerName, contactLastName, contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, country FROM customers WHERE customerNumber = '$rowid'");
        $stmt->execute();

        $resultCustomer = $stmt->fetchAll();
}
?>
    
<div class="wrapper">
    <div class="tableformat">
        <table id="bottom">
            <?php
            if(isset($_GET['rowid'])){
                foreach ($resultCustomer as $rows) {
                    echo "<tr><th colspan='2'>Individual Customer Details</th></tr><tr><td>Company Name</td><td>".$rows['customerName']."</td></tr><tr><td>Contact First Name</td><td>".$rows['contactLastName']."</td></tr><tr><td>Contact Last Name</td><td>".$rows['contactFirstName']."</td></tr><tr><td>Contact Phone Number</td><td>".$rows['phone']."</td></tr><tr><td>Address Line 1</td><td>".$rows['addressLine1']."</td></tr><tr><td>Address Line 2</td><td>".$rows['addressLine2']."</td></tr><tr><td>City</td><td>".$rows['city']."</td></tr><tr><td>State</td><td>".$rows['state']."</td></tr><tr><td>Post Code</td><td>".$rows['postalCode']."</td></tr><tr><td>Country</td><td>".$rows['country']."</td></tr>"; 
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