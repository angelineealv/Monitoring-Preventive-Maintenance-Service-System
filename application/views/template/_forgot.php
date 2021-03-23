<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Forgot Password | Hyperdata</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

    <script src="<?= base_url("assets/js/plugin/webfont/webfont.min.js") ?>"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['<?= base_url("assets/css/fonts.min.css") ?>']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/atlantis.css") ?>">
</head>

<body class="login">
    <div class="wrapper wrapper-login">
        <div class="container container-login animated fadeIn content-log" style='padding: 100px; display: block; width: 500px;'>
            <h3 class="text-center">Change Password</h3>
            <div class="form-login">
                <form method="post" id="form-login" name="form-login">
                    <div class="form-group">
                        <label for="username" class="placeholder"><b>Username</b></label>
                        <input id="username" name="username" type="text" class="form-control" placeholder="Input Username" required>
                    </div>
                    <div class="form-group">
                        <div class="position-relative">
                            <label for="password1" class="placeholder"><b>New Password</b></label>
                            <div class="input-group">
                                <input id="password1" name="password1" type="password" class="form-control" placeholder="Input Password" required>
                                <div class="show-password my-auto" style="padding: 5px;">
                                    <i class="fas fa-eye fa-md"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="position-relative">
                            <label for="password2" class="placeholder"><b>Re-enter New Password</b></label>
                            <div class="input-group">
                                <input id="password2" name="password2" type="password" class="form-control" placeholder="Input Password" required>
                                <div class="show-password my-auto" style="padding: 5px;">
                                    <i class="fas fa-eye fa-md"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-action-d-flex mb-3">
                        <button type="submit" name="submit" class="btn btn-primary col-md-12 fw-bold"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Change Password</button>
                    </div>
                </form>
                <div class="login-account text-center">
                    <span class="msg">Already have an account ?</span>
                    <a href="<?= base_url('login') ?>" id="show-signup" class="link">Login now</a>
                </div>
                <div class="login-account text-center">
                    <span class="msg">Don't have an account yet ?</span>
                    <a href="<?= base_url('registeration') ?>" id="show-signup" class="link">Sign Up</a>
                </div>
                <br>
                <div class="login-account text-center">
                    <span class="msg">Training | <?= date("Y") ?></span>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url("assets/js/core/jquery.3.2.1.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/core/bootstrap.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/plugin/sweetalert/sweetalert.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/core/popper.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/atlantis.min.js") ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form-login').submit(function(e) {
                e.preventDefault();

                var username = $('#username').val();
                var password1 = $('#password1').val();
                var password2 = $('#password2').val();

                $.ajax({
                    url: '<?= base_url("forgot/auth") ?>',
                    type: 'post',
                    data: {
                        username: username,
                        password1: password1,
                        password2: password2
                    },
                    success: function(resp) {
                        if (resp == '1') {
                            swal("Success!", "Password change success, directing to Login Area!", {
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-success'
                                    }
                                },
                            });
                            location.reload();
                        } else if (resp == '2') {
                            swal("Failed!", "Username not found!!", {
                                icon: "error",
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-danger'
                                    }
                                },
                            });
                            $('#username').val("");
                            $('#email').val("");
                            $('#password1').val("");
                            $('#password2').val("");
                        } else if (resp == '3') {
                            swal("Failed!", "Password can't be old password!!", {
                                icon: "error",
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-danger'
                                    }
                                },
                            });
                            $('#username').val("");
                            $('#email').val("");
                            $('#password1').val("");
                            $('#password2').val("");
                        } else if (resp == '4') {
                            swal("Failed!", "Password is too short!!", {
                                icon: "error",
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-danger'
                                    }
                                },
                            });
                            $('#username').val("");
                            $('#email').val("");
                            $('#password1').val("");
                            $('#password2').val("");
                        } else if (resp == '5') {
                            swal("Failed!", "Password must contain alphabet and number!!", {
                                icon: "error",
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-danger'
                                    }
                                },
                            });
                            $('#username').val("");
                            $('#email').val("");
                            $('#password1').val("");
                            $('#password2').val("");
                        } else if (resp == '6') {
                            swal("Failed!", "Password doesn't match!!", {
                                icon: "error",
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-danger'
                                    }
                                },
                            });
                            $('#username').val("");
                            $('#email').val("");
                            $('#password1').val("");
                            $('#password2').val("");
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>