Finch.route("login", getLogin);
Finch.route("dashboard", getDashboard);
Finch.route("logout", getLogout);
Finch.route("register", getRegister);
Finch.route("forgotpassword", getForgotPassword);
Finch.route("createpassword", function(bindings){

	Finch.observe(["email"], function(email){
		
		createpassword(email);
	});
});
Finch.listen();