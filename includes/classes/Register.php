<?php 


class Register
{
	private $con;
	private $last_name;
	private $first_name;
	private $phone;
	private $email;
	private $email2;
	private $password;
	private $password2;
	


	public function __construct($con,$last_name,$first_name,$phone,$email,$email2, $password,$password2) {
		$this->con = $con;
		$this->last_name = $last_name;
		$this->first_name = $first_name;
		$this->phone = $phone;
		$this->email = $email;
		$this->email2 = $email2;
		$this->password = $password;
		$this->password2 = $password2;
	}

	

	public function sanitize(){

		$data = array(
			'last_name' => '',
			'first_name'=> '',
			'phone'=> '',
			'email'=> '',
			'email2' => '',
			'password'=> '',
			'password2' => '',
			'last_name_err' => '',
			'first_name_err'=> '',
			'phone_err' => '',
			'email_err' => '',
			'email2_err' => '',
			'password_err'=> '',
			'password2_err'=> '',
			
		); 

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_btn'])) {

			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = array(
				'last_name' => trim($_POST['last_name']),
				'first_name'=> trim($_POST['first_name']),
				'phone'=> trim($_POST['phone']),
				'email'=> trim($_POST['email']),
				'email2' => trim($_POST['email2']),
				'password'=> trim($_POST['password']),
				'password2' => trim($_POST['password2']),
				'last_name_err' => '',
				'first_name_err'=> '',
				'phone_err' => '',
				'email_err' => '',
				'email2_err' => '',
				'password_err'=> '',
				'password2_err'=> '',
				
			);

			$nameValidation = "/^[a-zA-Z]*$/";
			$passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
			$phoneValidation = '/^07[0-9]{8}$/';

			//validate last and first name
			if (empty($data['last_name'])) {
				$data['last_name_err'] = "Enter your last name";
				/* echo  $data['last_name_err']; */
			}
			else if(!preg_match($nameValidation, $data['last_name']) || (strlen($data['last_name']) < 3)){
				$data['last_name_err'] = "Enter a valid last name and must have at least 3 letters";
			}

			if (empty($data['first_name'])) {
				$data['first_name_err'] = "Enter your first name";
			/* 	echo  $data['first_name_err']; */
			}
			else if((!preg_match($nameValidation, $data['first_name']))  || (strlen($data['first_name']) < 3)){
				$data['first_name_err'] = "Enter a valid first name and must have at least 3 letters";
			}

			// validate email
			if (empty($data['email'])) {
				$data['email_err'] = "Enter your email";
			}
			else if($data['email'] != $data['email2']){
				$data['email_err'] = "Your emails must match";
			}
			else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
				$data['email_err'] = 'Please enter the correct format';
			}else{
				//check if email exists in DB
				$post_email = $data['email'];
				
				$sql = "SELECT * FROM users WHERE email = '$post_email'"; 
				$query = $this->con->query($sql); 

				
				if ($row = $query->fetchAll()) {
					$data['email_err'] = 'This email is already register';
				}
	
			}

 			// Validate password on length, numeric values,
			if(empty($data['password'])){
				$data['password_err'] = 'Please enter password.';
			} else if(strlen($data['password']) < 6){
				$data['password_err'] = 'Password must be at least 8 characters';
			} else if (preg_match($passwordValidation, $data['password'])) {
				$data['password_err'] = 'Password must be have at least one numeric value.';
			}

			//Validate confirm password
			 if (empty($data['password2'])) {
					$data['password2_err'] = 'Please enter password and password confirmation';
			} else {
					if ($data['password'] != $data['password2']) {
						$data['password2_err'] = 'Passwords do not match, please try again.';
					}
			}

			// validate phone number
			if (empty($data['phone'])) {
				$data['phone_err'] = "You must enter phone number";
			}
			else if (!preg_match($phoneValidation, $data['phone'])) {
				$data['phone_err'] = "You phone number must container only numbers and must start with 07 and contain 10 numbers";
			}


			if (empty($data['last_name_err']) && empty($data['first_name_err']) && empty($data['email_err']) && empty($data['email_err2'])
					 && empty($data['password_err']) && empty($data['password2_err']) && empty($data['phone_err'])){

				
				$first_name_insert = $data['first_name'];
				$last_name_insert = $data['last_name'];
				$phone_insert = $data['phone'];
				$email_insert = $data['email'];
				$password_insert = $data['password'];

				/* $data_insert = new DateTime(); */
				$data_format = date("Y-m-d H:i:s");
				

				// Hash password
				$password_insert = password_hash($data['password'], PASSWORD_DEFAULT);

				$insert_sql = "INSERT INTO users  (first_name, last_name, email, phone_number, created_date, password) 
				VALUES (?, ?, ?, ?, ?, ?)"; 

				$stm = $this->con->prepare($insert_sql); 
				$stm->execute([$first_name_insert,$last_name_insert,$email_insert,$phone_insert,$data_format,$password_insert]);
			
				header("Location: profile.php");
					
			}

	
		}
		return $data;


	}

	





	
}

?>