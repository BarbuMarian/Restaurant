<?php 


class  Login
{
	private $con;
	private $email;
	private $password;

	public function __construct($con,$email, $password) {
		$this->con = $con;
		$this->email = $email;
		$this->password = $password;
	}

	public function UserLogin()
	{
		$data = array(
			'email_login' => '',
			'password_login'=> '',
			'email_login_err' => '',
			'password_login_err'=> '',
		); 

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_btn'])) {

			$data = array(
				'email_login' => trim($_POST['email_login']),
				'password_login'=> trim($_POST['password_login']),
				'email_login_err' => '',
				'password_login_err'=> '',
			);

			if (empty($data['email_login'])) {
				$data['email_login_err'] = " Insert your register email";
			}
			else{
				//verify if email corresponds
				$post_email = $data['email_login'];

				$sql = "SELECT * FROM users WHERE email = '$post_email'"; 
				$query = $this->con->query($sql); 
			
        if ($row = $query->fetch()) {
					$first_name = $row['first_name'];
					$last_name = $row['last_name'];
					$phone = $row['phone_number'];
					$email = $row['email'];
					$password = $row['password'];

					// password verification
					if (empty($data['password_login'])) {
							$data['password_login_err'] = " Insert your password email";
					} 
					elseif (empty($data['email_login_err'])) {
						$post_password = $data['password_login'];

						if (password_verify($post_password, $password)) {
							$_SESSION['first_name'] = $first_name;
							$_SESSION['last_name'] = $last_name;
							$_SESSION['phone_number'] = $phone;
							$_SESSION['email'] = $email;
							
							/* header("Location: profile.php"); */
							echo "working      " . $_SESSION['first_name'];
						} else {
								$data['password_login_err'] = "This is not your password";
						}
					}
        }
				else{
				 $data['email_login_err'] = 'This is not your register email'; 
				}

			}



			
			
			

		}

		return $data;
	}



}

?>