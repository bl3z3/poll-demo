<?php

	require "_connect.php";

	$pollid = 1;

	 // Count total votes
    $pollresultData = mysqli_query($db,"SELECT count(*) as allcount FROM poll_result WHERE pollid=".$pollid);
    $pollresultData_row = mysqli_fetch_assoc($pollresultData);
    $totalVotes = $pollresultData_row['allcount'];

    // Color codes
    $colors_arr = array("#28f474","#008080","#e3242b","#ffb067");
    
    // Question 
    $pollData = mysqli_query($db,"SELECT question FROM poll WHERE id=".$pollid);
    $rowpollData = mysqli_fetch_assoc($pollData);
    $question = $rowpollData['question'];

    // Fetch poll option votes
    $pollresult_SQL = "SELECT 
       po.id,po.name,COUNT(pr.poll_option_id) as votes 
       FROM poll_options po 
       LEFT JOIN poll_result pr ON po.id=pr.poll_option_id 
       WHERE po.pollid=".$pollid." 
       GROUP BY po.id";

    $pollresultData = mysqli_query($db,$pollresult_SQL);

    // Display poll option and percentage
    $html = "
    	<h2>Result</h2>
    	<p>".$question."</p>
    	<ul>";

    $count = 0;

    while ($row = mysqli_fetch_assoc($pollresultData)) {
    	$pollid = $row['id'];
    	$pollname = $row['name'];
    	$poll_vote = $row['votes'];

    	// Get color code
    	$backgroundColor = $colors_arr[$count];
    	$count++;
    	if($count >= count($colors_arr)){
        	$count = 0;
    	}

      	// Find percentage
    	$percentage = ($poll_vote/$totalVotes)*100;
 
    	$html .= "<li>
		  			<div class='poll_option'>
		        		<div class='poll_optionname' 
		        			style='background-color: ".$backgroundColor."' 
		        			>".$pollname."
		        		</div> 
		        		<div class='poll_votes' >".round($percentage,2) ." %</div>
		      		</div>
      			</li>";

  	}

  	$html .= '</ul>';
 
  	echo $html;
 	exit;