var cookie = getCookie("access_token");

function getCookie(cname)
{
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++)
    {
        var c = ca[i];
        while (c.charAt(0) == ' ')
        {
            c = c.substring(1);
        }

        if (c.indexOf(name) == 0)
        {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function dashboard(){
	Finch.navigate("dashboard");
}

function login()
{
	Finch.navigate("login");
}

function logout()
{

	// Finch.navigate("logout");
	// finch.navigate("login");
	login();
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


function category_data(name)
{
	Finch.navigate("categorydata",{category: name})
}

function setting()
{
	Finch.navigate("setting");
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
			document.cookie="tokanVal="+ data;
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

	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;

	var data = {};
	data['email'] = email;
	data['password'] = password;

	$.ajax({
		url : "http://localhost/eWallet/api/login",
		type : "POST",
		async: false, 
		data: JSON.stringify(data),
		success:function(data)
		{
			if(data == 'false')
			{
				document.getElementById('login-error').innerHTML = "Invalied email or password";
				document.getElementById('login-error').style.color = "yellow";
				
			}
			else
			{
				document.cookie="access_token="+ data;
				Finch.navigate("dashboard");
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
	var email =document.getElementById("email").value; 
	var data = {};
	data['email'] = email;

	$.ajax({
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
			url : "http://localhost/eWallet/api/updatepassword",
			type : "PUT",
			// async: false, 
			data: JSON.stringify(data),
			success:function(data)
			{
				alert(data);
				if(data != "Invalid token or password")
				{
				 	login();
				}
				else
				{
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

function get_category()
{
	var cookie = getCookie("access_token");
	$.ajax({
		url:"http://localhost/ewallet/api/user/category",
		type:"GET",
		headers: { 'access_token': cookie },
		success:function(data)
		{
			
			 getDashboard(data);
		}
	});
	return false;
}
function show_category_form()
{

	var category = document.getElementById('category_field');
    	category.style.display="block";
		
}

function add_category()
{
	var category_name = document.getElementById("category-name").value;
	$.ajax({
			url: 'http://localhost/ewallet/api/user/category',
			type: 'POST',
			headers: { 'access_token': cookie },
			data: JSON.stringify({name: category_name}),
			success: function(data)
			{
				console.log("success");
				get_category(category_name);

			}

		});
	return false;
}

function delete_category(del)
{
	var dele = confirm("Are you sure, you want to delete it?");
	if(dele)
	{
		$.ajax({
			url: 'http://localhost/ewallet/api/user/category/' + del,
			type:'DELETE',	
			headers : { 'access_token' : cookie},
			success :function(data)
			{
				get_category();
			},
			error: function()
			{
				console.log(error);
			}
		});
	}
	
}

function show_category_edit_form(edit)
{

	var edit_div= document.getElementById('edit-div');
    edit_div.style.display="block";

    document.getElementById('edit-category').value = edit;
    document.getElementById('submit-edit').setAttribute("name",edit);

}

function edit_category(elem)
{
	var edit = elem.name;
	var form = {name: document.getElementById('edit-category').value}
	$.ajax({
			url :'http://localhost/ewallet/api/user/category/'+edit,
			type :'PUT',
			data: JSON.stringify(form),
			headers : {'access_token' : cookie},
			success : function(data)
			{
				get_category();
			},
			error:function()
			{
				console.log(error);
			}
	});
}

function get_data(category)
{
	$.ajax({
			url :'http://localhost/ewallet/api/user/category/'+category,
			type:'GET',
			headers :{'access_token' :cookie},
			dataType: 'json',
			success :function(data)
			{
				show_data_template(data);
			},
			error:function()
			{
				console.log("error");
			}
	});
}

function show_add_data_value()
{
	var kabi =document.getElementById('datavalue_field');
	kabi.style.display="block";	
}

function add_category_datavalue()
{
	var url = window.location.href;
	var category = url.split("=");
	category = category[1];
	var add_data =document.getElementById('category_data').value;
	var add_value =document.getElementById('category_value').value;

	$.ajax({
			url :"http://localhost/ewallet/api/user/category/" + category,
			type:'POST',
			data: JSON.stringify({field_name : add_data, field_value : add_value}),
			headers:{'access_token' :cookie},
			success :function(data)
			{
				
				show_data_template(data);
			},
			error:function()
			{
				console.log("error");
			}

	});
	return false;
}
function delete_data(elem)
{
	var del = confirm("are  you sure you want delete it?");

	var tr = elem.parentNode.parentNode;
	var url = window.location.href;
	var category = url.split("=");
	category_name = category[1];
	if(del)
	{
	
	
		$.ajax({
			url :'http://localhost/eWallet/api/user/category/' + category_name+'/'+ elem.id,
			type: 'DELETE',
			headers :{'access_token' :cookie},
			success :function(data)
			{
				tr.parentNode.removeChild(tr);

			},
			error:function()
			{
				console.log("error");
			}
	});
	}
	
}

function show_edit_data(field,value)
{
	var edit =document.getElementById('data_edit');
	edit.style.display ="block";
	document.getElementById('editdata').value = field;
	document.getElementById('editvalue').value = value;

    document.getElementById('category-edit').setAttribute("name",field);

}

function edit_data(elem)
{
	var field = elem.name;
	var form_data = { 	field_name: document.getElementById('editdata').value,
						field_value: document.getElementById('editvalue').value
					};
	var url = window.location.href;
	var category = url.split("=");
	category_name = category[1];


	$.ajax({
			url :'http://localhost/ewallet/api/user/category/'+category_name + "/" + field,
			type:'PUT',
			headers :{'access_token' :cookie},
			data: JSON.stringify(form_data),
			success :function(data)
			{
				// alert(data);
				data_after_edit();
			},
			error :function()
			{
				console.log("error");
			}
	});
}

function data_after_edit()
{
	var url = window.location.href;
	var category_name = url.split("=");
	category_name = category_name[1];
	$.ajax({
			url :'http://localhost/ewallet/api/user/category/'+category_name,
			type:'GET',
			headers :{'access_token' :cookie},
			dataType: 'json',
			success :function(data)
			{
				
				show_data_template(data);
			},
			error:function()
			{
				console.log("error");
			}
	});
}

function getSetting()
{
	$.ajax({
		url: 'http://localhost/ewallet/api/setting',
		type: 'GET',
		dataType: 'json',
		headers: {'access_token' : cookie},
		success: function(data)
		{
			settings_template(data);
		},
		error: function()
		{
			console.log("settings not found");
		}

	});
}

function update_Sitename()
{
	var site_name = document.getElementById("editsite-name").value;
	var data ={website_name: site_name};
	
	$.ajax({
		url :"http://localhost/ewallet/api/setting",
		type :'PUT',
		data: JSON.stringify(data),
		headers :{'access_token' :cookie},
		success:function(data)
		{
			document.getElementById("site-name").innerHTML = site_name;
			dashboard();

		},
		error:function()
		{
			console.log("update sitename");
		}
	});
	// console.log(JSON.stringify(data));
}
	
$(document).on('submit','#form',function(){

  var formData = new FormData($(this)[0]);
   $.ajax({
       url: 'http://localhost/ewallet/api/setting',
       type: 'POST',
       headers: {'access_token': cookie},
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
       success: function (data) {
           // alert(data);
			// $("#favicon").attr("href","http://localhost/eWallet/favicon/"+data.favicon);
			show_site_settings();
			Finch.navigate("dashboard");
       }

   });
   return false;
});

function show_site_settings(){
	$.ajax({
		url: 'http://localhost/ewallet/api/setting',
		type: 'GET',
		dataType: 'json',
		headers: {'access_token' : cookie},
		success: function(data)
		{
			document.getElementById("site-name").innerHTML = data.website_name;
			$("#favicon").attr("href","http://localhost/eWallet/favicon/"+data.favicon);
			console.log(data);
		},
		error: function()
		{
			console.log("settings not found");
		}

	});
}