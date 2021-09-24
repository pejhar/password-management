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
            padding: 90px 15px;
        }

        .navbar-expand-lg .navbar-nav.side-nav {
            flex-direction: column;
        }

        .card {
            margin: auto;
            margin-bottom: 15px;
            border-radius: 0;
            box-shadow: 0 3px 5px rgba(0, 0, 0, .1);
        }

        .header-top {
            box-shadow: 0 3px 5px rgba(0, 0, 0, .1)
        }

        .leftmenutrigger,
        .navbar-nav li a .shortmenu {
            display: none
        }

        .card-title {
            font-size: 28px
        }

        @media(min-width:992px) {
            #wrapper {
                padding: 90px 15px 15px 75px;
            }

            .navbar-nav.side-nav:hover {
                left: 0;
            }

            .side-nav li a {
                padding: 20px
            }

            .navbar-nav li a .shortmenu {
                float: right;
                display: block;
                opacity: 1
            }

            .navbar-nav.side-nav:hover li a .shortmenu {
                opacity: 0
            }

            .navbar-nav.side-nav {
                background: #585f66;
                box-shadow: 2px 1px 2px rgba(0, 0, 0, .1);
                position: fixed;
                top: 56px;
                flex-direction: column !important;
                left: -140px;
                width: 200px;
                overflow-y: auto;
                bottom: 0;
                overflow-x: hidden;
                padding-bottom: 40px
            }
        }

        .animate {
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            -ms-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out
        }

        .navbar-nav li a svg {
            font-size: 25px;
            float: left;
            margin: 0 10px 0 5px;
        }

        .side-nav li {
            border-bottom: 1px solid #50575d;
        }

    </style>
</head>

<body>
    <div id="wrapper" class="animate">
        <div class="row">
            <div class="card">
                <div class="card-body">

                    <img src="{{ URL::to('/assets/img/login.png') }}">

                    <form action="{{ route('login') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Enter UserName</label>
                            <input type="text" name="username" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Enter Password</label>
                            <input type="password" name="password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" class="btn btn-primary" value="LOG IN" />
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