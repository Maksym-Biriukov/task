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
            <a href="{{route('cart.page')}}" class="btn btn-success">Cart</a>
            <a href="{{route('allcoupons')}}" class="btn btn-success">All coupons</a> 
            <input type="submit"  class="btn btn-danger" name="logout_form" value="Logout">
        </form>
        <hr>
        <div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="addproductLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addproductLabel">Add Product</h5>
                    </div>
                    <div class="modal-body">
                    <form action="<?=route('product.create')?>" method="post" enctype="multipart/form-data">
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
                                required
                                type="text"
                                id="product_new_cost"
                                name="category_id"
                                class="form-control"
                                placeholder="Category code"
                            />
                            <input
                                type="file" accept=".jpg" 
                                class="form-control" 
                                name="products_image"
                                id="products_image"
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
                    <div class="modal-footer mb-3">
                        <form action="<?=route('catrgoryAdd')?>" method="post">
                            <div class="input-group">
                                <input
                                    required
                                    type="text"
                                    id="category_name"
                                    name="category_name"
                                    class="form-control"
                                    placeholder="Name of category"
                                />
                                <input
                                    type="submit"
                                    class="btn btn-primary"
                                    id="addCategory"
                                    value="Add category"
                                    name="category_add_form"
                                    
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- @dd($products); --}}
        <div class="container mb-3">
            <div class="row">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 mb-5 mt-5">
                    <div class="card" style="width: 18rem; height: 30rem;">
                        <img src="{{asset('storage/images/'.$product->picture_file_name)}}?>" class="card-img-top" alt="Image not found">
                        <div class="card-body">
                            <h5 class="card-title"><?=$product->name;?></h5>
                            <p class="card-text">Category: <?=$product->category;?></p>
                            <p class="card-text">Cost: <?=$product->cost;?></p>
                            <p class="card-text">Count: <?=$product->count;?></p>
                        </div>
                    </div>
                </div>      
            @endforeach
            </div>
        </div>
    </body>
</html>