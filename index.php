<!DOCTYPE html>
<html>
<head>
    <title>Company DB</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">    
</head>
<body>
<?php include 'header.php';?>  <!--PHP coded with the help of w3schools tutorials-->
    
<?php
require_once 'dbconfig.php';

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT productLine, textDescription FROM productlines");
$stmt->execute();

$result = $stmt->fetchAll();
?>
    
<div class="wrapper">
    <div class="tableformat">
        <table>
            <tr><th>Product Line</th><th>Description</th></tr>
            <?php
            foreach ($result as $row) {
                echo "<tr><td>".$row['productLine']."</td><td>".$row['textDescription']."</td></tr>"; 
            }
            ?>
        </table>
    </div>
</div>

<?php
$conn = null;
echo "</table><br>";
echo '</div>';
echo '</div>';
?>
    
<?php include 'footer.php';?>
</body>
</html>