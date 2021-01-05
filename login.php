<?php 
include('includes/header.php');


?>


<div id="register_part"> 
	<form action="login.php" method="POST">

	<?php 
		if (isset($_POST['register_btn'])) {
			$register_obj =  new Register($con, $_POST['last_name'],$_POST['first_name'],$_POST['phone'],$_POST['email'],$_POST['email2'],$_POST['password'],$_POST['password2']);
			$sanitize = 	$register_obj->sanitize();	
		}
	?>

		<div class="mb-3">
			<label for="last_name" class="form-label">Last Name</label>
			<input type="text" name="last_name" id="last_name" class="form-control">
			<?php 
				if (isset($_POST['register_btn'])) {		
					echo $sanitize['last_name_err'];
				}
			?>
		</div>

		<div class="mb-3">
			<label for="first_name" class="form-label">First Name</label>
			<input type="text" name="first_name" id="first_name" class="form-control">
			<?php 
				if (isset($_POST['register_btn'])) {
					echo $sanitize['first_name_err'];	
				}
			?>
		</div>

		<div class="mb-3">
			<label for="phone" class="form-label">Phone number</label>
			<input type="text" name="phone" id="phone" class="form-control">
			<?php 
				if (isset($_POST['register_btn'])) {
					echo $sanitize['phone_err'];	
				}
			?>
		</div>
		
		<div class="mb-3">
			<label for="email" class="form-label">Email</label>
			<input type="email" name="email" id="email" class="form-control">
			<?php 
				if (isset($_POST['register_btn'])) {
					echo $sanitize['email_err'];	
				}
			?>
		</div>

		<div class="mb-3">
			<label for="email2" class="form-label">Email again</label>
			<input type="email" name="email2" id="email2" class="form-control">
			<?php 
				if (isset($_POST['register_btn'])) {
					echo $sanitize['email2_err'];	
				}
			?>
		</div>

		<div class="mb-3">		
			<label for="password" class="form-label">Password</label>
			<input type="password" name="password" id="password" class="form-control">
			<?php 
				if (isset($_POST['register_btn'])) {
					echo $sanitize['password_err'];	
				}
			?>
		</div>

		<div class="mb-3">
			<label for="password2" class="form-label">Password again</label>
			<input type="password" name="password2" id="password2" class="form-control">
			<?php 
				if (isset($_POST['register_btn'])) {
					echo $sanitize['password2_err'];	
				}
			?>
		</div>
		<button type="submit" class="btn btn-primary" id="register_btn" name="register_btn"> Register </button>
	</form>
</div>



<div id="login_part">
	<form action="" method="POST">
		<?php 
			if (isset($_POST['login_btn'])) {
				$login_obj =  new Login($con, $_POST['email_login'],$_POST['password_login']);
				$login = 	$login_obj->UserLogin();	
			}
		?>
		<div class="mb-3">
			<label for="email_login" class="form-label">Email address</label>
			<input type="email" class="form-control" id="email_login" name="email_login">
			<?php 
				if (isset($_POST['login_btn'])) {
					echo $login['email_login_err'];	
				}
			?>
		</div>
		<div class="mb-3">
			<label for="password_login" class="form-label">Password</label>
			<input type="password" class="form-control" id="password_login" name="password_login">
			<?php 
				if (isset($_POST['login_btn'])) {
					echo $login['password_login_err'];	
				}
			?>
		</div>
		<button type="submit" class="btn btn-primary" name="login_btn" id="login_btn">Login</button>
	</form>
</div>





<div id="click_change_login" class="show">
	<h3> Already have an account? Click here</h3>
</div>


<div id="click_change_register" class="not_show">
	<h3> Register here !</h3>
</div>

<?php 
include('includes/footer.php');
?>