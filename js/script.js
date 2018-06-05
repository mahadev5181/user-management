/**
 *  
 *  Description: Client side validation and Ajax calls goes here
 *  Author: Mahadev Shetye
 *  Version: 1
 */
$(document).ready(function(){	
	$( "#login_btn" ).click(function() {	
		var username = $.trim($('#username').val());
		var user_password = $.trim($('#user_password').val());
		var msg = '';
		var focus = '';
		//Validate Username
		if(username == ''){
			msg = 'Username should not be empty.<br>';
			focus = 'username';
		}
		//Validate Password
		if(user_password == ''){
			msg += 'Password should not be empty.<br>';
			if(focus == ''){
				focus = 'user_password';
			}
		}
		//Display error message
		if(msg != ''){
			$("#error_display").html(msg);	
			$("#error_display").show();
			if(focus != ''){
				$("#"+focus).focus();	
			}
			return false;
		}


		//Ajax call to validate user to login and update last_login date
		$.ajax({
				url: "./index.php?Controller/validation",
				type: 'POST',
				data: {					
					username:username,
					user_password:user_password
				},
				dataType: 'html',
				success: function(response) {							
					if(response == 0){
						$("#error_display").html('Invalid Username or Password');	
					}else{
						window.location.href = "./index.php?Controller/sucess";
					}											
				}
			});
	});
	
	//Enter key event. Trigger the click event for the 'LOGIN' button when enterkey is pressed in the password field
	$('#user_password').keypress(function(e) {
	    if(e.which == 13) {
	        jQuery( "#login_btn" ).click();
	    }
	});
});