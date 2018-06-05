
<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Your description">
	<meta name="keywords" content="Your keywords">
	<meta name="author" content="Your name">

	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/bootstrap-responsive.css" type="text/css" media="screen"> 
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">

	<script type="text/javascript" src="js/jquery.js"></script>  
	<body class="main">
		<div id="main">
			<div id="content">
				<div class="container">
					<div class="row">					
	
							<h1><span>LOGIN FORM</span></h1>
						
								<form id="ajax-login-form" class="form-horizontal" action="javascript:alert('success!');">

									<div class="control-group">
										<label class="control-label" for="username">Username:</label>
										<div class="controls">				      
											<input type="text" id="username" name="username" placeholder="Username" onBlur="if(this.value=='') this.value='Username'" onFocus="if(this.value =='Username' ) this.value=''">
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="user_password">Password:</label>
										<div class="controls">				      
											<input type="password" id="user_password" name="user_password" placeholder="Password" onBlur="if(this.value=='') this.value='Password'" onFocus="if(this.value =='Password' ) this.value=''">
										</div>
									</div>

										<button type="submit" class="submit">LOGIN</button>
									</form>							
						
						</div>	
					</div>	
				</div>

			</div>
			<script type="text/javascript" src="js/bootstrap.js"></script>
		</body>
		</html>
