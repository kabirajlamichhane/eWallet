<!DOCTYPE html>
<html>
<head>
	<title>registarion</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/eWallet/static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/eWallet/static/css/register.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/eWallet/static/css/log.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/eWallet/static/css/category_data.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/eWallet/static/css/forgotpassword.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/eWallet/static/css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/eWallet/static/css/setting.css">
	<link id="favicon" rel="shortcut icon" type="image/X-icon" href="">
	<script src="http://localhost/eWallet/static/js/jquery-3.2.1.min.js"></script>
	<script src="http://localhost/eWallet/static/js/handlebars-v4.0.10.js"></script>
	<script src="http://localhost/eWallet/static/js/finchjs/finch.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse">
	  	<div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" id="site-name" href="index.php"></a>
		    </div>

		    <ul class="nav navbar-nav navbar-right">

		    	<li><a onclick="register();"><span class="glyphicon glyphicon-log-in"></span>registration</a></li>

			    <li><a onclick="login();"><span class="glyphicon glyphicon-user" id="login"></span>login</a></li>

			    <li><a onclick="setting();"><span class="glyphicon glyphicon-cog" id="setting"></span>setting</a></li>

			    <li><a onclick="return logout();"><span class="glyphicon glyphicon-log-out" id = "logout" ></span>logout</a></li>
			    
    		</ul>
		</div>
	</nav>

	<div id="mainbody">	
	</div>

	<div class="navbar navbar-inverse navbar-fixed-bottom">
		<div class="container">
			<p class="navbar-text">@copy right product of eagle vision it</p>
		</div>
	</div>


	<script src="http://localhost/eWallet/static/js/templates.js"></script>
	<script src="http://localhost/eWallet/static/js/functions.js"></script>
	<script src="http://localhost/eWallet/static/js/routes.js"></script>
	<script>
	show_site_settings();
	</script>
</body>
</html>
	

