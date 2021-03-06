<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Bank</title>

        <!-- Vuetify CSS -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <script>
            window.currency = @json(currency()->getCurrencies());

            if(localStorage.default_currency){
                window.default_currency = localStorage.default_currency;
            }else {
                window.default_currency = @json(config('currency.default'));
                localStorage.default_currency = @json(config('currency.default'));
            }
        </script>
    </head>
    <body>
        <div id="app"></div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
