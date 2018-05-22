<?php

	include('app/init.php');

	//$Template->set_data('page_class', 'product');


	if(isset($_GET['product_id']) && is_numeric($_GET['product_id']))
	{
		$product_id = $_GET['product_id'];

		$category_nav = $Categories->create_category_nav();
		$Template->set_data('page_nav', $category_nav);

		$product = $Products->get($product_id);

		if(! empty($product))
		{

			$Template->set_data('product_id', $product_id);
			$Template->set_data('product_name', $product['product_name']);
			$Template->set_data('cat_name', $product['cat_name']);
			$Template->set_data('product_price', $product['product_price']);
			$Template->set_data('total_product', $product['total_product']);
			$Template->set_data('product_body', $product['product_body']);
			$Template->set_data('product_image', IMAGE_PATH . $product['product_image']);
			$Template->set_data('product_type', $product['product_type']);

			$Template->load('app/views/v_product_details.php');

		}
		else
		{
			// error
			$Template->redirect(SITE_PATH);
		}
	}
	else
	{
		// error
		$Template->redirect(SITE_PATH);
	}