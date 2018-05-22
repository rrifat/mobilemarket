<?php

class Categories{

	private $Database;
	private $db_table = 'categories';

	function __construct(){

		global $Database;
		$this->Database = $Database;
	}

public function get_categories($id = NULL)
{
	$data = array();
	if ($id != NULL)
	{
		
		if ($stmt = $this->Database->prepare("SELECT cat_id, cat_name FROM " . $this->db_table . " WHERE cat_id = ?"))
		{
			$stmt->bind_param("s", $id);
			$stmt->execute();
			$stmt->store_result();

			$stmt->bind_result($cat_id, $cat_name);
			$stmt->fetch();

			if ($stmt->num_rows > 0) {
				$data = array('cat_id' => $cat_id, 'cat_name' => $cat_name);
			}

			$stmt->close();


		}
	}
	else
		{
			if ($result = $this->Database->query("SELECT * FROM " . $this->db_table . " ORDER BY cat_name asc"))
			{
				
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_array())
					{
						$data[] = array('cat_id' => $row['cat_id'], 'cat_name' => $row['cat_name']);
					}
				}
				
			}
		}
	
	return $data;
}

public function create_category_nav($id = null)
{

	$data = '';
	$categories = $this->get_categories();

	$data .= '<li><a href="' . SITE_PATH . 'index.php">Home</a></li>';


	if ( ! empty($categories))
	{
		foreach ($categories as $category)
		{
			$data .= '<li><a href="' . SITE_PATH . 'category_products.php?cat_id=' . $category['cat_id'] . '">' . $category['cat_name'] . '</a></li>';


		}

		return $data;
	}
	else
	{
		return $data;
	}
	


	
	

}

}



?>