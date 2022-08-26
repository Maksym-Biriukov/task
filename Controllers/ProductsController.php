<?php
require_once "Models/Product.php";


$cart = function() use ($Product){
    if($_SERVER['REQUEST_METHOD']=='GET' ){
        $products=$Product['all']();
        
        require_once "Views/Cart/cart.php";

    }
}


?>