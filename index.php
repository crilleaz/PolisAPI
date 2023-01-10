<?php
$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://polisen.se/api/events",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 120,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$response = json_decode($response, true); //because of true, it's in an array
		$sample = $response;
		?>
		<!DOCTYPE html>
			<html>
				<head>
					<meta charset='utf-8'>
					<meta name='viewport' content='width=device-width, initial-scale=1'>
					<title>Polisdatabas</title>
					<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css' rel='stylesheet'>
					<link href='#' rel='stylesheet'>
					<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
					</head>
					<link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
					<script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
					<div class="container">
						<div class="row header" style="text-align:center;color:green">
						<h3>Polisdatabas</h3>
						</div>
						<table id="example" class="table table-striped table-bordered" style="width:100%">
						<thead>
						<tr>
							<th>ID</th>
							<th>Titel</th>
							<th>Händelse</th>
							<th>GPS</th>
							<th>Typ</th>
							<th>Län</th>
							<th>Tid</th>
							</tr>
						</thead>
					<tbody>
					<?php
						for ($x = 0; $x < count($sample); $x++) {
							$name = $sample[$x]['name'];
							$id = $sample[$x]['id'];
							$summary = $sample[$x]['summary'];
							$location = $sample[$x]['location']['name'];
							$type = $sample[$x]['type'];
							$gps = $sample[$x]['location']['gps'];
							$url = $sample[$x]['url'];
							$time = $sample[$x]['datetime'];
							$time = str_replace(" +01:00", "", $time);
							$datetime = date("Y-m-d H:i:s", strtotime($time));
						echo '<tr><td>' . $id . '</td>'; 
						echo '<td>' . $name . '</td>'; 
						echo '<td>' . '<a href="https://polisen.se' . $url . '" target=_blank>' . $summary . '</a>' . '</td>';
						echo '<td>' . '<a href="https://www.google.com/maps/search/?api=1&query=' . $gps . '">✔️</a>' . '</td>';
						echo '<td>' . $type . '</td>';
						echo '<td>' . $location . '</td>';
						echo '<td>' . $datetime . '</td></tr>';
						}
					?>	
					</tbody>
						<tfoot>
						<tr>
						<th>ID</th>
						<th>Titel</th>
						<th>Händelse</th>
						<th>GPS</th>
						<th>Typ</th>
						<th>Län</th>
						<th>Tid</th>
					</tr>
				</tfoot>
			</table>
		</div>
	<script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
	<script type='text/javascript'>$(document).ready(function() {
	$('#example').DataTable();
	});
	</script>
	<script type='text/javascript'>var myLink = document.querySelector('a[href="#"]');
	myLink.addEventListener('click', function(e) {
	e.preventDefault();
	});</script>                  
	</body>
</html>