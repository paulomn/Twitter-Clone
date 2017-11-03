<?php

		//Detect login error
		$error = isset($_GET['error']) ? $_GET['error'] : '0';
		echo $error;

?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>

		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	
		<script>

			$(document).ready(function(){

				$('#btn_login').click(function(){

					var validForm = true;
					
					if ($('#username').val() == '') {
						$('#username').css({'border-color': 'red'});
						validForm = false;
					} else {
						$('#username').css({'border-color': 'grey'});
					}
	
					if ($('#password').val() == '') {
						$('#password').css({'border-color': 'red'});
						validForm = false;
					} else {
						$('#password').css({'border-color': 'grey'});
					}

					if (!validForm) return false;

				});

			});

		</script>
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="images/twittericon.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="signup.php">Sign Up</a></li>
	            <li class="<?= $error == '1' ? 'open' : '' ?>">
	            	<a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sign In</a>
					<ul class="dropdown-menu" aria-labelledby="entrar">
						<div class="col-md-12">
				    		<p>Already a member?</h3>
				    		<br />
							<form method="post" action="validateUser.php" id="frmLogin">
								<div class="form-group">
									<input type="text" class="form-control" id="username" name="username" placeholder="Username" />
								</div>
								
								<div class="form-group">
									<input type="password" class="form-control red" id="password" name="password" placeholder="Password" />
								</div>
								
								<button type="buttom" class="btn btn-primary" id="btn_login">Sign In</button>

								<br /><br />
								
							</form>

								<?php

									if ($error == '1') {
										echo 'User or password invalid.';
									}

								?>

						</form>
				  	</ul>
	            </li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">

	      <!-- Main component for a primary marketing message or call to action -->
	      <div class="jumbotron">
	        <h1>Welcome to twitter clone</h1>
	        <p>What is happening right now...</p>
	      </div>

	      <div class="clearfix"></div>
		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>