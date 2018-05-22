<?php include('app/views/includes/public_header.php'); ?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Cart</h2>
                <?php $this->get_data('no_product_exists'); ?>
                <table class="table table-striped">
                    <tr>
                        <th width="5%">SL</th>
                        <th width="30%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="15%">Quantity</th>
                        <th width="15%">Total Price</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php $this->get_data('cart_rows'); ?>
                    <?php if (isset($_SESSION['cart'])) {
                    	echo "HELLO";
                    	var_dump($_SESSION['cart']);
                    } ?>

                </table>
                <hr>
              
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <button onclick="window.location.href='index.php'" class="btn btn-primary login-btn">Continue
                        Shopping
                    </button>
                </div>
                <div class="shopright">
                    <button onclick="window.location.href='payment.php'" class="btn btn-success login-btn">
                        Checkout
                    </button>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php include('app/views/includes/public_footer.php'); ?>