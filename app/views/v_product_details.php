<?php include('app/views/includes/public_header.php'); ?>


 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="images/preview-img.jpg" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php $this->get_data('product_name'); ?></h2>
<!-- 					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>	 -->				
					<div class="price">
						<p>Price: <span><?php $this->get_data('product_price'); ?></span></p>
						<p>Category: <span><?php $this->get_data('category_name'); ?></span></p>
						<p>Available Quantity:<span><?php $this->get_data('total_product'); ?></span></p>
					</div>
				<div class="add-cart">
					<form action="cart.html" method="post">
						<input type="number" class="buyfield" name="" value="1"/>
						<!-- <input type="button" class="buysubmit" name="submit" value="Add To Cart"/> -->
						<a href="cart.php?id=<?php $this->get_data('product_id'); ?>" class="buysubmit">Add to cart</a>
					</form>				
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p> <?php $this->get_data('product_body'); ?> </p>
	    </div>
				
	</div>
				<!-- <div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
				      <li><a href="productbycat.html">Mobile Phones</a></li>
				      <li><a href="productbycat.html">Desktop</a></li>
				      <li><a href="productbycat.html">Laptop</a></li>
				      <li><a href="productbycat.html">Accessories</a></li>
				      <li><a href="productbycat.html#">Software</a></li>
					   <li><a href="productbycat.html">Sports & Fitness</a></li>
					   <li><a href="productbycat.html">Footwear</a></li>
					   <li><a href="productbycat.html">Jewellery</a></li>
					   <li><a href="productbycat.html">Clothing</a></li>
					   <li><a href="productbycat.html">Home Decor & Kitchen</a></li>
					   <li><a href="productbycat.html">Beauty & Healthcare</a></li>
					   <li><a href="productbycat.html">Toys, Kids & Babies</a></li>
    				</ul>
    	
 				</div> -->
 		</div>
 	</div>
	</div>



<?php include('app/views/includes/public_footer.php'); ?>
