<?php include 'app/init.php'; ?>


<?php

if (isset($_GET['cat_id']) && is_numeric($_GET['cat_id']))
{

	$category_nav = $Categories->create_category_nav();
	$Template->set_data('page_nav', $category_nav);

	$cat_id = $_GET['cat_id'];

	
	$products = $Products->create_product_table($cat_id);
	if (!empty($products)) {
		$Template->set_data('cat_products', $products);
		$Template->load('app/views/v_category_products.php');
	}
	else
	{
		$Template->set_data('no_product', "There is no product under this category!");
		$Template->load('app/views/v_category_products.php');
	}

	
}	

?>