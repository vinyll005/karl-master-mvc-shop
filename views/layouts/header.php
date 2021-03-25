<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Karl - Fashion Ecommerce Template | Home</title>

    <!-- Favicon  -->
    <link rel="icon" href="/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="/css/core-style.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <!-- Responsive CSS -->
    <link href="/css/responsive.css" rel="stylesheet">

</head>

<body>

    <div class='login-form' id='login'>
        <a href="#" id='exitLoginBtn'><i class="ti-close login-icon"></i></a>

        <div class='input-div'>
            <h2 class="input-head">Login</h2>

            <form action="" method="POST" id="loginForm">
                <!-- <p>Username</p> -->
                <!-- <input type="text" name="login" placeholder="Type your username"> -->

                <input type="email" name="email" placeholder="Type your email" class="loginEmail">

                <!-- <p>Password</p> -->
                <input type="password" name="password" placeholder="Type your password" class="loginPassword">

                <input type='submit' class='login-button' name='submit' value='Login'>
                <p class='not-register-text'>Still not <a href='#' id='registration'>register</a>?</p>
            </form>
        </div>
    </div>

    <div class='login-form' id='register'>
        <a href="#" id='exitRegisterBtn'><i class="ti-close login-icon"></i></a>

        <div class='input-div'>
            <h2 class="input-head">Register</h2>
            <form action="register" method="POST" id="registerForm" >
                <!-- <p>Username</p> -->
                <input type="text" name="name" placeholder="Type your username">

                <input type="email" name="email" placeholder="Type your email *" class="loginEmail">

                <!-- <p>Password</p> -->
                <input type="password" name="password" placeholder="Type your password *" class="loginPassword">

                <input type='submit' class='login-button' name='submit' value='Register' id='regBut'>
                <p class='not-register-text'>Already <a href='#' id='loggingIn'>register</a>?</p>
            </form>
        </div>
    </div>

    <div id="wrapper">

        <!-- ****** Header Area Start ****** -->
        <header class="header_area">
            <!-- Top Header Area Start -->
            <div class="top_header_area">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-end">

                        <div class="col-12 col-lg-7">
                            <div class="top_single_area d-flex align-items-center">
                                <!-- Logo Area -->
                                <div class="top_logo">
                                    <a href="/"><img src="/img/core-img/logo.png" alt=""></a>
                                </div>
                                <!-- Cart & Menu Area -->
                                <div class="header-cart-menu d-flex align-items-center ml-auto">
                                    <!-- Cart Area -->
                                    <div class="cart">
                                        <a href="#" id="header-cart-btn" target="_blank"><span
                                                class="cart_quantity">2</span> <i class="ti-bag"></i> Your Bag $20</a>
                                        <!-- Cart List Area Start -->
                                        <ul class="cart-list">
                                            <li>
                                                <a href="#" class="image"><img src="img/product-img/product-10.jpg"
                                                        class="cart-thumb" alt=""></a>
                                                <div class="cart-item-desc">
                                                    <h6><a href="#">Women's Fashion</a></h6>
                                                    <p>1x - <span class="price">$10</span></p>
                                                </div>
                                                <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                                            </li>
                                            <li>
                                                <a href="#" class="image"><img src="img/product-img/product-11.jpg"
                                                        class="cart-thumb" alt=""></a>
                                                <div class="cart-item-desc">
                                                    <h6><a href="#">Women's Fashion</a></h6>
                                                    <p>1x - <span class="price">$10</span></p>
                                                </div>
                                                <span class="dropdown-product-remove"><i class="icon-cross"></i></span>
                                            </li>
                                            <li class="total">
                                                <span class="pull-right">Total: $20.00</span>
                                                <a href="cart.html" class="btn btn-sm btn-cart">Cart</a>
                                                <a href="checkout-1.html" class="btn btn-sm btn-checkout">Checkout</a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <?php if(!empty($_SESSION['user']['name'])) { ?>
                                        <p class='user-name-header'><?php echo $_SESSION['user']['name']; ?></p>
                                        <?php if($_SESSION['user']['is_admin'] == 1)    { ?>
                                            <div class='admin-button-container'>
                                            <a href='/admin' class='header-user-exit admin-button'>Admin panel</a>
                                            </div>
                                        <?php } ?>
                                        <a href='/exit' class='header-user-exit'>Exit</a>
                                    <?php } else { ?>
                                        <div class="header-right-side-menu ml-15">
                                            <a href="#" id="loginBtn"><i class="ti-power-off" aria-hidden="true"></i></a>
                                        </div>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Top Header Area End -->
            <div class="main_header_area">
                <div class="container h-100">
                    <div class="row h-100">
                        <div class="col-12 d-md-flex justify-content-between">
                            <!-- Header Social Area -->
                            <div class="header-social-area">
                                <a href="#"><span class="karl-level">Share</span> <i class="fa fa-pinterest"
                                        aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            </div>
                            <!-- Menu Area -->
                            <div class="main-menu-area">
                                <nav class="navbar navbar-expand-lg align-items-start">

                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#karl-navbar" aria-controls="karl-navbar" aria-expanded="false"
                                        aria-label="Toggle navigation"><span class="navbar-toggler-icon"><i
                                                class="ti-menu"></i></span></button>

                                    <div class="collapse navbar-collapse align-items-start collapse" id="karl-navbar">
                                        <ul class="navbar-nav animated" id="nav">
                                            <li class="nav-item active"><a class="nav-link" href="/">Home</a></li>
                                            <li class="nav-item active"><a class="nav-link" href="/shop">Shop</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#">Dresses</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#"><span
                                                        class="karl-level">hot</span> Shoes</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <!-- Help Line -->
                            <div class="help-line">
                                <a href="tel:+346573556778"><i class="ti-headphone-alt"></i> +34 657 3556 778</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ****** Header Area End ****** -->