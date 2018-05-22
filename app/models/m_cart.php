<?php

class Cart
{
	function __construct(){

	}

	public function get()
	{
		if(isset($_SESSION['cart']))
		{
			// get all product ids of items in the cart
			$ids = $this->get_ids();

			// use list of ids to get product info from database
			global $Products;
			return $Products->get($ids);
		}
	}

	/**
	* Return an array of all product ids in the cart
	*
	* @access public
	* @param 
	* @return array, null
	**/

	public function get_ids()
	{
		if (isset($_SESSION['cart'])) {
			return array_keys($_SESSION['cart']);
		}else
		{
			return NULL;
		}
		
	}

	public function add($id, $num=1)
	{
		//setup or retrieving cart

		$cart = array();

		if (isset($_SESSION['cart'])) {
			$cart = $_SESSION['cart'];
		}

		// check to see if the item is already in the cart

		if (isset($cart[$id])) {
			// if item is in cart
			$cart[$id] = $cart[$id] + $num;
		}
		else
		{
			// if item is not in cart

			$cart[$id] = $num;
		}

		$_SESSION['cart'] = $cart;
	}

	public function update($id, $num)
	{
		if($num == 0)
		{
			unset($_SESSION['cart'][$id]);
		}
		else
		{
			$_SESSION['cart'][$id] = $num;
		}
	}

	public function empty_cart()
	{
		// unset($_SESSION['cart']);
		//return TRUE;
		if (isset($_SESSION['cart'])) {
			unset($_SESSION['cart']);
			return TRUE;
		}else
		{
			return NULL;
		}
	}

	public function get_total_items()
	{
		$num = 0;
		if (isset($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $item) {
				$num = $num + $item;
			}
		}
		return $num;
	}

	public function get_total_cost()
	{
		$num = '0.00';
		if (isset($_SESSION['cart'])) {
			// if items to display

			// get products ids
			$ids = $this->get_ids();

			//get product prices
			global $Products;
			$prices = $Products->get_prices($ids);

			// loop through, adding the cost of each item x the number of that item in the cart to $num each time
			if ($prices != NULL) {
				foreach ($prices as $price) {
					$num += doubleval($price['price'] * $_SESSION['cart'][$price['id']]);
				}
			}
			return $num;	


		}

	}

	public function create_cart_table(){

		$products = $this->get();

		$data = '';
		$total = 0;

		 if ($products != '') {
	            $i = 0;
	            $sum = 0;
	            $qty = 0;
	            $line = 1;
	            
	            foreach ($products as $product)
	            {	
	            	 $data .= '<tr>';
	                 $data .= '<td>' . $i . '</td>';
	                 $data .= '<td>' . $product['product_name'] . '</td>';
	                 $data .= '<td><img src="' . IMAGE_PATH . $product['product_image'] . '"/></td>';
	                 $data .= '<td>' . $product['product_price'] . '</td>';
	                 $data .= '<td><input name="product' . $product['product_id'] .'" value="'. $_SESSION['cart'][$product['product_id']] .'"></td>';
	                 $data .= '<td>$' . $product['product_price'] * $_SESSION['cart'][$product['product_id']] . '</td>';
	                 $data .= '</tr>';
	                 $line++;
	                
	            }

                    

	}
	else{

	        $data = 'I AM';
	    }
	            

	return $data;


}

}

?>