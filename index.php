<?php
session_start();
include("header.php") ?>

<!-- image carousel slideshow -->
<div class="head carousel carousel-slider">
    <a class="carousel-item center-text-img" href="#one!">
        <img class="img-carousel" src="assets\images\image1.jpg">
        <div class="centered">
            <h2 style="font-size: 102px;" class="white-text">Foodgasm</h2>
        </div>
    </a>
    <a class="carousel-item" href="#two!">
        <img class="img-carousel" src="assets\images\image2.jpg">
        <div class="centered">
            <h2 style="font-size: 102px;" class="white-text">Foodgasm</h2>
        </div>
    </a>
</div>

<!-- About section -->
<div class="section scrollspy" id="about_us">
    <div class="container" style="width:30%; float:left; margin-top:20px; margin-bottom:50px;">
        <h1><span style="float:right">Why</span><br><span style="float:right">Choose</span><br><span style="float:right">Us?</span></h1>
    </div>
    <div class="container" style="width:70%; float:right; margin-top: 80px; margin-bottom: 100px; padding-left:70px; padding-right:140px;">
        <!-- some dummy content -->
        <p style="text-align:justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
</div>
<div class="parallax-container valign-wrapper scrollspy" style="width:100%;">
    <div class="parallax"><img src="assets\images\image4.jpg" alt="Unsplashed background img 3"></div>
</div>
<div class="section scrollspy">
    <div class="container" style="width:70%; float:left; padding-right:70px; padding-left:100px;">
        <div class="carousel" style="height:300px;  margin-bottom:70px;">
            <a class="carousel-item" href="#one!"><img src="assets\images\3d4b5a8baa14a6de78cf9ba1858d601b.jpg"></a>
            <a class="carousel-item" href="#two!"><img src="assets\images\7c9dc7c88ada08a8bfd0c317dc800518.jpg"></a>
            <a class="carousel-item" href="#two!"><img src="assets\images\9521f1d8db0ef23739aa14e65ce2c0bb.jpg"></a>
            <a class="carousel-item" href="#two!"><img src="assets\images\a2393391b3bd7e07c666f17cc892cef7.jpg"></a>
            <a class="carousel-item" href="#two!"><img src="assets\images\e9c62b552bc9f7d5960d7d0ff70f1a01.jpg"></a>
            <a class="carousel-item" href="#two!"><img src="assets\images\fbd41bc6209ec676c627a94e749f315e.jpg"></a>
        </div>
    </div>
    <div class="container" style="width:30%; float:right; margin-top:30px;">
        <h1><span style="float:left">Our</span><br><span style="float:left">New</span><br><span style="float:left">Food Items</span></h1>
    </div>
</div>
<div class="parallax-container valign-wrapper" style="width:100%;">
    <div class="parallax"><img src="assets\images\image5.jpg" alt="Unsplashed background img 3"></div>
</div>
<div class="section row scrollspy" id="contact_us">
    <div class="container col s6" style="width:30%; float:left; margin-top:30px; margin-bottom:50px;">
        <h1><span style="float:right">Get</span><br><span style="float:right">In</span><br><span style="float:right">Touch</span></h1>
    </div>
    <div class="container col s6" style="width:70%; margin-top: 60px; margin-bottom: 100px; padding-left:70px; padding-right:140px;">
        <div class="row">
            <form class="">
                <div class="input-field col s12">
                    <i class="material-icons prefix grey-text text-darken-3">account_circle</i>
                    <input id="icon_prefix" type="text" class="validate">
                    <label for="icon_prefix">First Name</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix grey-text text-darken-3">phone</i>
                    <input id="icon_telephone" type="text" class="validate">
                    <label for="icon_telephone">Telephone</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix grey-text text-darken-3">email</i>
                    <input id="icon_email" type="text" class="validate">
                    <label for="icon_telephone">Email</label>
                </div>
                <button class="grey darken-3 btn waves-effect waves-light" type="button" id="mail_send">Submit
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/modal-functions.js"></script>
<script src="js/init.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(".dropdown-trigger").dropdown({
        coverTrigger: false
    });

    /* carousel initialization */
    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
    });
    autoplay();

    function autoplay() {
        $('.carousel.carousel-slider').carousel('next');
        setTimeout(autoplay, 4500);
    }

    /* parallax initialization */
    $(document).ready(function() {
        $('.parallax').parallax();
    });
    $(document).ready(function() {
        $('.carousel').carousel({
            numVisible: 5,
            shift: 10,
            padding: 10,
            noWrap: false,
            dist: -100
        });
    });

    /* Fixed button initialization */
    $(document).ready(function() {
        $('.fixed-action-btn').floatingActionButton();
    });

    $('#mail_send').on('click', function(e) {
        e.preventDefault();
        swal("Error!", "Sorry for the inconvenience caused!", "error");
    });

    $(document).ready(function() {
        $('.scrollspy').scrollSpy({
            throttle: 200
        });
    });
</script>
</body>

</html>