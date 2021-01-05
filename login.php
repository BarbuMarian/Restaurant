<?php 
include('includes/header.php');
include('includes/form_handler/register_form_handler.php');

?>


<div id="register_part"> 
	<form action="login.php" method="POST">

	<?php 
		if (isset($_POST['register_btn'])) {
			$register_obj =  new Register($con, $_POST['last_name'],$_POST['first_name'],$_POST['phone'],$_POST['email'],$_POST['email2'],$_POST['password'],$_POST['password2']);	
		}
	?>

		<div class="mb-3">
			<label for="last_name" class="form-label">Last Name</label>
			<input type="text" name="last_name" id="last_name" class="form-control">
		<?php 
				if (isset($_POST['register_btn'])) {
					
				$sanitize = 	$register_obj->sanitize([]);

				 /* var_dump(); */
				 var_dump($sanitize['last_name_err']);
					
				}
		?>
		</div>

		<div class="mb-3">
			<label for="first_name" class="form-label">First Name</label>
			<input type="text" name="first_name" id="first_name" class="form-control">
			<?php 
				if (isset($_POST['register_btn'])) {
					
				$sanitize = 	$register_obj->sanitize([]);

				 /* var_dump(); */
				 var_dump($sanitize['first_name_err']);
					
				}
		
		?>
		</div>

		<div class="mb-3">
			<label for="phone" class="form-label">Phone number</label>
			<input type="text" name="phone" id="phone" class="form-control">
		</div>
		
		<div class="mb-3">
		
			<label for="email" class="form-label">Email</label>
			<input type="email" name="email" id="email" class="form-control">
		</div>

		<div class="mb-3">
			<label for="email2" class="form-label">Email again</label>
			<input type="email" name="email2" id="email2" class="form-control">
		</div>

		<div class="mb-3">		
			<label for="password" class="form-label">Password</label>
			<input type="password" name="password" id="password" class="form-control">
		</div>

		<div class="mb-3">
			<label for="password2" class="form-label">Password again</label>
			<input type="password" name="password2" id="password2" class="form-control">
		</div>
		<button type="submit" class="btn btn-primary" id="register_btn" name="register_btn"> Register </button>
	</form>
</div>



<div id="login_part">
	<form action="login.php" method="POST">
		<div class="mb-3">
			<label for="email_login" class="form-label">Email address</label>
			<input type="email" class="form-control" id="email_login">
		</div>
		<div class="mb-3">
			<label for="password_login" class="form-label">Password</label>
			<input type="password" class="form-control" id="password_login">
		</div>
		<button type="submit" class="btn btn-primary" name="login">Login</button>
	</form>
</div>

<?php 

?>



<div id="click_change_login" class="show">
	<h3> Already have an account? Click here</h3>
</div>


<div id="click_change_register" class="not_show">
	<h3> Register here !</h3>
</div>

<?php 
include('includes/footer.php');
?>