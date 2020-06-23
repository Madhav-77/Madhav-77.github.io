<?php
include('config\database.php');
session_start();
if (!$_SESSION['name']) {
    header('Location: index.php');
    exit();
} else if ($_SESSION['user_type'] != 1) {
    header('Location: unauthorized_access.php');
} else {
    include("header.php");

    $u_id = $_SESSION['id'];
    $getCartItems = "SELECT * FROM `orders` WHERE `user_id` = $u_id AND `order_status` = 0";
    $cartItems = mysqli_query($db, $getCartItems);
    $data = mysqli_fetch_assoc($cartItems,);
    $orders = json_decode($data['orders'], true);
    $order_id = "";

    $r_id = $data['restaurant_id'];
    $r_name = "";
    $getRestaurantName = "SELECT `name` FROM `restaurants` WHERE `id`=$r_id";
    $restaurantName = mysqli_query($db, $getRestaurantName);
    if (!empty($restaurantName)) {
        $order_id = $data['order_id'];
        $r_name = mysqli_fetch_assoc($restaurantName);
        $r_name = $r_name['name'];
    }
?>
    <div class="container" style="margin-top: 70px;">
        <h4>Cart</h4>
        <div class="row">
            <h6><?= $r_name ?></h6>
            <input type="hidden" id="order_id" value="<?= $order_id ?>">
            <table class="highlight" id="tab">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item Name</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Item Price</th>
                        <th>Amount</th>
                        <th>Remove</th>
                    </tr>
                </thead>

                <tbody id="tbody">
                    <?php
                    $i = 1;
                    $total = 0;
                    if (!empty($orders)) {
                        foreach ($orders as $order) {
                            $amt = $order['price'] * $order['qty'];
                            $total += $amt;
                    ?>
                            <tr class='item'>
                                <td><?= $i; ?></td>
                                <td class="name"><?= $order['name'] ?></td>
                                <td class="type"><?php $order['type'] == 1 ? printf("Veg") : printf("Non-Veg"); ?></td>
                                <td class="nos">
                                    <span style="font-size: 14px; cursor: pointer;" class="no-disp tiny minus material-icons">remove</span>
                                    <span class="qty"><?= $order['qty'] ?></span>
                                    <span style="font-size: 14px; cursor: pointer;" class="tiny add material-icons">add</span>
                                </td>
                                <td class="price"><?= $order['price'] ?></td>
                                <td class="amt"><?= $amt ?></td>
                                <td class="remove-item material-icons" style="cursor: pointer;">delete</td>
                            </tr>
                    <?php $i++;
                        }
                    } ?>
                    <tr>
                        <td colspan="5" style="text-align:center;"><b>Total</b></td>
                        <td colspan="2"><b id="total"><?= $total; ?></b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="input-field col" style="float: right; margin-bottom: 0px; margin-top: 0px;">
                <button style="background-color: #ee6e73;" class="btn waves-effect waves-light" type="button" id="place_order" name="place_order">Place Order
                    <i class="material-icons right">send</i>
                </button>
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

        $('.add').on('click', function() {
            var price = $(this).parent('.nos').siblings('.price').text();
            var qty = $(this).siblings('.qty').text();
            var total = $('#total').text();

            qty++;
            $(this).siblings('.qty').text(qty);
            $(this).siblings('.minus').removeClass('no-disp');

            var amt = $(this).parent('.nos').siblings('.amt').text();
            var new_amt = qty * price;
            var diff_amt = new_amt - amt;
            var total = parseInt(total) + diff_amt;
            $(this).parent('.nos').siblings('.amt').text(new_amt);
            $('#total').text(total);
        });


        $('.minus').on('click', function() {
            var price = $(this).parent('.nos').siblings('.price').text();
            var amt = $(this).parent('.nos').siblings('.amt').text();
            var total = $('#total').text();
            var qty = $(this).siblings('.qty').text();

            qty--;
            $(this).siblings('.qty').text(qty);
            if (qty <= 1) {
                $(this).addClass('no-disp');
            }

            var new_amt = parseInt(amt) - parseInt(price);
            var new_total = parseInt(total) - parseInt(price);
            $(this).parent('.nos').siblings('.amt').text(new_amt);
            $('#total').text(new_total);
            // $(this).siblings('.minus').removeClass('no-disp');
        });

        $('.remove-item').on('click', function() {
            if (confirm("Are you sure you want to remove this item from cart?")) {
                var row = $(this);
                var total = $('#total').text();
                var name = $(this).siblings('.name').text();
                var type = $(this).siblings('.type').text();
                var amt = $(this).siblings('.amt').text();
                var f_type = type == "Veg" ? 1 : 2;
                var price = $(this).siblings('.price').text();
                var order_id = $('#order_id').val();
                var new_total = parseInt(total) - parseInt(amt);
                $.ajax({
                    url: 'deleteFromCart.php',
                    type: 'POST',
                    cache: false,
                    data: {
                        name: name,
                        type: f_type,
                        price: price,
                        order_id: order_id,
                        new_total: new_total
                    },
                    success: function() {
                        $('#total').text(new_total);
                        row.parent('tr').fadeOut(1200);
                    }
                });
            }
        });

        $(document).ready(function() {
            var order_id = $('#order_id').val();
            if (order_id == "") {
                $('#place_order').addClass('disabled');
            }
        });

        $('#place_order').on('click', function() {
            var order_id = $('#order_id').val();
            var amt = $('.name').text();
            var total = $('#total').text();
            var productId;
            var order = [];
            $('table > tbody  > tr').each(function(index, tr) {
                // var $tds = $(this).find('td:eq[0]');
                order[index] = {};
                order[index].name = $(this).children('.name').text();
                order[index].price = $(this).children('.price').text();
                order[index].qty = $(this).children('.nos').children('.qty').text();
                order[index].type = $(this).children('.type').text();
                // var name = $tds.name.text();
            });
            order.pop(); //popping out last ele from array as last row would be for total

            $.ajax({
                url: 'place_order.php',
                type: 'POST',
                cache: false,
                data: {
                    ord_id: order_id,
                    total: total,
                    order: order
                },
                success: function() {
                    alert('Order has been placed!');
                    $('#tbody').empty();
                    $('#place_order').addClass('disabled');
                }
            });
            console.log(order);
        });
    </script>

    </html>
<?php } ?>