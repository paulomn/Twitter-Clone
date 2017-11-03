<?php

    session_start();

    if (!isset($_SESSION['userid'])) {

        header('Location: index.php');

    }

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
				
				$('#btnSearch').click(function(){

					if ($('#peopleName').val().length > 0) {
						$.ajax({

							url: 'getPeople.php',
							method: 'post',
							data: {username : $('#peopleName').val()},
							
							success: function(data) {
								
                                $('#people').html(data);

								$('.btnFollow').click(function(){

									button = $(this);

									var userFollowedid =  button.attr('data-userid');
									var followerid = button.attr('data-followerid');
									
									$.ajax({

										url: 'followPeople.php',
										method: 'post', 
										datatype: 'text',
										data: {userfollowedid: userFollowedid, followerid: followerid},

										success: function(data) {

											response = jQuery.parseJSON(data);

											button.attr('data-followerid', response.followerid);

											if (response.followerid == 0) {

												button.html('Follow');

											} else {

												button.html('Unfollow');

											}
										}

									});

								});
							}
						});
					}
				});
				

				$('.bteste').click(function(){

					alert($(this).text());

					$(this).text('teste');
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
                    <li><a href="home.php">Back to Home</a></li>
					<li><a href="signout.php">Sign Out</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>


	<div class="container">

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<h4><?= $_SESSION['userid'] ?></h4>
					<hr />
					<div class="col-md-6">
						TWEETS <br /> 1
					</div>
					<div class="col-md-6">
						SEGUIDORES <br /> 1
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="input-group">
						<input type="text" id="peopleName" class="form-control" placeholder="Who are you looking for?" maxlength="140" />
						<span class="input-group-btn">
							<button class="btn btn-default" id="btnSearch" type="button">Search</button>
						</span>
					</div>
				</div>
			</div>

			<div id="people" class="list-group"></div>
		</div>

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					
				</div>
			</div>
		</div>

	</div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>