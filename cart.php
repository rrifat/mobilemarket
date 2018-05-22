<?php
include('app/init.php');
$Template->set_data('page_class', 'shoppingcart');

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
	// check if adding a valid item
	// if( ! $Products->product_exists($_GET['id']))
	// {
	// 	$Template->set_alert('Invalid Item!');
	// 	$Template->redirect(SITE_PATH . 'cart.php');
	// }


	// add item to cart
	if(isset($_GET['num']) && is_numeric($_GET['num']))
	{
		$Cart->add($_GET['id'], $_GET['num']);
		//$Template->set_alert('Items have been added to the cart!', 'success');
	}
	else
	{
		$Cart->add($_GET['id']);
		//$Template->set_alert('Item has been added to the cart!', 'success');
	}
	$Template->redirect(SITE_PATH . 'cart.php');

}

 if(isset($_GET['empty']))
 {
 	$empty_cart = $Cart->empty_cart();
 	if($empty_cart)
 	{
 		//$Template->set_alert('Items from shopping cart have been removed', 'error');
 		$Template->redirect(SITE_PATH . 'cart.php');
 	}
 	else
 	{
 		//$Template->set_alert('There are no items in the cart!', 'warning');
 		$Template->redirect(SITE_PATH . 'cart.php');
 	}
 	
 	//$Template->redirect(SITE_PATH . 'cart.php');
 }

 if(isset($_POST['update']))
 {
 	// get all ids of products in cart
 	$ids = $Cart->get_ids();

 	//make sure we have ids to work with
 	if($ids != NULL)
 	{
 		foreach ($ids as $id) {
 			if (is_numeric($_POST['product' . $id])) {
 				$Cart->update($id, $_POST['product' . $id]);
 			}
 		}
 	}
 	else
 	{
 		//$Template->set_alert('There are no items in the cart!', 'warning');
 		$Template->redirect(SITE_PATH . 'cart.php');
 	}
 	//add alert
 	//$Template->set_alert('Number of items in the cart have been updated', 'success');

	$Template->redirect(SITE_PATH . 'cart.php');

 	
 }

 // get items in cart
$display = $Cart->create_cart_table();
$Template->set_data('cart_rows', $display);

 // get category nav
$category_nav = $Categories->create_category_nav('');
$Template->set_data('page_nav', $category_nav);

//$Template->load('app/views/v_public_cart.php', 'Shopping Cart');
$Template->load('app/views/v_public_cart.php');


			/*$items = $this->get_data('cart_total_items', FALSE);
			$price = $this->get_data('cart_total_cost', FALSE);
			if($items == 1)
			{
				echo $items . ' item ($' . $price . ') in cart';
			}
			else
			{
				echo $items . ' items ($' . $price . ') in cart';
			}*/
/*
if (isset($_POST['submit']))
{
	$Template->redirect('payment.php');
}*/