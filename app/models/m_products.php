<?php
/*
	Products Class
	Handle all task related to retrieving and displaying products

*/

/**
* 
*/
class Products
{
	private $Database;
	private $db_table = 'products';

	function __construct()
	{
		global $Database;
		$this->Database = $Database;
	}




	/*
		Getters /Setters
	*/

	/**
	 * Retrive Product Information from Database
	 *
	 * @access public
	 * @param int(optional)
	 * @return array
	 **/

	public function get($id = NULL){
		$data = array();

		if(is_array($id)){
			// get product based on array of ids
			$items = '';
			foreach ($id as $item) {
				if ($items != '') {
					$items .= ',';
				}
				$items .= $item;
			}
			if ($result = $this->Database->query("SELECT product_id, product_name, product_body, product_price, total_product, product_image, product_type FROM $this->db_table WHERE product_id IN ($items) ORDER BY product_name")) 
			{
				if ($result->num_rows > 0) {
					while($row = $result->fetch_array())
					{
						$data[] = array(
							'product_id' => $row['product_id'],
							'product_name' => $row['product_name'],
							'product_body' => $row['product_body'],
							'product_price' => $row['product_price'],
							'total_product' => $row['total_product'],
							'product_image' => $row['product_image'],
							'product_type' => $row['product_type']
							);
					}
				}
			}
		}
		else if($id != NULL){
				if ($stmt = $this->Database->prepare("SELECT 
					$this->db_table.product_id, 
					$this->db_table.cat_id, 
					$this->db_table.product_name,
					$this->db_table.product_body, 
					$this->db_table.product_price, 
					$this->db_table.total_product, 
					$this->db_table.product_image, 
					$this->db_table.product_type,
					categories.cat_name AS cat_name
					FROM $this->db_table, categories
					WHERE $this->db_table.product_id = ? AND $this->db_table.cat_id = categories.cat_id"))
			{
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($product_id, $cat_id, $product_name, $product_body, $product_price, $total_product, $product_image, $product_type, $cat_name);
				$stmt->fetch();

				if ($stmt->num_rows > 0) {
					$data = array(
							'product_id' => $product_id,
							'cat_id' => $cat_id,
							'product_name' => $product_name,
							'product_body' => $product_body,
							'product_price' => $product_price,
							'total_product' => $total_product,
							'product_image' => $product_image,
							'product_type' => $product_type,
							'cat_name' => $cat_name
						);
				}

				$stmt->close();
			}
		}
		else{
			//get all poroducts
			if($result=$this->Database->query("SELECT * FROM " . $this->db_table ." ORDER BY product_name"))
			{
				if($result->num_rows > 0){

					while ($row = $result->fetch_array()) {
						$data[] = array(
							'product_id' => $row['product_id'],
							'cat_id' => $row['cat_id'],
							'product_name' => $row['product_name'],
							'product_body' => $row['product_body'],
							'product_price' => $row['product_price'],
							'total_product' => $row['total_product'],
							'product_image' => $row['product_image'],
							'product_type' => $row['product_type']

							);
					}
				}
			}
		}
		return $data;
	}

	/**
	 * Retrieve product information for all products in specific category
	 *
	 * @access public
	 * @param int
	 * @return string
	 **/

	public function get_category_products($cat_id){
		$data = array();
		if ($stmt = $this->Database->prepare("SELECT product_id, product_name, product_body, product_price, total_product, product_image, product_type FROM " . $this->db_table . " WHERE cat_id = ?")) {
			$stmt->bind_param("i", $cat_id);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($product_id, $product_name, $product_body, $product_price, $total_product, $product_image, $product_type);
			//$stmt->fetch_array();

			while ($stmt->fetch())
			{
				$data[] = array(
					'product_id' => $product_id,
					'product_name' => $product_name,
					'product_body' => $product_body,
					'product_price' => $product_price,
					'total_product' => $total_product,
					'product_image' => $product_image,
					'product_type' => $product_type
				);
			}

			$stmt->close();
		}

		return $data;
	}

	/**
	 * Return an array of price infor for specified ids
	 *
	 * @access public
	 * @param arrray
	 * @return array
	 **/

	public function get_prices($ids)
	{
		$data = '';

		// create comma sepearted lists
		$items = '';
		foreach ($ids as $id) {
			if ($items != '') {
				$items .= ',';
			}
			$items .= $id;
		}

		// get multiple product info based on list of ids
		if($result = $this->Database->query("SELECT id, price FROM $this->db_table WHERE id IN ($items) ORDER BY name" ))
		{
			if($result->num_rows > 0)
			{
				while($row = $result->fetch_array())
				{
					$data[] = array(
						'id' => $row['id'],
						'price' => $row['price']
						);
				}
			}
		}
		return $data;

	}


	/**
	 * Checks to ensure that product exists
	 *
	 * @access public
	 * @param int
	 * @return bool
	 **/
	public function product_exists($id)
	{
		if($stmt = $this->Database->prepare("SELECT id FROM $this->db_table WHERE id = ?"))
		{
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($prod_id);
			$stmt->fetch();

			if($stmt->num_rows > 0)
			{
				$stmt->close();
				return TRUE;
			}else
			{
				$stmt->close();
				return FALSE;
			}
			
		}
	}



	/*
		Creation of page elements
	*/

	/**
	 * Create Product Table using from Database
	 *
	 * @access public
	 * @param int (optional), int(optional)
	 * @return string
	 **/

	public function create_product_table($cat_id = NULL)
	{
		if ($cat_id != NULL) {
			$products = $this->get_category_products($cat_id);
		}
		else
		{
			$products = $this->get(); 	
		}

		$data = '';

		if (!empty($products)) {
			$i = 1;
			foreach ($products as $product) {
				if ($i == 1) {

					$data .= '<div class="section group">';

				}

				$data .= '<div class="grid_1_of_4 images_1_of_4">';
				$data .= '<img src="' . IMAGE_PATH . $product['product_image'] . '" alt="' . $product['product_name'] . '"/>';
				$data .= '<h2>' . $product['product_name'] . '</h2>';
				$data .= '<p><span class="price">' . $product['product_price'] . '</span></p>';
				$data .= '<div class="button"><span><a href="' . SITE_PATH . 'product_details.php?product_id=' . $product['product_id'] . '" class="details">Details</a></span></div>';
				$data .= '</div>';
				$i++;
				if ($i == 5) {
					$data .= '</div>';
					$i = 1;
				}
				
			}

		}

		return $data;
	}

	/*
		Creation of all products view
	*/

	/**
	 * Create View of All Products in Table
	 *
	 * @access public
	 * @param int (optional), int(optional)
	 * @return string
	 **/

	// public function create_view_all_products(){
	// 		$data ='';
	// 		$products = $this->get();

	// 		$prod_id = 'Product ID';
	// 		$cat_id = 'Category ID';
	// 		$prod_name = 'Product Name';
	// 		$prod_desc = 'Product Description';
	// 		$prod_price = 'Product Price';
	// 		$prod_image = 'Product Image';
	// 		//$img_src = '<img width="20px" height="20px" src=" ' . SITE_PATH . 'resources/images/' . $product["image"] . '" />'
	// 		$space = str_repeat("&nbsp;", 20);

	// 		$data .='<table border="0">';
	// 		$data .='<th>' . $prod_id . '</th>';
	// 		$data .='<th>' . $cat_id . '</th>';
	// 		$data .='<th>' . $prod_name . '</th>';
	// 		// $data .='<th>' . $prod_desc . '</th>';
	// 		$data .='<th>' . $prod_price . '</th>';
	// 		$data .='<th>' . $prod_image . '</th>';
	// 		$data .='<th>' . "Update Product" . '</th>';
	// 		$data .='<th>' . "Delete Product" . '</th>';

	// 		foreach ($products as $product)
	// 		{
	// 			$data .='<tr>';
	// 			$data .='<td><center>' . $product['id'] . '</center></td>';
	// 			$data .='<td><center>' . $product['category_id'] . '</center></td>';
	// 			$data .='<td><center>' . $product['name'] . '</center></td>';
	// 			// $data .='<td><center>' . $product['description'] . '</center></td>';
	// 			$data .='<td><center>' . $product['price'] . '</center></td>';
	// 			$data .='<td><center>' . '<img width="50px" height="50px" src=" ' . SITE_PATH . 'resources/images/' . $product["image"] . '" />' . '</center></td>';
	// 			$data .='<td><center>' . '<a href="update_product.php?id=' . $product['id'] . '">  Update  </a>' . '</center></td>';
	// 			$data .='<td><center>' . '<a href="delete_product.php?id=' . $product['id'] . '">  Delete  </a>' . '</center></td>';
	// 			$data .='</tr>';
				
	// 		}
	// 		$data .='</table>';

	// 		return $data;
	// }
		
	
}