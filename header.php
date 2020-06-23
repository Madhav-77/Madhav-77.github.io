<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome to Foodgasm</title>

    <!--title bar icons-->
    <link href="assets/images/image1.jpg" rel="icon">
    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <style>
        .img-carousel,
        .head {
            height: 650px !important;
        }

        .navbar-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10;
            /* padding-left: 15px; */
            /* padding-right: 15px; */
        }

        .dropdown-content {
            overflow: visible !important;
        }

        .input-field input[type=text]:focus {
            border-bottom: 1px solid #424242 !important;
            box-shadow: 0 1px 0 0 #424242 !important;
        }

        label.active {
            color: #424242 !important;
        }

        .center-text-img {
            position: relative;
            text-align: center;
            color: white;
        }

        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        h2 {
            font: 400 100px/1.5 'Pacifico', Helvetica, sans-serif;
            color: #2b2b2b;
            text-shadow: 3px 3px 0px rgba(0, 0, 0, 0.1), 7px 7px 0px rgba(0, 0, 0, 0.05);
            font-size: 72px;
            ;
        }

        .no-disp {
            display: none;
        }

        .validation-text {
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <ul id="user_drop" class="dropdown-content">
        <li><a href="logout.php">Logout</a></li>
    </ul>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <a href="index.php" class="brand-logo white-text" style="padding-left: 20px;">Foodgasm</a>
                <ul class="right hide-on-med-and-down">

                    <?php
                    if (isset($_SESSION['name'])) { //conditions for user roles for navbar
                        if ($_SESSION['user_type'] == 0) { ?>
                            <li><a href="home.php" class="white-text">Home</a></li>
                            <li><a href="restaurant.php" class="white-text">View Restaurants</a></li>
                            <li><a href="#view_cart" class="white-text">Veiw orders</a></li>
                            <li><a href="#view_orders" class="white-text">View Users</a></li>
                        <?php } else if ($_SESSION['user_type'] == 1) { ?>
                            <!-- <li><a href="home.php" class="white-text">Home</a></li> -->
                            <li><a href="view_restaurants.php" class="white-text">Restaurants</a></li>
                            <li><a href="view_orders.php" class="white-text">Orders</a></li>
                            <li><a href="cart.php" class="white-text">Cart</a></li>
                        <?php } else { ?>
                            <li><a href="view_orders.php" class="white-text">Veiw orders</a></li>
                            <li><a href="#add_items" class="white-text modal-trigger">Add Items</a></li>
                            <li><a href="restaurant.php" class="white-text">View Menu</a></li>
                            <!-- <li><a href="#view_orders" class="white-text">About Us</a></li> -->
                        <?php } ?>
                        <li><a class="dropdown-trigger white-text" href="#!" data-target="user_drop"><?= $_SESSION['name']; ?><i class="material-icons right">arrow_drop_down</i></a>
                        <?php } else /* if (session_status() == 1) */ {
                        ?>
                        <li><a href="index.php" class="white-text">Home</a></li>
                        <li><a href="view_restaurants.php" class="white-text">Restaurants</a></li>
                        <li><a href="#contact_us" class="white-text">Contact Us</a></li>
                        <li><a href="#about_us" class="white-text">About Us</a></li>
                        <?php
                        if (array_key_exists('name', $_SESSION)) { ?>
                            <li><a class="dropdown-trigger white-text" href="#!" data-target="user_drop"><?= $_SESSION['name']; ?><i class="material-icons right">arrow_drop_down</i></a>
                            <?php } else { ?>
                            <li><a href="#login_modal" class="white-text modal-trigger">Login</a></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Login modal -->
    <div id="login_modal" class="modal modal-fixed-footer" style="height: 70%; width: 40%;">
        <div class="modal-content">
            <h4 class="center">Login</h4>
            <div class="row">
                <form id="login" class="col s12" method="post">
                    <div class="row">
                        <div class="input-field col s12" style="margin-bottom: 0px;">
                            <p id="user_type_login" onchange="optionToggleLogin()">
                                <!-- onchange="regFormToggle()" -->
                                <label style="font-size: 1rem;">Are you a: </label>
                                <label>
                                    <input class="with-gap" name="u_type_login" type="radio" value="1" checked />
                                    <span>Customer?</span>
                                </label>
                                <label>
                                    <input class="with-gap" name="u_type_login" type="radio" value="2" />
                                    <span>Restaurant?</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <h6 id="login_text" class="center">Customer Login</h6>
                    <div class="row">
                        <div class="input-field col s12" style="margin-bottom: 0px;">
                            <input class="validate" id="login_email" name="login_email" type="email" required onchange="validateEmailLogin()">
                            <label for="login_email">Email</label>
                            <span id="user_validate_login" class="validation-text no-disp red-text">User does not exists, please register!</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12" style="margin-bottom: 0px;">
                            <input class="validate" id="login_password" name="login_password" type="password" minlength="8" maxlength="16" required>
                            <label for="login_password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12" style="margin-bottom: 0px; margin-top: 0px;">
                            <button style="background-color: #ee6e73;" class="btn waves-effect waves-light" type="button" id="login_button" name="login_button">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer center">
            <a href="#signup_modal" class="modal-close modal-trigger waves-effect waves-green btn-flat">Not a member yet?</a>
        </div>
    </div>
    <!-- ### -->
    <!-- Signup modal -->
    <div id="signup_modal" class="modal modal-fixed-footer" style="height: 70%; width: 40%;">
        <div class="modal-content">
            <h4 class="center">Signup</h4>
            <div class="row">
                <form id="register" class="col s12" method="post">
                    <div class="row">
                        <div class="input-field col s12" style="margin-bottom: 0px;">
                            <p id="user_type" onchange="optionToggleRegister()">
                                <!-- onchange="regFormToggle()" -->
                                <label style="font-size: 1rem;">Are you a: </label>
                                <label>
                                    <input class="with-gap" name="u_type" type="radio" value="1" checked />
                                    <span>Customer?</span>
                                </label>
                                <label>
                                    <input class="with-gap" name="u_type" type="radio" value="2" />
                                    <span>Restaurant?</span>
                                </label>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">
                            <div class="input-field col s12" style="margin-bottom: 0px;">
                                <input class="validate" id="name" name="name" type="text" required>
                                <label for="name">Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12" style="margin-bottom: 0px;">
                                <input class="validate" id="email" name="email" type="email" required onchange="validateEmailReg()">
                                <label for="email">Email</label>
                                <span id="user_validate" class="validation-text no-disp red-text">User already exists, please login!</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12" style="margin-bottom: 0px;">
                                <input class="validate" id="password" name="password" type="password" minlength="8" maxlength="16" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12" style="margin-bottom: 0px;">
                                <input class="validate" id="c_password" name="c_password" type="password" minlength="8" maxlength="16" required onchange="validatePass()">
                                <label for="c_password">Confirm Password</label>
                                <span id="helper-pass" class="validation-text no-disp red-text">Passwords do not match</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12" style="margin-bottom: 0px;">
                                <input class="validate" id="contact" name="contact" type="text" required>
                                <label for="contact">Contact</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12" style="margin-bottom: 0px;">
                                <input class="validate" id="city" name="city" type="text" required>
                                <label for="city">City</label>
                            </div>
                        </div>
                        <div class="row" id="food_pref">
                            <div class="input-field col s12" style="margin-bottom: 0px;">
                                <p>
                                    <label style="font-size: 1rem;">Food Preference:</label>
                                    <label>
                                        <input class="with-gap" name="pref" type="radio" value="1" checked />
                                        <span>Vegeterian</span>
                                    </label>
                                    <label>
                                        <input class="with-gap" name="pref" type="radio" value="2" />
                                        <span>Non-Vegeterian</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                        <div class="row no-disp" id="food_type">
                            <div class="input-field col s12" style="margin-bottom: 0px;">
                                <p>
                                    <label style="font-size: 1rem;">Food that you serve:</label>
                                    <label>
                                        <input class="with-gap" name="f_type" type="radio" value="1" checked />
                                        <span>Vegeterian</span>
                                    </label>
                                    <label>
                                        <input class="with-gap" name="f_type" type="radio" value="2" />
                                        <span>Non-Vegeterian</span>
                                    </label>
                                    <label>
                                        <input class="with-gap" name="f_type" type="radio" value="3" />
                                        <span>Both</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12" style="margin-bottom: 0px; margin-top: 0px;">
                            <button style="background-color: #ee6e73;" class="btn waves-effect waves-light" type="button" id="reg_user" name="reg_user">Submit
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer center">
            <a href="#login_modal" class="modal-trigger modal-close waves-effect waves-green btn-flat">Already a member?</a>
        </div>
    </div>

    <!-- add item modal (for restaurants) -->
    <div id="add_items" class="modal" style="height: 70%; width: 40%;">
        <div class="modal-content">
            <h4 class="center">Add Item</h4>
            <div class="row">
                <form class="col s12" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="rest_id" value="<?= $_SESSION['id'] ?>">
                    <input type="hidden" id="f_type" value="<?= $_SESSION['food_type_id'] ?>">
                    <div class="row">
                        <div class="input-field col s12" style="margin-bottom: 0px;">
                            <input id="i_name" name="i_name" type="text" class="validate" required>
                            <label for="i_name">Item Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12" style="margin-bottom: 0px;">
                            <input id="i_price" name="i_price" type="text" class="validate" required>
                            <label for="i_price">Price</label>
                        </div>
                    </div>
                    <div class="row">
                        <!-- giving an option to select the food type 
                                if the restaurant is providing both, veg and non-veg -->
                        <div class="input-field col s12" style="margin-bottom: 0px;">
                            <p>
                                <label style="font-size: 1rem;">Food type:</label>
                                <?php if ($_SESSION['food_type_id'] == 1) { ?>
                                    <span><?= "Vegetarian" ?></span>
                                <?php } else if ($_SESSION['food_type_id'] == 2) { ?>
                                    <span><?= "Non-Vegetarian" ?></span>
                                <?php } else { ?>
                                    <label>
                                        <input class="with-gap" name="food_type" type="radio" value="1" checked />
                                        <span>Vegeterian</span>
                                    </label>
                                    <label>
                                        <input class="with-gap" name="food_type" type="radio" value="2" />
                                        <span>Non-Vegeterian</span>
                                    </label>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12" style="margin-bottom: 0px; margin-top: 0px;">
                            <button style="background-color: #ee6e73;" class="btn waves-effect waves-light" type="button" id="add_item" name="add">Add Item
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>