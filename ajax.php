<?php
	
	$date=$_POST['date'];
 	$district=$_POST['district'];
	$age=$_POST['age'];
	$pincode=$_POST['pincode'];
	$dis=$_POST['dis'];
	$pin=$_POST['pin'];
	$cit=$_POST['cit'];
	$city=$_POST['city'];

	if($pin=='pin') {
		$url="https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/calendarByPin?pincode=".$pincode."&date=".$date."";
	}
	if ($dis=='dis') {
		$url="https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/calendarByDistrict?district_id=".$district."&date=".$date."";
	}
	if ($cit=='cit') {
		$url="https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/calendarByDistrict?district_id=".$city."&date=".$date."";
	}

	
	// $page = "index.php";
	// $sec = "10";

	$handle = curl_init($url);
	curl_setopt($handle, CURLOPT_GET);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

	$response_user = curl_exec($handle);
	//print_r($response_user);
	curl_close($handle);
	$user_result = json_decode($response_user);
	$a=$user_result->centers;
	echo '<table style="width:100%">';
	echo '<tr>';
	echo '<th>';
	echo "#";
	echo '</th>';

	echo '<th>';
	echo "Pincode";
	echo '</th>';

	echo '<th>';
	echo "Name";
	echo '</th>';

	echo '<th>';
	echo "Vaccine";
	echo '</th>';

	echo '<th>';
	echo "Age";
	echo '</th>';

	echo '<th>';
	echo "Availablity";
	echo '</th>';
	echo '</tr>';
	$i=0;
	$j=0;
	
	foreach ($user_result->centers as $center) {
		$ava= $user_result->centers[$i]->sessions[0]->available_capacity;
		
		if($age == '45+' && $user_result->centers[$i]->sessions[0]->min_age_limit == '45'){
			echo '<tr '.(($ava>=1)?'class="green"':"").'>';
			echo '<td style="width:5%">';
			echo $j;
			echo '</td>';
			echo '<td style="width:30%">';
			echo $center->pincode;
			echo '</td>';
			echo '<td style="width:30%">';
			echo $center->name;
			echo '</td>';

			foreach ($center->sessions as $sessions){
				echo '<td style="width:10%">';
				echo $sessions->vaccine;
				echo '</td>';
				
				echo '<td style="width:10%">';
				echo $sessions->min_age_limit;
				echo '</td>';
				if($sessions->available_capacity >=1){
					$sound="yes";
					echo '<td style="width:20%" data-availability="yes" class="green_new" data-id="'.$i.'">';
					echo $sessions->available_capacity;
					echo '<audio autoplay><source src="https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3" type="audio/wav" autoplay></audio>';
					echo '</td>';
				}
				else{
					$sound="no";
					echo '<td style="width:30%" class="">';
					echo 'NA';				
					echo '</td>';
				}
			}
			
			echo '</tr>';
			$j++;
		}
		else if ($age == '18+' && $user_result->centers[$i]->sessions[0]->min_age_limit == '18')
		{
			echo '<tr '.(($ava>=1)?'class="green"':"").'>';
			echo '<td style="width:5%">';
			echo $j;
			echo '</td>';
			echo '<td style="width:30%">';
			echo $center->pincode;
			echo '</td>';
			echo '<td style="width:30%">';
			echo $center->name;
			echo '</td>';
			foreach ($center->sessions as $sessions){
				echo '<td style="width:10%">';
				echo $sessions->vaccine;
				echo '</td>';
				
				echo '<td style="width:10%">';
				echo $sessions->min_age_limit;
				echo '</td>';
				if($sessions->available_capacity >=1){
					
					echo '<td style="width:20%" data-availability="yes" class="green_new" data-id="'.$i.'">';
					echo $sessions->available_capacity;
					echo '<audio autoplay><source src="https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3" type="audio/wav" autoplay></audio>';
					echo '</td>';
				}
				else{
					echo '<td style="width:30%">';
					echo 'NA';
					echo '</td>';
				}
			}
			echo '</tr>';
			$j++;
		}
		else if ($age == 'all'){

			echo '<tr '.(($ava>=1)?'class="green"':"").'>';
			echo '<td style="width:5%">';
			echo $j;
			echo '</td>';
			echo '<td style="width:30%">';
			echo $center->pincode;
			echo '</td>';
			echo '<td style="width:30%">';
			echo $center->name;
			echo '</td>';

			foreach ($center->sessions as $sessions){
				echo '<td style="width:10%">';
				echo $sessions->vaccine;
				echo '</td>';
				
				echo '<td style="width:10%">';
				echo $sessions->min_age_limit;
				echo '</td>';
				if($sessions->available_capacity >=1){

					echo '<td style="width:20%" data-availability="yes" class="green_new" data-id="'.$i.'">';
					echo $sessions->available_capacity;
					echo '<audio autoplay><source src="https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3" type="audio/wav" autoplay></audio>';
					echo '</td>';
				}
				else{
					echo '<td style="width:30%">';
					echo 'NA';
					echo '</td>';
				}
			}
			echo '</tr>';
			$j++;
		}
		else{

		}
		$i++;
	}
	echo '</table>';
?>
<style type="text/css">
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

	tr:nth-child(even) {
		background-color: #dddddd;
	}
	.green{
		background-color: #5bcc4dc2!important;
		color:black; 
		font-weight: bold; 
	}
</style>
