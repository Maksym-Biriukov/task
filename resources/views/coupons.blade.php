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
            <a href="{{route('sessions')}}" class="btn btn-success">Your sessions</a>
            <a href="{{route('all')}}" class="btn btn-success">All products</a>
            <a href="{{route('cart.page')}}" class="btn btn-success">Cart</a>
            <input type="submit"  class="btn btn-danger" name="logout_form" value="Logout">
        </form>
        <hr>

    </body>
</html>