<?php
$country_id=$_POST['country_id'];

$url="https://cdn-api.co-vin.in/api/v2/admin/location/districts/".$country_id."";

$handle = curl_init($url);
curl_setopt($handle, CURLOPT_GET);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

$response_user = curl_exec($handle);

curl_close($handle);
$user_result = json_decode($response_user);
foreach ($user_result as $s) {
	foreach ($s as $s1) {
		echo '<option value="'.$s1->district_id.'">'.$s1->district_name.'</option>';
	}
}
?>