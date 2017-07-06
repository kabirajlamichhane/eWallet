function getRegister() {
	$.ajax({

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
	$.ajax({
			url :"http://localhost/eWallet/template/login.php",
			success:function(data)
			{

				var loginform = Handlebars.compile(data);

				var html = loginform();

				document.getElementById("mainbody").innerHTML = html;

			},
			error:function()
			{
				alert("error");
			}

			});

}

function getDashboard(categories)
{
	categories = JSON.parse(categories);
	var cookie = getCookie('access_token');
	$.ajax({
		
			url :"http://localhost/eWallet/template/dashboard.php",
			type: 'GET',
			headers: {'access_token': cookie},
			success:function(data)
			{
				// alert(data);
				// alert("here")
				var tamplate = Handlebars.compile(data);
				var html = tamplate({
					data: categories
				}
				);
				document.getElementById("mainbody").innerHTML = html;
			},
			error:function(error)
			{
				alert("dashboard");
			}
	});
}


function getForgotPassword()
{
	$.ajax({
			url :"http://localhost/eWallet/template/forgotpassword.php",
			success :function(data)
			{
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
}

function show_data_template(categorydata)
{

	var cookie = getCookie('access_token');
	$.ajax({
		
			url :"http://localhost/eWallet/template/category_data.php",
			type: 'GET',
			headers: {'access_token': cookie},
			success:function(data)
			{
				// var category_data = {"categorydata" : categorydata};
				var tamplate = Handlebars.compile(data);
				var html = tamplate(categorydata);
				document.getElementById("mainbody").innerHTML = html;
			},
			error:function(error)
			{
				alert("erro");
			}
	});
}

function settings_template(settings){
	$.ajax({
		url : "http://localhost/eWallet/template/setting.php",
		type: 'GET',
		headers : {'access_token' : cookie},
		success : function(data)
		{
			// alert(data);
			var tamplate =Handlebars.compile(data);
			var html =tamplate(settings);
			document.getElementById("mainbody").innerHTML = html;
		},
		error : function(error)
		{
			console.log(error);
		}
	});
}

