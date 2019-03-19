<?php

	function createPoll($vote = null) {
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
	
	createPoll($vote);