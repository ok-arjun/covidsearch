<html>

<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Page Title</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet' type='text/css' media='screen' href='main.css'>
	<script src='main.js'></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body class="container">
	<div style="margin: auto; width:50%; margin-top:70px">
		<h5 style="text-align:center; text-transform:uppercase;">Corona status india</h5>
		<form action="covidtask.php" method="POST">
			<span>
				<select name="state">
					<option value="" selected>Select State</option>
					<option value="AN">Andaman Nicobars</option>
					<option value="AP">Andhra Pradesh</option>
					<option value="AR">Arunachal Pradesh</option>
					<option value="AS">Assam</option>
					<option value="BR">Bihar</option>
					<option value="CH">Chandigar</option>
					<option value="CT">Chattisgar</option>
					<option value="DN">Dadra and nagar haveli</option>
					<option value="DD">Daman Diu</option>
					<option value="DL">Delhi</option>
					<option value="GA">Goa</option>
					<option value="GJ">Gujarat</option>
					<option value="HR">Haryana</option>
					<option value="HP">Himachal Pradesh</option>
					<option value="JK">Jammu and Kashmir</option>
					<option value="JH">Jharkhand</option>
					<option value="KA">Karnataka</option>
					<option value="KL">Kerala</option>
					<option value="LD">Lakshadweep</option>
					<option value="MP">Madhya Pradesh</option>
					<option value="MH">Maharashtra</option>
					<option value="MP">Manipur</option>
					<option value="ML">Meghalaya</option>
					<option value="MZ">Mizoram</option>
					<option value="NL">Nagaland</option>
					<option value="OR">Odisha</option>
					<option value="PY">Puducherry</option>
					<option value="PB">Punjab</option>
					<option value="RJ">Rajasthan</option>
					<option value="SK">Sikkim</option>
					<option value="TN">TamilNadu</option>
					<option value="TG">Telangana</option>
					<option value="TR">Tripura</option>
					<option value="UP">Uttar Pradesh</option>
					<option value="UT">Uttarakhand</option>
					<option value="WB">West Bengal</option>
				</select>
				</label>
				<input type="text" name="district">
				<input type="submit">
		</form>
		<h6 style="text-align:center; text-transform:uppercase; margin-top:50px;">Total data of the state</h6>
	</div>
</body>

</html>

<?php
error_reporting(0);
$district = ucwords($_POST["district"]);
$state = ($_POST["state"]);
$url = file_get_contents("https://api.covid19india.org/v4/min/data.min.json");
$data = json_decode($url, true);

if (!$district && !$state) {
	echo '<script>alert("Please fill all the fields")</script>';
} elseif ($district && !$state) {
	echo '<script>alert("Must select the state to view district wise data")</script>';
} elseif (!$district && $state) {
	$data2 = $data[$state]['total'];
	$s_confirmed = $data2['confirmed'];
	$s_recovered = $data2['recovered'];
	$s_deceased = $data2['deceased'];
	echo "<table class='table'>
		<tr><th>State Codes</th><th>Confirmed Cases</th><th>Recovered</th><th>Deceased</th></tr>
		<tr><td>$state</td><td>$s_confirmed</td><td>$s_recovered</td><td>$s_deceased</td></tr>
		</table>";
} else {
	$data2 = $data[$state]['total'];
	$s_confirmed = $data2['confirmed'];
	$s_recovered = $data2['recovered'];
	$s_deceased = $data2['deceased'];
	echo "<table class='table'>
		<tr><th>State Codes</th><th>Confirmed Cases</th><th>Recovered</th><th>Deceased</th></tr>
		<tr><td>$state</td><td>$s_confirmed</td><td>$s_recovered</td><td>$s_deceased</td></tr>
		</table>";
		$data3 = $data[$state]['districts'][$district]['total'];
		if($data3){
	$confirmed = $data3['confirmed'];
	$recovered = $data3['recovered'];
	$deceased = $data3['deceased'];
		echo "<h6 style='text-align:center; text-transform:uppercase; margin-top:50px;'>Total data of the district</h6>";
		echo "<table class='table'>
		<tr><th>District</th><th>Confirmed Cases</th><th>Recovered</th><th>Deceased</th></tr>
		<tr><td>$district</td><td>$confirmed</td><td>$recovered</td><td>$deceased</td></tr>
		</table>";
	}
	else{
		echo '<script>alert("Enter a valid district")</script>';
	}
}

?>