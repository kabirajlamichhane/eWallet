<div class="container">
	<form id="log" method="post" onsubmit="return loginUser();">
		<span id="login-error"></span>
		<h2>LOGIN</h2>
		<div class="form-group" id="register">
				<a href="registration.php" class="btn btn-success">register</a>
		</div>
		<div class="main">
			<div class="form-group">
					<label  class="text">Email</label>
					<input type="text" class="form-control" name="email" placeholder="Enter username" id="email">
			</div>

		    <div class="form-group">
		      <label class="text" >Password:</label>
		      <input type="text" class="form-control" name="password" placeholder="Enter password" id="password">
		    </div>

			<div class="from-group">
				<button type="submit" class="btn btn-info" value="" name="login">LOGIN</button>
			</div>

			<div class="from-group" id="forgot">
				<a  class=" btn btn-danger" id="forgotpassword" onclick="return forgotpassword()">forgotpassword?</a>		
			</div>	
		</div>	
	</form>
</div>



