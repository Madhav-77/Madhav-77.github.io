<?php
include('config\database.php');
session_start();
if (!$_SESSION['name']) {
    header('Location: index.php');
    exit();
} /* else if ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 2) {
    header('Location: unauthorized_access.php');
}  */ else {
    include('header.php');
    $user_id = $_SESSION['id'];
    if ($_SESSION['user_type'] == 1) {
        $getOrders = "SELECT * FROM `orders` WHERE `user_id`=$user_id AND `order_status` != 0";
        $orders = mysqli_query($db, $getOrders);
    } else {
        $getOrders = "SELECT * FROM `orders` WHERE `restaurant_id`=$user_id AND `order_status` != 0";
        $orders = mysqli_query($db, $getOrders);
    }
?>

    <div class="container" style="margin-top: 70px;">
        <h4>Orders</h4>
        <div class="row">
            <table class="highlight" id="tab">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Restaurant Name</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>View Details</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($orders)) {
                        $i = 0;
                        foreach ($orders as $order) {
                            $i++;
                            if ($_SESSION['user_type'] == 1) {
                                $restaurant_id = $order['restaurant_id'];
                                $getName = mysqli_query($db, "SELECT `name` from restaurants WHERE `id` = $restaurant_id");
                            } else {
                                $user_id = $order['user_id'];
                                $getName = mysqli_query($db, "SELECT `name` from users WHERE `id` = $user_id");
                            }
                            $restaurant = mysqli_fetch_assoc($getName);
                            $o_status = "";
                            if ($order['order_status'] == 0) {
                                $o_status = "Order Pending";
                            } else if ($order['order_status'] == 1) {
                                $o_status = "Order Placed";
                            } else {
                                $o_status = "Order Accepted";
                            }
                    ?>
                            <tr id=<?= $order['order_id'] ?>>
                                <td class="restaurant"><?= $i ?></td>
                                <td class="restaurant"><?= $restaurant['name'] ?></td>
                                <td class="date"><?= $order['ordered_on'] ?></td>
                                <td class="total"><?= $order['total'] ?></td>
                                <td class="status" id="<?= $order['order_status'] ?>"><?= $o_status ?></td>
                                <td class="view material-icons text-center" style="cursor: pointer;"><a href="#order_details_modal" class="modal-trigger">remove_red_eye</td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
            <!-- Order details modal -->
            <div id="order_details_modal" class="modal modal-fixed-footer" style="height: 70%; width: 40%;">
                <div class="modal-content">
                    <h4 class="center">Order Details</h4>
                    <div class="row">
                        <table class="highlight" id="tab">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Name</th>
                                    <th>Food Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>

                            <tbody class="table-body">

                            </tbody>
                        </table>
                    </div>
                    <?php if ($_SESSION['user_type'] == 2) { ?>
                        <div class="row">
                            <div class="input-field col s12" style="margin-bottom: 0px; margin-top: 0px;">
                                <button style="float: right; background-color: #ee6e73;" class="btn waves-effect waves-light" type="button" id="accept_order" name="accept_order">Accept Order
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- <div class="modal-footer center">
                    <a href="" class="modal-close modal-trigger waves-effect waves-green btn-flat">Accept Order</a>
                </div> -->
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
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

        $(document).ready(function() {
            $('#add_items').modal();
        });
        /* order_details_modal initialization */
        $(document).ready(function() {
            $('#order_details_modal').modal();
        });

        var currRow;
        $('.view').on('click', function() {
            currRow = $(this);
            var order_id = $(this).parent('tr').attr('id');
            var status = $(this).siblings('.status').attr('id');
            if (status != 1) {
                $('#accept_order').addClass('disabled');
            }
            $.ajax({
                url: 'getOrderDetails.php',
                type: 'POST',
                cache: false,
                data: {
                    order_id: order_id
                },
                success: function(result) {
                    $('.table-body').html(result);
                }
            });
        });

        $('#accept_order').on('click', function() {
            var order_id = $('.table-body tr:first').attr('id');
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                cache: false,
                data: {
                    order_id: order_id
                },
                success: function() {
                    currRow.siblings('.status').text('Order Accepted');
                    $('#accept_order').addClass('disabled');
                    $('#order_details_modal').modal('close');
                }
            });
            // console.log(order_id);
        });
    </script>
<?php } ?>