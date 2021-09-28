<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vault</title>

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
                    var password = $("#create_password").val();
                    var retype_password = $("#create_retype_password").val();
                    var password_type = $("#create_password_type").val();

                    if (!title) {
                        $("#create_title_info").html("required.");
                        $("#create_title").addClass("input-error");
                        valid = false;
                    }
                    if (!password) {
                        $("#create_password_info").html("required.");
                        $("#create_password").addClass("input-error");
                        valid = false;
                    }
                    if (!retype_password) {
                        $("#create_retype_password_info").html("required.");
                        $("#create_retype_password").addClass("input-error");
                        valid = false;
                    }
                    if (password !== retype_password) {
                        $("#create_retype_password_info").html("not matching.");
                        $("#create_retype_password").addClass("input-error");
                        valid = false;
                    }
                    if (!password_type) {
                        $("#create_password_type_info").html("required.");
                        $("#create_password_type").addClass("input-error");
                        valid = false;
                    }
                    return valid;

                });

            });

    </script>

    <!--update Popup-->
    <script>
        function showInfoPopupForUpdate(title, password_type) {
            $("#update_title").val(title);
            $("#update_popup").show();
        }
        $(document).ready(
            function () {
                $("#btn_hide_update_popup").click(function () {
                    location.reload();
                });

                //Form validation on click event
                $("#update_form").on("submit", function () {
                    var valid = true;
                    $(".info").html("");
                    $("input-box").removeClass("input-error");

                    var title = $("#update_title").val();
                    var password = $("#update_password").val();
                    var retype_password = $("#update_retype_password").val();
                    var password_type = $("#update_password_type").val();

                    if (!title) {
                        $("#update_title_info").html("required.");
                        $("#update_title").addClass("input-error");
                        valid = false;
                    }
                    if (password !== retype_password) {
                        $("#update_retype_password_info").html("not matching.");
                        $("#update_retype_password").addClass("input-error");
                        valid = false;
                    }
                    if (!password_type) {
                        $("#update_password_type_info").html("required.");
                        $("#update_password_type").addClass("input-error");
                        valid = false;
                    }
                    return valid;

                });

            });

    </script>

</head>

<body>
    <div id="wrapper" class="animate">

        <input id="btn_show_post_popup" type="button" value="+" class="btn btn-warning" />

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
                <h2 class="d-flex justify-content-left">Passwords</h2>
                <div id="divContent" style="height: 600px; position:relative;">
                    <div>
                        <table class="table table-sm">
                            <tr>
                                <th width="80px">No</th>
                                <th>Title</th>
                                <th>Encrypted Password</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </table>
                    </div>
                    <div id="divTable" style="max-height:100%;overflow:auto;">
                        <table id="tbl_content" class="table table-sm">
                            @if(!empty($passwords) && count($passwords))

                            @foreach($passwords as $key => $password)

                            <tr id="tr_{{$password['id']}}">

                                <td width="80px">{{ ++$key }}</td>

                                <td>{{ $password['title'] }}</td>

                                <td>{{ $password['password'] }}</td>

                                <td>{{ $password['password_type'] }}</td>

                                <td>
                                    <table>

                                        <td>
                                            <form action="{{ route('password_delete',$password['id']) }}" method="POST"
                                                type="hidden">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" name="password_delete"
                                                    class="btn btn-danger btn-sm" value="Delete" />
                                            </form>
                                        </td>

                                        <td>
                                            <input
                                                onclick="showInfoPopupForUpdate('{{ $password['title'] }}', '{{ $password['password_type'] }}')"
                                                class="btn btn-secondary btn-sm" type="submit"
                                                id="btn_show_update_popup" value=" Edit ">
                                        </td>

                                        <td>
                                            <form action="{{ route('show_password',$password['id']) }}" method="POST"
                                                type="hidden">
                                                @csrf
                                                @method('GET')
                                                <input type="submit" name="show_password" class="btn btn-primary btn-sm"
                                                    value="Show Password" />
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


    <!--create Popup-->
    <div id="post_popup">
        <form class="contact-form" action="{{ route('password_create') }}" id="create_form" method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="d-flex justify-content-start">
                <button id="btn_hide_post_popup" type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h3 class="d-flex justify-content-center">New Password</h3>
            <div>
                <div>
                    <label>Title: </label><span id="create_title_info" class="popup-form"></span>
                </div>
                <div>
                    <input type="text" id="create_title" name="title" class="input-box" />
                </div>
            </div>
            <div>
                <div>
                    <label>Password: </label><span id="create_password_info" class="popup-form"></span>
                </div>
                <div>
                    <input type="password" id="create_password" name="password" class="input-box" />
                </div>
            </div>
            <div>
                <div>
                    <label>Retype Passwod: </label><span id="create_retype_password_info" class="popup-form"></span>
                </div>
                <div>
                    <input type="password" id="create_retype_password" name="retype_password" class="input-box" />
                </div>
            </div>
            <div>
                <div>
                    <label>Choose a password Type: </label><span id="create_password_type_info"
                        class="popup-form"></span>
                </div>
                <div>
                    <select name="password_type" id="create_password_type" class="input-box">
                        @if(!empty($password_types) && count($password_types))
                        @foreach($password_types as $key => $password_type)
                        <option value={{ $password_type['id'] }}>{{ $password_type['title'] }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div>
                <input type="submit" id="create_ok" name="ok" value="OK" />
            </div>
        </form>
    </div>

    <!--update Popup-->
    @if(!empty($passwords) && count($passwords))
    <div id="update_popup">
        <form class="contact-form" action="{{ route('password_delete',$password['id']) }}" id="update_form"
            method="post">

            @csrf

            <div class="d-flex justify-content-start">
                <button id="btn_hide_update_popup" type="button" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <h3 class="d-flex justify-content-center">Update Password</h3>
            <div>
                <div>
                    <label>Title: </label><span id="update_title_info" class="popup-form"></span>
                </div>
                <div>
                    <input type="text" id="update_title" name="title" class="input-box" />
                </div>
            </div>
            <button type="button"  id="tgl_update_password" name="tgl_update_password" class="btn btn-outline-danger" data-toggle="collapse" data-target="#clp_update_password"
                aria-expanded="false" aria-controls="clp_update_password">
                <     Edit Password Too     >
            </button>
            <div class="collapse" id="clp_update_password" name="clp_update_password">
                <div>
                    <div>
                        <h2></h2>
                        <label>Password: </label><span id="update_password_info" class="popup-form"></span>
                    </div>
                    <div>
                        <input type="password" id="update_password" name="password" class="input-box" />
                    </div>
                </div>
                <div>
                    <div>
                        <label>Retype Passwod: </label><span id="update_retype_password_info" class="popup-form"></span>
                    </div>
                    <div>
                        <input type="password" id="update_retype_password" name="retype_password" class="input-box" />
                    </div>
                </div>
            </div>
            <div>
                <div>
                    <h2></h2>
                    <label>Choose a password Type: </label><span id="update_password_type_info"
                        class="popup-form"></span>
                </div>
                <div>
                    <select name="password_type" id="update_password_type" class="input-box">
                        @if(!empty($password_types) && count($password_types))
                        @foreach($password_types as $key => $password_type)
                        <option value={{ $password_type['id'] }}>{{ $password_type['title'] }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div>
                <input type="submit" id="update_ok" name="ok" value="OK" />
            </div>
        </form>
    </div>
    @endif

    @jquery
    @toastr_js
    @toastr_render

</body>

</html>
