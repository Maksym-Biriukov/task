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
        <table class="table table-bordered all-products__table">
            <tr>
                <th>{{__("Cash Total")}}</th>
                <th>{{__("Card Total")}}</th>
                <th>{{__("Date Start")}}</th>
                <th>{{__("Date End")}}</th>
            </tr>
            
            @foreach ($sessions as $session)
                <tr>
                    <td>
                    <?=$session->cash_total;?>
                    </td>
                    <td>
                    <?=$session->card_total;?>
                    </td>
                    <td>
                    <?=$session->date_start;?>
                    </td>
                    <td>
                    <?=$session->date_end;?>
                    </td>
                </tr>
                
    
            @endforeach
        </table>
        <div class="row justify-content-center">
            <a href="{{route('cart.page')}}" class="btn btn-success col-2">Return</a>
        </div>
    </body>
</html>