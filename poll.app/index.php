<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Poll Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <style>
	    body {
	        margin-top: 20px;
	    }

	    .panel-body:not(.two-col) {
	        padding: 0px;
	    }

	    .glyphicon {
	        margin-right: 5px;
	    }

	    .glyphicon-new-window {
	        margin-left: 5px;
	    }

	    .panel-body .radio, .panel-body .checkbox {
	        margin-top: 0px;
	        margin-bottom: 0px;
	    }

	    .panel-body .list-group {
	        margin-bottom: 0;
	    }

	    .margin-bottom-none {
	        margin-bottom: 0;
	    }

	    .panel-body .radio label, .panel-body .checkbox label {
	        display: block;
	    }
	</style>

	<!-- Poll - END -->
</head>
<body>

	<div class="container">

	<div class="page-header">
	    <h1><small><center>Poll</center></small></h1>
	</div>

	<!-- Poll - START -->
	<div class="container">
	    <div class="col-md-3">
	    	<?php
	    		if (!isset($_SESSION['loggedIn'])) {
	    		?>
	    			<div class="login">
						<div class="">
							<label for="uname"><b>Username</b></label>
							<input type="text" class="form-control" placeholder="Enter Username" id="userName" required><br>

							<label for="psw"><b>Password</b></label>
							<input type="password" class="form-control" placeholder="Enter Password" id="password" required><br>

							<button type="submit" class="btn btn-info btn-sm" id="login">Login</button><br>
							<label>
							  <input type="checkbox" checked="checked" name="remember"> Remember me</br>
							  <span class="psw">Forgot <a href="#">password?</a></span>
							</label>
						</div>
					</div>

			    	<hr>
					<div class="register" style="">
						<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Register</button>
					</div>
						
					<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
						  		<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Register</h4>
							  	</div>
							  	<div class="modal-body">
									<label for="uname"><b>Username</b></label>
									<input type="text" class="form-control" placeholder="Enter Username" id="newUserName" required><br>

									<label for="psw"><b>Password</b></label>
									<input type="password" class="form-control" placeholder="Enter Password" id="newPassword" required><br>

									<button type="submit" class="btn btn-info btn-sm" id="register">Register</button><br>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							  </div>
							</div>

						</div>
					</div>
	    		<?php
	    	} else {
				?>
					<button id="logout" class="btn-danger">Logout</button>
				<?php
	    	}?>
	    	
	    </div>

	    <div class="col-md-4">
	        <div class="panel panel-primary">
	            <div class="panel-heading">
	                <h3 class="panel-title"><span class="fa fa-line-chart"></span> Please Rate our service</h3>
	            </div>
	            <div class="panel-body">
	                <ul class="list-group">
	                    <li class="list-group-item">
	                        <button id="showPoll">Vote</button>
	                    </li>
	                </ul>
	            </div>
	        </div>

	        <div id="myModalVote" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
						  		<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">You only get to vote once, so make it count.</h4>
							  	</div>
							  	<div class="modal-body">
									<div class="checkbox">
			                            <label>
			                                <input type="radio" name="poll" value="1"> Excellent
			                            </label>
			                        </div>

			                        <div class="checkbox">
			                            <label>
			                                <input type="radio" name="poll" value="2"> Good
			                            </label>
			                        </div>

			                        <div class="checkbox">
			                            <label>
			                                <input type="radio" name="poll" value="3"> Satisfactory
			                            </label>
			                        </div>

			                        <div class="checkbox">
			                            <label>
			                                <input type="radio" name="poll" value="4"> Needs Improvement
			                            </label>
			                        </div>

			                        <div class="checkbox">
			                            <label>
			                                <input type="radio" name="poll" value="5"> Poor
			                            </label>
			                        </div>
							  	</div>

							  	<div class="modal-footer">
									<button type="button" id="submitPoll">Close</button>
							  	</div>
							</div>

						</div>
					</div>
	    </div>

	    <div class="col-md-4" id="poll_result">
	    	
	    </div>
	</div>

	</div>
	<script type="text/javascript">
		$(document).ready( function () {
			//show poll result
			setInterval(function () {
				$.get('ajax/poll_result.php', function(data, status) {
					if (status == 'success') {
						$("#poll_result").html(data);
					}
				});
			}, 1000);

			// show poll if user hasn't voted
			$("#showPoll").click(function() {
				$.get('ajax/poll.php', {
					check:true,
				}, function(data, status) {
					if (status == 'success') {
						$poll =  (data == 1) ? false : true;
						if ($poll) {
							alert("Sorry you can't vote twice");
						} else {
							//show poll questions

							$("#myModalVote").modal("toggle");
						}
					}
				});

				resultPoll();
			});

			$("#submitPoll").click(function() {
				//submit poll
				//make a get request
				var $vote = $("input[name='poll']:checked").val();

				$.get('ajax/poll.php', {vote: $vote,});

				$("#myModalVote").modal("hide");

			});

		});
	</script>
	<script src="js/user.js"></script>
</body>
</html>