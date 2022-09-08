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
        <form action="<?=route('manager.logout');?>" method="post" class="d-flex flex-row justify-content-end me-3 mt-2 gap-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addproduct">Add product</button>
            <a href="{{route('sessions')}}" class="btn btn-success">Your sessions</a>
            <input type="submit"  class="btn btn-danger" name="logout_form" value="Logout">
        </form>
        <div class="container text-center mt-3 ">
            <div class="row">
                <form method="post" action="<?=route('cart.add')?>">
                    <div class="input-group">
                    <input type="text" class="form-control product_code_to_add" placeholder="Enter product's code" name="products_add_code">
                    <input type="text" class="form-control product_count_to_add" placeholder="Enter product's count" name="products_add_count">
                    <input class="btn btn-primary" type="submit" id="button-addon2" name="products_add_button"  value="Add   ">
                    </div>
                </form>
                @if (session()->has('errors'))
                    <script>
                        alert("{{session()->pull('errors')}}");
                    </script>
                @endif
                <div class=" mt-3">
                    <table class="table table-bordered table_cart">
                        <th>
                        SQU    
                        </th>
                        <th>
                        Name
                        </th>
                        <th>
                        Count      
                        </th>
                        <th>
                        Cost     
                        </th>
                     <?php
                        // dd(session()->get('cart'));
                        foreach (session()->get('cart') as $product){
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
                                <?=$product['cost']*$product['count'];?>
                                </td>
                                <td>
                                <a href="<?=route('cart.delete_position', ['id' => $product['id']])?>" class="btn btn-danger">x</a>
                                </td>
                            </tr>
                            
                
                            <?php
                        }
                        ;
                        ?>
                    
                
                    </table>
                    <form action="{{route('cart.clear')}}" method="post">
                        <input type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#payment" value="Payment">
                        <input type="submit" class="btn btn-danger" value="Clear">
                    </form>
                
                    <div class="modal fade" id="payment" tabindex="-1" aria-labelledby="paymentLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentLabel">Total sum</h5>
                            </div>
                            <div class="modal-body row justify-content-center">
                                <p class="total_sum_output" >{{$totalSum}} PLN</p>
                                <form action="{{route('payment.card')}}" method="post" class="col-2">
                                    <input type="hidden" name="totalSum" value="{{$totalSum}}">
                                    <input type="submit" class="btn btn-primary form-control" name="payment_type_card" value="Card">
                                </form>
                                <form action="{{route('payment.cash')}}" method="post" class="col-2">
                                    <input type="hidden" name="totalSum" value="{{$totalSum}}">
                                    <input type="submit" class="btn btn-primary form-control" name="payment_type_card" value="Cash">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary form-control" data-bs-dismiss="modal">Close</button>    
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
                <div class="col-5">
                        @php 
                        // dd($errors);
                        @endphp

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