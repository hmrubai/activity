<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DGDA Activity Tracker </title>
    <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/timePicker.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="js/axios.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">

    <script type="text/javascript" src="js/jquery-timepicker.js"></script>
    <script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
    <link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>

    <link rel="shortcut icon" href="images/favicon.png" />
    <meta name="csrf-token" content="">
    <script>
        window.myToken = <?php echo json_encode(['csrfToken' => csrf_token(), ]); ?>
    </script>
</head>
<body>
    <div class="container-scroller">
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ route('home') }}">
                    <img src="images/jclogo.png" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}">
                    <img src="images/jclogo.png" alt="logo" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
                    <li class="nav-item" id="home">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="mdi mdi-home"></i>Home</a>
                    </li>
                    <li class="nav-item" id="home">
                        <a href="{{ route('entryActivity') }}" class="nav-link">
                            <i class="mdi mdi-note-plus"></i>Entry activity</a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-toggle="dropdown">
                            <i class="mdi mdi-bell"></i>
                            <span class="count">1</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <a class="dropdown-item">
                                <p class="mb-0 font-weight-normal float-left">You have 1 new notifications </p>
                                <span class="badge badge-pill badge-warning float-right">View all</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-alert-circle-outline mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-medium text-dark">Data Entry Successful</h6>
                                    <p class="font-weight-light small-text"> Just now </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li> @if (Route::has('login')) <li class="nav-item dropdown d-none d-xl-inline-block"> @auth <a
                            class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <span class="profile-text">{{ Auth::user()->name }}</span>
                            <img class="img-xs rounded-circle" src="images/faces/user.png" alt="Profile image">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <a class="dropdown-item p-0">
                                <div class="d-flex border-bottom">
                                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                        <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                                    </div>
                                    <div
                                        class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                                        <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                                    </div>
                                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                        <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('user-profile') }}" class="dropdown-item mt-2"> Manage Profile </a>
                            <a class="dropdown-item"> Change Password </a>
                            <a href="{{ route('logout') }}" class="dropdown-item"> Sign Out </a>
                        </div> @endauth
                    </li> @endif
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <div class="nav-link">
                            <div class="user-wrapper">
                                <div class="profile-image">
                                    <img src="images/faces/user.png" alt="profile image">
                                </div>
                                <div class="text-wrapper">
                                    <p class="profile-name">{{ Auth::user()->name }}</p>
                                    <div>
                                        <small class="designation text-muted">Admin</small>
                                        <span class="status-indicator online"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="menu-icon mdi mdi-home"></i>
                            <span class="menu-title">Home</span>
                        </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('entryActivity') }}">
                            <i class="menu-icon mdi mdi-note-plus"></i>
                            <span class="menu-title">Entry activity</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="main-panel"> @yield("content") </div>
        </div>
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>
        <style>
            .sidebar .nav .nav-item .nav-link .menu-title {
                font-size: 14px !important;
            }

            .navbar.default-layout .navbar-brand-wrapper .navbar-brand img {
                width: 89% !important;
                max-width: 89% !important;
                height: 100% !important;
                margin: auto;
                vertical-align: middle;
            }

            .form-group label {
                font-size: 15px !important;
            }

            .form-control {
                font-size: 14px !important;
            }

            .sidebar .nav .nav-item .nav-link {
                padding: 16px 7px !important;
            }

            .sidebar .nav .nav-item .nav-link .menu-icon {
                width: 5px !important;
            }
            .navbar.default-layout {
                font-family: "Poppins", sans-serif;
                /* background: linear-gradient(120deg, #276696, #001f35) !important; */
                background: linear-gradient(120deg, #03481f, #469867) !important;
            }

        </style>
</body>
</html>
