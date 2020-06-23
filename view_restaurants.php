<?php
include('config\database.php');
session_start();
if (isset($_SESSION['name'])) {
    if ($_SESSION["user_type"] != 1) {
        header('Location: unauthorized_access.php');
    }
}
?>
<?php include("header.php") ?>
<!-- <ul id="user_drop" class="dropdown-content">
    <li><a href="logout.php">Logout</a></li>
</ul> -->
<div class="container" style="margin-top: 70px;">

    <h4>Restaurants</h4>

    <div class="row">
        <?php
        if (isset($_SESSION['name'])) {
            $food_pref = $_SESSION['food_pref_id']; // getting the restaurant id from url
            $getRestaurants = mysqli_query($db, "SELECT * from restaurants WHERE food_type_id = $food_pref OR food_type_id = 3");
        } else {
            $getRestaurants = mysqli_query($db, "SELECT * from restaurants");
            $getRestaurants =  mysqli_fetch_all($getRestaurants, MYSQLI_ASSOC);
        }
        foreach ($getRestaurants as $data) {
            $servingFood = "";
            if ($data['food_type_id'] == 1) {
                $servingFood = "Veg";
            } else if ($data['food_type_id'] == 2) {
                $servingFood = "Non-Veg";
            } else {
                $servingFood = "Veg/Non-Veg";
            }
        ?>
            <div class="col s6 m3">
                <div class="card">
                    <div class="card-image">

                    </div>
                    <div class="card-content">
                        <p id="<?= $data['id']; ?>" class="card-title"><?= $data['name']; ?></p>
                        <p class="serves" style="float:left;">Serves: <span class="food-type"><?= $servingFood; ?></span></p>
                    </div>
                    </br>
                    <div class="card-action menu" style="cursor: pointer; height: 30px; background: #ee6e73; border: 0px; padding-top: 4px; text-align: center;">
                        <span class="white-text">View Menu</span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include("footer.php") ?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>
<script src="js/modal-functions.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(".dropdown-trigger").dropdown({
        coverTrigger: false
    });

    $('.menu').on('click', function() {
        var id = $(this).siblings('div').children(".card-title").attr('id');
        var name = $(this).siblings('div').children(".card-title").text();
        var type = $(this).siblings('div').children(".card-title").siblings('.serves').children('.food-type').text();
        // console.log(type);
        window.open('menu.php?id=' + id + "&name=" + name + "&type=" + type, "_self");
    });
</script>

</html>