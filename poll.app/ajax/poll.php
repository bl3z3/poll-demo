<?php
	session_start();
	
	//check if user is logged in
	//if (isset($_SESSION['loggedIn']))
		//echo "true";
	//else
		//echo "not logged in";
	//return;

	require "_connect.php";

	//data
	$user_id = $_SESSION['loggedIn'];
	$poll_id = 1;
	$check_poll = isset($_REQUEST['check']) ? $_GET['check'] : false;

	if ($check_poll) {
		$sql = "SELECT id FROM `poll_result` WHERE userid = '$user_id' AND pollid = '$poll_id';";

		$user_poll = mysqli_query($db, $sql);

		$response =  (mysqli_num_rows($user_poll) == 0) ? true : false; ## display poll options
		echo $response;
		exit;
	} else {
		// save user poll
		$poll_option_id = $_GET['vote'];
	    // Insert user vote
	    $query = mysqli_query($db,"INSERT INTO 
	        poll_result(pollid,poll_option_id,userid) 
	        VALUES(".$poll_id.",".$poll_option_id.",".$user_id.")");

	    if ($query) $response = 1;
		exit;
	}

	
	/*function createPoll($vote = null) {
		//get file
		$filename = 'poll_result.txt';
		$content = file($filename);

		$array = explode("||", $content["0"]);

		//polls options
		$poll_options = [
			'1' 	=> (int) $array[0],
			'2'		=> (int) $array[1],
			'3'		=> (int) $array[2],
			'4'		=> (int) $array[3],
			'5'		=> (int) $array[4],
		];

		$total = $poll_options['1']+$poll_options['2'] + $poll_options['3'] + $poll_options['4'] + $poll_options['5'];

		?>
			<img src="poll.gif" width='<?php echo(100*round($poll_options['1']/$total,2)); ?>' height='20'>
			<?php echo(100*round($poll_options['1']/$total,2)); ?>%<br>

			<img src="poll.gif" width='<?php echo(100*round($poll_options['2']/$total,2)); ?>' height='20'>
			<?php echo(100*round($poll_options['2']/$total,2)); ?>%<br>

			<img src="poll.gif" width='<?php echo(100*round($poll_options['3']/$total,2)); ?>' height='20'>
			<?php echo(100*round($poll_options['3']/$total,2)); ?>%<br>

			<img src="poll.gif" width='<?php echo(100*round($poll_options['4']/$total,2)); ?>' height='20'>
			<?php echo(100*round($poll_options['4']/$total,2)); ?>%<br>

			<img src="poll.gif" width='<?php echo(100*round($poll_options['5']/$total,2)); ?>' height='20'>
			<?php echo(100*round($poll_options['5']/$total,2)); ?>%<br>
		<?php

		// create poll
		switch ($vote) {
			case 1:
				$poll_options['1'] += 1;
				break;
			case 2:
				$poll_options['2'] += 1;
				break;
			case 3:
				$poll_options['3'] += 1;
				break;
			case 4:
				$poll_options['4'] += 1;
			case 5:
				$poll_options['5'] += 1;
				break;
			default:
				break;
		}

		//inserts votes into text file
		$insertVote = $poll_options['1']
					."||".$poll_options['2']
					."||".$poll_options['3']
					."||".$poll_options['4']
					."||".$poll_options['5'];

		$fp = fopen($filename, "w");
		fputs($fp, $insertVote);
		fclose($fp);
	}

	$vote = (isset($_REQUEST['vote'])) ? htmlentities($_REQUEST['vote']) : null;
	
	createPoll($vote);*/
