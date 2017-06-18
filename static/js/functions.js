function login()
{
	Finch.navigate("login");
}

function logout()
{

	Finch.navigate("logout");
}

function dashboard()
{
	
	Finch.navigate("dashboard");
}

function register()
{
	
	Finch.navigate("register");
}

function forgotpassword()
{
	
	Finch.navigate("forgotpassword");
}

function newpassword(email)
{
	Finch.navigate("createpassword", {email: email});
}

function registerUser()
{
	var username = document.getElementById("username").value;
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;

	var data ={};
	data['username'] =  username;
	data['email'] = email;
	data['password'] = password;


	$.ajax({
		url : "http://localhost/eWallet/api/register",
		type : "POST",
		async: false, 
		data: JSON.stringify(data),
		success:function(data)
		{
			// console.log(data);
			// alert(data);
			document.cookie="tokanVal="+ data;
			dashboard();
		},
		error: function()
		{
			
			alert("err")
		}

	});

	return false;
}
function loginUser()
{
	 // alert("login");
	// var username = document.getElementById("username").value;
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;

	var data = {};
	data['email'] = email;
	data['password'] = password;

	$.ajax({
		// url : "client/template/userlogin.php",
		url : "http://localhost/eWallet/api/login",
		type : "POST",
		// async: false, 
		data: JSON.stringify(data),

		success:function(data)
		{
			if(data == 'true') {
				document.cookie="tokanVal="+ data;
				dashboard();
			}
			else {
				alert(data);
				document.getElementById('login-error').innerHTML = "Invalied email or password";
			}

			
		},
		error: function()
		{
			
			alert("err");
		}

	});

	return false;
}
function forgotpassword_mail()
{
	// alert("forgot");
	var email =document.getElementById("email").value; 
	var data = {};
	data['email'] = email;

	$.ajax({
		// url :"../../../server/mailsend.php",
		url: "http://localhost/eWallet/api/sendmail",
		type :"POST",
		// async : false,
		data: JSON.stringify(data),
		success:function(data)
		{
			if(data == "Invalid email") {
				document.getElementById('email-error').innerHTML = "Invalid email.";
			} else {
				newpassword(email);
			}


		},
		error :function()
		{
			alert("error")
		},

	});
	return false;
}
function verify_token()
{
	 
	var token =document.getElementById("token").value;
	var newpassword =document.getElementById("newpassword").value;
	var email = document.getElementById("email").innerHTML;

	var data ={};
	data['token'] = token;
	data['newpassword'] = newpassword;
	data['email'] = email;

	$.ajax({
		// url : "verifiedtoken.php",
		url : "http://localhost/eWallet/api/updatepassword",
			type : "PUT",
			// async: false, 
			data: JSON.stringify(data),
			success:function(data)
			{
				alert(data);
				if(data != "Invalid token or password") {
				 	login();
				}
				else {
					document.getElementById("token-error").innerHTML = "Invalid token or password.";
				}
			},
			error: function()
			{
				
				alert("err here")
			}
	});
	return false;
}
function Resendmail()
{

	var email = document.getElementById("email").innerHTML;
	var data= {};
	data['email'] = email;

	$.ajax({
		url :"http://localhost/eWallet/api/sendmail",
		type :"POST",
		// async : false,
		data: JSON.stringify(data),
		success:function(data)
		{
			
			document.getElementById("message").innerHTML = "Resent!";
			setTimeout(function()
			{
				document.getElementById("message").innerHTML = "";
			}, 2000);
		},
		error :function()
		{
			alert("error")
		},

	});
	return false;
}