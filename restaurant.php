<?php
include('config\database.php');
session_start();
if (!$_SESSION['name']) {
    header('Location: index.php');
    exit();
}
// echo $_SESSION['user_type'];
if ($_SESSION['user_type'] != 2) {
    header('Location: unauthorized_access.php');
}
?>
<?php include("header.php") ?>

<div class="container" style="margin-top: 70px;">
    <h4>Menu</h4>
    <div class="row">
        <?php
        $id = $_SESSION['id']; // getting the restaurant id from url
        $getMenuItems = mysqli_query($db, "SELECT * from items WHERE restaurant_id = $id");
        // $menuItems = mysqli_fetch_assoc($getMenuItems);
        foreach ($getMenuItems as $data) {
        ?>
            <div class="col s6 m3">
                <div class="card">
                    <div class="card-image">

                    </div>
                    <div class="card-content">
                        <p id="<?= $data['item_id']; ?>" class="card-title"><?= $data['item_name']; ?></p>
                        <p style="float:left;"><?php $data['type'] == 1 ? printf("Veg") : printf("Non-Veg"); ?></p>
                        <p style="float:right;"><?= $data['price']; ?></p>
                    </div>
                    </br>
                    <div class="card-action remove" style="cursor: pointer; height: 30px; background: #ee6e73; border: 0px; padding-top: 4px; text-align: center;">
                        <span class="white-text">Remove Item</span>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('.remove').on('click', function() {
        var id = $(".card-title").attr('id');
        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: 'remove_item.php',
                type: 'POST',
                cache: false,
                data: {
                    id: id
                },
                success: function() {
                    $(this).parent('.card').fadeOut('slow');
                }
            });
        }
    });

    $(".dropdown-trigger").dropdown({
        coverTrigger: false
    });

    $(document).ready(function() {
        $('#add_items').modal();
    });

    $('#add_item').on('click', function() {
        var id = $('#rest_id').val();
        var name = $('#i_name').val();
        var price = $('#i_price').val();
        var foodTypeFromSession = $('#f_type').val();
        var type = foodTypeFromSession;
        if (foodTypeFromSession == 3) {
            type = $("input[name='food_type']:checked").val();
        }
        console.log(type);

        $.ajax({
            url: "add_items.php",
            type: "POST",
            cache: false,
            data: {
                id: id,
                name: name,
                price: price,
                type: type
            },
            success: function() {
                alert("item added");
                $('#add_items').modal('close');
            }
        });
    });
</script>

</html>