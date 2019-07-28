<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login</title>
    <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="vendors/css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
            <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
                <div class="row w-100">
                        <div class="col-lg-12 text-center logo_body">
                                <img src="images/dgda_logo.png" width="100px" alt="Logo"/>
                                <h3>DGDA</h3>
                                <h4>Directorate General of Drug Administration</h4>
                                <br/>
                                <br/>
                            </div>
                    <div class="col-lg-4 mx-auto">
                        <div class="auto-form-wrapper">
                            <form method="POST" action="{{ route('login') }}"> @csrf <div class="form-group">
                                    <label class="label">E-mail</label>
                                    <div class="input-group">
                                        <input type="text" name="email" required="required" class="form-control"
                                            placeholder="Email">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-check-circle-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" required="required" class="form-control"
                                            placeholder="*********">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-check-circle-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success submit-btn btn-block">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    .logo_body{
        color: #fff;
        margin-left: -29px;
        margin-top: -241px;
        position: fixed;
    }
    .auth.auth-bg-1 {
        background: #03481f !important;
        background-size: cover;
    }
    </style>
</body>
</html>
