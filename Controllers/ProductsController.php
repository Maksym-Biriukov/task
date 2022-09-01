<?php
require_once "Models/Product.php";


$cart = function() use ($Product, $subdir){
    if($_SERVER['REQUEST_METHOD']=='GET' ){
        $products=$Product['all']();
        
        require_once "Views/Cart/cart.php";

    }
};
$product_add_count = function() use ($Product, $subdir, $conn){
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
else{
}
};
$product_add_new = function() use ($Product, $subdir, $conn){
if(isset($_POST["product_add_new"])){
    $updateproduct = "INSERT INTO `products` (`name`,`cost`)
    VALUES ('".$_POST["product_name_new"]."','".$_POST["product_new_cost"]."')";
    
    echo $updateproduct;
    if ($conn->query($updateproduct) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    
    header("Location: /$subdir/cart");
}
};
$payment= function() use ($Product, $subdir, $conn){
    if(isset($_GET["payment_type_cash"])){
        $sqlpr = "UPDATE `products` 
    SET `count`=`count`-'".["count_of_product"]."'
    WHERE `products`.`id`=".$_POST["product_code"];
    }elseif(isset($_GET["payment_type_cash"])){

    }
};

?>