<div class="container">
	<span style="display: none" id="email" name="email">{{ email }}</span>
	<span id="token-error"></span>
	<form method="post" onsubmit="return verify_token();">
		<div class="main">
			<div class="row">
				<h2 class="col-sm-8">CREATE A NEW PASSWORD</h2>
				<h2 class="col-sm-4" style="text-align: right"  id="message"></h2>
			</div>

			<div class="form-group">
					<label  class="text">TOKEN</label>
					<input type="text" class="form-control" name="token" placeholder="Enter token" id="token">
			</div>
			
			<div class="form-group">
					<label  class="text">NEWPASSWORD</label>
					<input type="password" class="form-control" name="newpassword" placeholder="Enter newpassword" id="newpassword">
			</div>

			<div class="from-group">
				<button type="submit" class="btn btn-info" value="" name="create">create</button>
			</div>
		</div>	
	</form>

	<button type="button" class="btn btn-info" name="resend" style="margin-top: 10xp; margin-left: 940px; color: yellow" onclick="Resendmail();">RESEND TOKEN
	</button>
</div>
