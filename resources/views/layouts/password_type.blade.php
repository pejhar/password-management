<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Password Type</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <!--Popup-->
    <script src="{{ URL::asset('js/jquery-3.2.1.min.js'); }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('css/style.css'); }}" />

    @toastr_css

    <!--create Popup-->
    <script>
        $(document).ready(
            function () {
                $("#btn_show_post_popup").click(function () {
                    $("#post_popup").show();
                });
                $("#btn_hide_post_popup").click(function () {
                    location.reload();
                });

                //Form validation on click event
                $("#create_form").on("submit", function () {
                    var valid = true;
                    $(".info").html("");
                    $("input-box").removeClass("input-error");

                    var title = $("#create_title").val();

                    if (!title) {
                        $("#create_title_info").html("required.");
                        $("#create_title").addClass("input-error");
                        valid = false;
                    }
                    return valid;

                });

            });

    </script>

    @toastr_css

</head>

<body>
    <div id="wrapper" class="animate">

        <input id="btn_show_post_popup" type="button" value="+" class="btn btn-warning" />
        <div style="padding: 0px 15px; margin: auto; width: 40%;">
            <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand">{{ session('user.username', 'User Name')}}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav animate side-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('list_password') }}" title="Passwords"><i
                                    class="fas fa-lock"></i> Passwords <i class="fas fa-lock shortmenu animate"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('list_type_password') }}" title="Types"><i
                                    class="fas fa-list"></i> Types <i class="fas fa-list shortmenu animate"></i></a>
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
                <!--container-->
                <div class="container">
                    <h2 class="d-flex justify-content-left">Password Types</h2>
                    <div id="divContent" style="height: 600px;position:relative;">
                        <div>
                            <table class="table table-sm">
                                <tr>
                                    <th>No</th>
                                    <th>Password Type</th>
                                    <th>Action</th>
                                </tr>
                            </table>
                        </div>
                        <div id="divTable" style="max-height:100%;overflow:auto;">

                            <table class="table table-sm">

                                @if(!empty($password_types) && count($password_types))

                                @foreach($password_types as $key => $password_type)

                                <tr id="tr_{{$password_type['id']}}">

                                    <td>{{ ++$key }}</td>

                                    <td>{{ $password_type['title'] }}</td>

                                    <td>
                                        <table>

                                            <td>
                                                <form action="{{ route('password_type_delete',$password_type['id']) }}"
                                                    method="POST" type="hidden">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" name="login" class="btn btn-danger btn-sm"
                                                        value="Delete" />
                                                </form>
                                            </td>

                                        </table>

                                    </td>

                                </tr>

                                @endforeach

                                @endif

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!--create Popup-->
    <div id="post_popup">
        <form class="contact-form" action="{{ route('password_type_create') }}" id="create_form" method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="d-flex justify-content-start">
                <button id="btn_hide_post_popup" type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h3 class="d-flex justify-content-center">New Password Type</h3>
            <div>
                <div>
                    <label>Title: </label><span id="create_title_info" class="popup-form"></span>
                </div>
                <div>
                    <input type="text" id="create_title" name="title" class="input-box" />
                </div>
            </div>
            <div>
                <input type="submit" id="create_ok" name="ok" value="OK" />
            </div>
        </form>
    </div>

    @jquery
    @toastr_js
    @toastr_render

</body>

</html>
