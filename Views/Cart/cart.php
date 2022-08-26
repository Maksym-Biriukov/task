<div class="container text-center mt-3">
<div class="row">
    <div class="input-group">
        <input type="text" class="form-control product_code_to_add" placeholder="Enter product's code" name="products_add_code">
        <input type="text" class="form-control product_count_to_add" placeholder="Enter product's count" name="products_add_count">
        <button class="btn btn-primary" type="button" id="button-addon2" name="products_add_button" onclick="add_to_cart()">Add</button>
    </div>
<div class="col mt-3">
    <table class="table table-bordered table_cart">
    <tr>
        <th>count</th>
        <th>name</th>
        <th>cost</th>
    </tr>
    

    </table>
</div>
<div class="col mt-3">
    
    <table class="table table-bordered all-products__table"><tr><th>SKU</th><th>Name</th><th>Count</th><th>Cost</th></tr>
    
        <?php
        
        foreach ($products as $product){
            ?>
            <tr>
                <td>
                <?=$product['id'];?>
                </td>
                <td>
                <?=$product['name'];?>
                </td>
                <td>
                <?=$product['count'];?>
                </td>
                <td>
                <?=$product['cost'];?>
                </td>
            </tr>
            

            <?php
        }
         ;
        ?>
    </table>
</div>
</div>
</div>