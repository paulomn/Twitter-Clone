<?php

    session_start();

    if (!isset($_SESSION['userid'])) {

        header('Location: index.php');

	}
	
	require_once('db.class.php');

	$userid = $_SESSION['userid'];
	$mysql = new db();
	$connection = $mysql->Connect();
	$tweetsAmount = 0;
	$followersAmount = 0;

	$sqlCommand = "SELECT COUNT(*) as tweetsAmount FROM tweets WHERE userid = $userid";
	$result = mysqli_query($connection, $sqlCommand);

	if ($result) {
		
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$tweetsAmount = $row['tweetsAmount'];

		}

	$sqlCommand = "SELECT COUNT(*) as followersAmount FROM followers WHERE userfollowedid = $userid";
	$result = mysqli_query($connection, $sqlCommand);

	if ($result) {
		
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$followersAmount = $row['followersAmount'];

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

				UpdateTimeline();
				
				$('#btnTweet').click(function(){
					if ($('#tweetText').val().length > 0) {
						$.ajax({

							url: 'createNewTweet.php',
							method: 'post',
							data: {tweetText : $('#tweetText').val()},
							
							success: function(data) {
								
								$('#tweetText').val('');
								UpdateTimeline();	
							}
						});
					}
				});

				function UpdateTimeline() {

					$.ajax({

							url: 'getTweets.php',
							
							success: function(data) {

								$('#timeline').html(data);
							}
						});

				}

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
					<li><a href="signout.php">Sign Out</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>


	<div class="container">

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
					<h4>@<?= $_SESSION['username'] ?></h4>
					<hr />
					<div class="col-md-6">
						TWEETS <br /> <?= $tweetsAmount ?>
					</div>
					<div class="col-md-6">
						SEGUIDORES <br /> <?= $followersAmount ?>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="input-group">
						<input type="text" id="tweetText" class="form-control" placeholder="What is happening right now?" maxlength="140" />
						<span class="input-group-btn">
							<button class="btn btn-default" id="btnTweet" type="button">Tweet</button>
						</span>
					</div>
				</div>
			</div>

			<div id="timeline" class="list-group"></div>
		</div>

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-body">
				<h4><a href="searchPeople.php">Look for friends</a></h4>
				</div>
			</div>
		</div>

	</div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>