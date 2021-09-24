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
    
    @toastr_css

</head>

<body>
    <div id="wrapper" class="animate">
        <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">{{ Session::get('user_name')?? "User Name"}}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav animate side-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" title="Dashboard"><i class="fas fa-lock"></i> My Vault <i
                                class="fas fa-lock shortmenu animate"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" title="My Vault"><i class="fas fa-list"></i> Types <i
                                class="fas fa-list shortmenu animate"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-md-auto d-md-flex">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-key"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Laravel 8</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Jassa</h6>
                            <p class="card-text">You can also try different version of Bootstrap V4 side menu. Click
                                below link to view all Bootstrap Menu versions.</p>
                            <a href="#" class="card-link">link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Laravel</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Jassa</h6>
                            <p class="card-text">You can also try different version of Bootstrap V4 side menu. Click
                                below link to view all Bootstrap Menu versions.</p>
                            <a href="#" class="card-link">link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @jquery
    @toastr_js
    @toastr_render

</body>

</html>