<?php

/*
	Authorization Class
	Deal with auth tasks
*/

class Auth
{
	private $salt = 'j4H9?s0d';

	/*
		Constructor
	*/

	function __construct()
	{
		
	}

	/*
-
	Fucntions

	*/

	function check_admin_login($username, $password)
	{
		// access Database
		global $Database;

		// Create query

		if ($stmt = $Database->prepare("SELECT * FROM admin WHERE username = ? AND password = ?"))
		{
			$stmt->bind_param("ss", $username, $password);
			$stmt->execute();
			$stmt->store_result();

			// Check for number of rows

			// check for num rows
			if ($stmt->num_rows > 0)
			{
				// success
				$stmt->close();
				return TRUE;
			}
			else
			{
				// failure
				$stmt->close();
				return FALSE;
			}
		}
		else
		{
			die("ERROR : Couldn't prepare mysql statement");
		}
	}

	function validateCustomerLogin($username, $password)
	{
		// access Database
		global $Database;
		// Create query

		if ($stmt = $Database->prepare("SELECT * FROM customers WHERE username = ? AND password = ?"))
		{
			$stmt->bind_param("ss", $username, md5($password . $this->salt));
			$stmt->execute();
			$stmt->store_result();

			// Check for number of rows

			// check for num rows
			if ($stmt->num_rows > 0)
			{
				// success
				$stmt->close();
				return TRUE;
			}
			else
			{
				// failure
				$stmt->close();
				return FALSE;
			}
		}
		else
		{
			die("ERROR : Couldn't prepare mysql statement");
		}
	}

	function register_customer($name,$username,$password,$email,$address){

		global $Database;

		if ($stmt = $Database->prepare("INSERT into customers (full_name, username, password, email, address) VALUES (?,?,?,?,?)")) {
			$stmt->bind_param("sssss", $name,$username,md5($password . $this->salt),$email,$address);
			$stmt->execute();
			$stmt->close();
		}
		else
		{
			die("ERROR: couldn't prepare mysql statement");
		}
	}

	function check_username($username){

		global $Database;

		if ($stmt = $Database->prepare("SELECT * FROM customers WHERE username = ?")) {
			$stmt->bind_param("s",$username);
			$stmt->execute();
			$stmt->store_result();

			if ($stmt->num_rows > 0)
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

	function checkLoginStatus()
	{
		if (isset($_SESSION['loggedin']))
		{
			return TRUE;

		}else
		{
			return FALSE;
		}
	}
	function checkCustomerLoginStatus()
	{
		if (isset($_SESSION['loggedin_customer']))
		{
			return TRUE;

		}else
		{
			return FALSE;
		}
	}

	function get_loggedin_user_id($username){
		if (isset($_SESSION['loggedin_customer']))
		{
			$data = '';
			global $Database;

			if ($stmt = $Database->prepare("SELECT id FROM customers WHERE username = ?")) {
				$stmt->bind_param("s",$username);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($userid);
				$stmt->fetch();

				if ($stmt->num_rows > 0)
				{
					$data = array('id' => $userid);
					$stmt->close();
				}else
				{
					$stmt->close();
				}
				return $data;
				
			}
		}
	}

	function logout()
	{
		session_destroy();
		session_start();
	}
}