<?php
require_once "Config/DB.php";
require_once "Routes/route.php";

die("dfghsikfyhoasikdfhiko");

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

    
    header("Location: /");
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

    
    header("Location: /");
} else{

?>

<html>
    <head>
       
    </head>
    <body>
        <style>
            p{
                margin-bottom: 0!important;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/styles/SiteStyle.css" rel="stylesheet">
        <div class="d-flex justify-content-center">
            <form ><br>
                <div class="form-floating ">
                    <input type="text" class="form-control" id="floatingInput" placeholder="login">
                    <label for="floatingInput">Login</label>
                </div>
                <br>
                <div class="form-floating ">
                    <input type="text" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <br>        
                <input type="submit" id="enterence" value="Login in" class="btn btn-success">
            </form>
        </div>
        <br>        
        <div class="d-flex justify-content-center" >
            <form action="index.php" method="post">
                <div class="input-group">
                    <input required type="text" id="product_name_new" name="product_code" class="form-control" placeholder="Product's code">
                    <input required type="text" id="product_new_cost" name="count_of_product" class="form-control" placeholder="Count">
                    <input  type="submit" class="btn btn-primary" id="addProduct" value="Add product" name="product_count_form">
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-center" >
            <form action="index.php" method="post">
                <div class="input-group">
                    <input required type="text" id="product_name_new" name="product_name_new" class="form-control" placeholder="Product's name">
                    <input required type="text" id="product_new_cost" name="product_new_cost" class="form-control" placeholder="Cost">
                    <input type="submit" class="btn btn-primary" id="product_add_new" value="Add new product" name="product_add_new">
                </div>
            </form>
        </div>

        <div class="col-4">
            <form action="index.php" class="input-group col-4">
                <input type="text" id="product_search" class="form-control col-4">
                <input type="button" value="Search" class="btn btn-primary">
            </form>
        </div>
        <?php
        $show_db = "SELECT id, name, cost, count FROM products";
        $result = $conn->query($show_db);
        ?>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>id</th><th>name</th><th>count</th><th>cost</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <tr>
                        <td><?php echo $row["id"]?></td><td><?php echo $row["name"]?></td><td><?php echo $row["count"]?></td><td><?php echo $row["cost"]?></td>
                    </tr>
        
                    <?php
        
                }
            } else {
  
            }
            ?>
        </table>
        
    <body>
</html>


<?php }
$conn->close();
 ?>