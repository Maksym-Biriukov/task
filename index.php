<?php

require_once "vendor/autoload.php";
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$subdir = $_ENV['SUBDIR'];

require_once "Views/Common/head.php";
require_once "Config/DB.php";
require_once "Routes/route.php";



if (isset($_POST["product_count_form"])){
    
    $updateproduct = "UPDATE `products` 
    SET `count`=`count`+'".$_POST["count_of_product"]."'
    WHERE `products`.`id`=".$_POST["product_code"];
    echo $updateproduct;
    if ($conn->query($updateproduct) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    
    header("Location: /$subdir/cart");
}
else if(isset($_POST["product_add_new"])){
    $updateproduct = "INSERT INTO `products` (`name`,`cost`)
    VALUES ('".$_POST["product_name_new"]."','".$_POST["product_new_cost"]."')";
    
    echo $updateproduct;
    if ($conn->query($updateproduct) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    
    header("Location: /$subdir/cart");
} else{

?>
        
        

        
        
<?php }
require_once "Views/Common/end.php";
$conn->close();
 ?>