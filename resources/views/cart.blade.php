<!doctype html>

<html>
    <head>
        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}" defer></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
        <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container text-center mt-3">
            <div class="position-absolute top-0 end-0 mt-2 me-3">
                <form action="<?=route('login_page');?>" method="post">
                    <input type="submit"  class="btn btn-danger" name="logout_form" value="Logout" onclick="sessionStorage.clear()">
                </form>
            </div>
            <div class="row">
                <div class="input-group">
                    <input type="text" class="form-control product_code_to_add" placeholder="Enter product's code" name="products_add_code">
                    <input type="text" class="form-control product_count_to_add" placeholder="Enter product's count" name="products_add_count">
                    <button class="btn btn-primary" type="button" id="button-addon2" name="products_add_button" onclick="add_to_cart()">Add</button>
                </div>
                <div class="col mt-3">
                    <table class="table table-bordered table_cart">
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#payment" onclick="total_payment()">Payment</button>
                
                    <div class="modal fade" id="payment" tabindex="-1" aria-labelledby="paymentLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentLabel">Total sum</h5>
                            </div>
                            <div class="modal-body">
                                <p class="total_sum_output" ></p>
                            <input type="hidden" class="totalsum" value="sadasd">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary form-control" name="payment_type_cash" onclick="total_cash(totalSum)">Cash</button>
                                <button type="button" class="btn btn-primary form-control" name="payment_type_card" onclick="total_card(totalSum)">Card</button>
                                <button type="button" class="btn btn-secondary form-control" data-bs-dismiss="modal">Close</button>    
                            </div>
                        </div>
                    </div>
                    </div>
                    
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
                
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproduct">Add product</button>
                
                    <div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="addproductLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addproductLabel">Add Product</h5>
                                </div>
                                <div class="modal-body">
                                <form action="<?=route('product.create')?>" method="post">
                                    <div class="input-group">
                                        <input
                                            required
                                            type="text"
                                            id="product_name_new"
                                            name="product_name_new"
                                            class="form-control"
                                            placeholder="Product's name"
                                        />
                                        <input
                                            required
                                            type="text"
                                            id="product_new_cost"
                                            name="product_new_cost"
                                            class="form-control"
                                            placeholder="Cost"
                                        />
                                        <input
                                            type="submit"
                                            class="btn btn-primary"
                                            id="product_add_new"
                                            value="Add new product"
                                            name="product_add_new"
                                            
                                        />
                                    </div>
                                </form>
                                </div>
                                <div class="modal-footer mb-3">
                                    <form action="<?=route('product.add')?>" method="post">
                                        <div class="input-group">
                                            <input
                                                required
                                                type="text"
                                                id="product_code"
                                                name="product_code"
                                                class="form-control"
                                                placeholder="Product's code"
                                            />
                                            <input
                                                required
                                                type="text"
                                                id="product_count"
                                                name="product_count"
                                                class="form-control"
                                                placeholder="Count"
                                            />
                                            <input
                                                type="submit"
                                                class="btn btn-primary"
                                                id="addProduct"
                                                value="Add product's count"
                                                name="product_count_form"
                                                
                                            />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>