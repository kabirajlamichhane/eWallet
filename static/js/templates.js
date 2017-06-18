function getRegister() {
	$.ajax
	({
		url :"http://localhost/eWallet/template/registration.php",
		success:function(data)
		{

			var tamplate = Handlebars.compile(data);
			var html = tamplate();
			document.getElementById("mainbody").innerHTML = html;
		},
		error:function(error)
		{
			alert("erro");
		}
	});

}

function getLogin() {
	$.ajax
	({
	url :"http://localhost/eWallet/template/login.php",
	// data :"",
	success:function(data)
	{

		var loginform = Handlebars.compile(data);

		var html = loginform();

		document.getElementById("mainbody").innerHTML = html;
		// document.getElementById('logout').style.visibility = 'hidden';

	},
	error:function()
	{
		alert("error");
	}

	});

}

function getDashboard() {
	$.ajax
	({
		url :"http://localhost/eWallet/template/dashboard.php",
		success:function(data)
		{
			// alert(data);
			var tamplate = Handlebars.compile(data);
			var html = tamplate();
			document.getElementById("mainbody").innerHTML = html;
		},
		error:function(error)
		{
			alert("erro");
		}
	});
}


function getForgotPassword()
{
	$.ajax
	({
		url :"http://localhost/eWallet/template/forgotpassword.php",
		success :function(data)
		{
			// alert(data);
			var forgot =  Handlebars.compile(data);

			var html = forgot();

			document.getElementById("mainbody").innerHTML =html;

		},
		error: function()
		{
			alert("erro");
		}

	});

}
function createpassword(email)
{
	$.ajax
	({
		url :"http://localhost/eWallet/template/newpassword.php",
		success :function(data)
		{

			var template =  Handlebars.compile(data);

			var context = {
				email: email
			}

			var html = template(context);

			document.getElementById("mainbody").innerHTML = html;


		},
		error: function()
		{
			alert("erro");
		}

	});
}

function getLogout()
{
	document.cookie = 'tokanVal' + '=; expires=Thu, 01 Jan 1970 00:00:0;';

    document.getElementById("mainbody").innerHTML = "";
    // document.getElementById('login').style.visibility = 'hidden';
}
