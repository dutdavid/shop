

<?php
include 'include/db_connection.php';
session_start();

$sql = "DELETE FROM `stock_mobile` WHERE id='".$_GET["id"]."'";
$res = $conn->query($sql) ;
 $_SESSION['success']=' Record Successfully Deleted';
?>
<script>
//alert("Delete Successfully");
window.location = "view.php";
</script>

