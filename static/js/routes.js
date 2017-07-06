Finch.route("login", getLogin);
Finch.route("dashboard", get_category);
Finch.route("logout", getLogout);
Finch.route("register", getRegister);
Finch.route("forgotpassword", getForgotPassword);
Finch.route("setting",getSetting);

Finch.route("createpassword", function(bindings){

	Finch.observe(["email"], function(email){
		
		createpassword(email);
	});
});

Finch.route("categorydata",function(){
	Finch.observe("category",function(category){
		get_data(category);
	})
})


Finch.listen();