<div id="content"></div>
<div class="row centerd-form">
	<div class="col-xs -12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">create a new account</h3>
			</div>

			<div class="panel-body">

				<form class="form" method="post" onsubmit="return registerUser();">
					<div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
  								<label >Username</label>
  								<input type="text" class="form-control" name="username" id="username" placeholder="Enter firstname">
							</div>
						</div>

						<div class="col-xs-6 col-sm-6 col-md-6">
							<div class="form-group">
  								<label >Lastname</label>
  								<input type="text" class="form-control" name="lastname" placeholder="Enter lastname" >
							</div>
						</div>
					</div>

					<div class="form-group">
							<label >Email</label>
							<input type="text" class="form-control" name="email" placeholder="Enter email" id="email">
					</div>

	   				<div class="form-group">
					    <label >Password</label>
					    <input type="password" class="form-control" name="password" placeholder="Enter password" id="password">
	    			</div>

					<div class="form-group">
						<button type="submit" class="btn btn-info">Register</button>
					</div>
				</form>	
			</div>
		</div>
	</div>		
</div>

