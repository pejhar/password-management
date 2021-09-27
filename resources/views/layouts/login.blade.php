<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    
    @toastr_css

    <style>
        body {
            background: #f9f9f9;
        }

        #wrapper {
            padding: 50px 15px;
        }

        .card {
            margin: auto;
            margin-bottom: auto;
            width: 25%;
            height: 50%;
            border-radius: 0;
            box-shadow: 0 3px 5px rgba(0, 0, 0, .1);
        }

    </style>
</head>

<body>
    <div id="wrapper" class="animate">
        <div class="row">
            <div class="card">
                <img src="{{ URL::to('/assets/img/login.png') }}">
                <div class="card-body">

                    

                    <form action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Enter UserName</label>
                            <input type="text" name="username" pattern="[a-zA-Z0-9]+" required  class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Enter Password</label>
                            <input type="password" name="password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" class="btn btn-primary" required value="LOG IN" />
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    
    @jquery
    @toastr_js
    @toastr_render

</body>

</html>