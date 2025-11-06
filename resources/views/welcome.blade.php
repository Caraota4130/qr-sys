<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class=" p-5">
        <div class="card">
            <div class="card-header">
                <h1><i class="bi bi-cloud-haze2"></i></h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" name="" id="" class="form-control" placeholder="">
                            <label for="">AA</label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-floating">
                            <input type="text" name="" id="" class="form-control" placeholder="">
                            <label for="">AA</label>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-full">
                        <div class="form-floating">
                            <input type="text" name="" id="" class="form-control" placeholder="">
                            <label for="">AA</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
