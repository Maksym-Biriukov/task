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
        <div class="d-flex justify-content-center h-100 align-items-center">
            <form action="{{route('manager.login')}}" method="post">        
                @php
                // $var = session()->get("loginError");
                // dd($var);
                @endphp
                @if(($loginError = session()->get("loginError")) != "")
                    <div class="alert alert-danger" role="alert">{{$loginError}}</div>
                @endif
                
                <div class="form-floating ">
                    <input type="text" name="login" class="form-control" id="floatingInput" placeholder="login">
                    <label for="floatingInput">Login</label>
                </div>
                <br>
                <div class="form-floating ">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <br>        
                <input type="submit" id="enterence" name="login_form" value="Login in" class="btn btn-success">
            </form>
        </div>
    </body>
</html>