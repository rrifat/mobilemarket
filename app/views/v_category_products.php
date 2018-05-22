<?php include('app/views/includes/public_header.php'); ?>

 <div class="main">
    <div class="content">
		<div class="content_bottom">
    		<div class="heading">
    		<h3>iPhone</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
<!-- 			<div class="section group">
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.html"><img src="images/new-pic1.jpg" alt="" /></a>
					 <h2>Lorem Ipsum is simply </h2>
					 <p><span class="price">$403.66</span></p>
				    
				     <div class="button"><span><a href="preview.html" class="details">Details</a></span></div>
				</div> -->
					 <?php $this->get_data('cat_products'); ?>
					 <br />
					 <?php $this->get_data('no_product'); ?>
				
<!--     </div> -->
 </div>


<?php include('app/views/includes/public_footer.php'); ?>
