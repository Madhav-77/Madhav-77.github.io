<?php
include('config\database.php');
session_start();
// if (!$_SESSION['name']) {
//     header('Location: index.php');
//     exit();
// }
// echo "cust".$_SESSION['user_type'];
// exit();
// if ($_SESSION["user_type"] != 1) {
//     header('Location: unauthorized_access.php');
// }
if (isset($_SESSION['name'])) {
    if ($_SESSION["user_type"] != 1) {
        header('Location: unauthorized_access.php');
    }
}
?>
<?php include("header.php"); 
$restId = $_GET['id'];
?>

<div class="container" style="margin-top: 70px;">
    <h4><?= $_GET['name']; ?> (<?= $_GET['type'] ?>)</h4>
    <input type="hidden" id="r_id" value="<?= $restId; ?>">
    <input type="hidden" id="u_id" value="<?= $_SESSION['id']; ?>">
    <div class="row">
        <?php
        if (isset($_SESSION['name'])) {
            $food_pref = $_SESSION['food_pref_id']; // getting the restaurant id from url
            $getMenuItems = mysqli_query($db, "SELECT * from items WHERE restaurant_id = $restId AND `type` = $food_pref");
        } else {
            $getMenuItems = mysqli_query($db, "SELECT * from items WHERE restaurant_id = $restId");
        }
        foreach ($getMenuItems as $data) {
            $servingFood = "";
            if ($data['type'] == 1) {
                $servingFood = "Veg";
            } else {
                $servingFood = "Non-Veg";
            }
        ?>
            <div class="col s6 m3">
                <div class="card">
                    <div class="card-image">

                    </div>
                    <div class="card-content">
                        <p id="<?= $data['item_id']; ?>" class="card-title"><?= $data['item_name']; ?></p>
                        <p style="float:left;" class="sub-title">Price: <span class="price"><?= $data['price']; ?></p></span>
                        <p style="float:right;" class="food-type"><?= $servingFood ?></p>
                    </div>
                    </br>
                    <?php if (isset($_SESSION['name'])) { ?>
                        <div class="card-action add-to-cart" style="cursor: pointer; height: 30px; background: #ee6e73; border: 0px; padding-top: 4px; text-align: center;">
                            <span class="white-text">Add to Basket</span>
                        </div>
                    <?php } else { ?>
                        <a href="#login_modal" class="modal-trigger">
                            <div class="card-action menu" style="cursor: pointer; height: 30px; background: #ee6e73; border: 0px; padding-top: 4px; text-align: center;">
                                <span class="white-text">Add to Basket</span>
                            </div>
                        </a>
                    <?php } ?>
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

    var isCartEmpty;
    $(document).ready(function() {
        var userId = $('#u_id').val();
        var r_id = $('#r_id').val();
        // console.log(userId);
        $.ajax({
            url: 'checkCartItems.php',
            type: 'POST',
            cache: false,
            data: {
                userId: userId,
                r_id: r_id
            },
            success: function(result){
                isCartEmpty = result;
            }
        });
    });
    
    $('.add-to-cart').on('click', function() {
        var r_id = $('#r_id').val();
        var u_id = $('#u_id').val();
        var item_name = $(this).siblings('.card-content').children('.card-title').text();
        var item_price = $(this).siblings('.card-content').children('.sub-title').children('.price').text();
        var f_type = $(this).siblings('.card-content').children('.food-type').text();
        if(f_type == "Veg"){
            f_type = 1;
        } else {
            f_type = 2;
        }
        var url = 'addToCart.php';
        if(isCartEmpty == 1){
            url = 'updateCart.php';
        }

        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: {
                userId: u_id,
                r_id: r_id,
                name: item_name,
                price: item_price,
                type: f_type
            },
            success: function(result){
                if(result == "CartFull"){
                    alert('Sorry you cannot add items from multiple restaurants, please checkout from your existing cart!');
                } else {
                    alert('Item added');
                }
            }
        });
    });
</script>

</html>