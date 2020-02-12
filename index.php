<?php
		$conn = pg_connect("host=localhost port=5432 dbname=ITIS user=postgres password=bumerangs21");
		if (!$conn) { echo "An error occurred.\n"; exit; }
			$var1 = $_GET['name'];
			$var2 = $_GET['surname'];
			$var3 = $var1[0].$var1[1];
			$var4 = $var2[0].$var2[1];
			$res;
			$levRes;
			$lev;
			$res2;
			$levRes2;
			$lev2;
			$taxN;
			$taxS;
			
		$result = pg_query($conn, "SELECT complete_name FROM taxonomic_units WHERE complete_name LIKE '$var3%'");
		if (!$result) { echo "An error occurred.\n"; exit; }				
		while ($row = pg_fetch_row($result)) {					
			$lev = levenshtein($row[0], $var1);
			if($lev < $res || $res == 0) { $res = $lev; }
		}				
		
		$result2 = pg_query($conn, "SELECT complete_name FROM taxonomic_units WHERE complete_name LIKE '$var3%'");
		if (!$result2) { echo "An error occurred.\n"; exit; }
		while ($row2 = pg_fetch_row($result2))  {
			$levRes = levenshtein($row2[0], $var1);
			if($levRes === $res) {
				$taxN = $row2[0] . " "; 
				break; }						
		}	
		
		$result3 = pg_query($conn, "SELECT complete_name FROM taxonomic_units WHERE complete_name LIKE '$var4%'");
		if (!$result3) { echo "An error occurred.\n"; exit; }				
		while ($row3 = pg_fetch_row($result3)) {					
			$lev2 = levenshtein($row3[0], $var2);
			if($lev2 < $res2 || $res2 == 0) { $res2 = $lev2; }
		}				
		
		$result3 = pg_query($conn, "SELECT complete_name FROM taxonomic_units WHERE complete_name LIKE '$var4%'");
		if (!$result3) { echo "An error occurred.\n"; exit; }
		while ($row4 = pg_fetch_row($result3))  {
			$levRes2 = levenshtein($row4[0], $var2);
			if($levRes2 === $res2) {
				$taxS = $row4[0];
				break; }						
		}
			$tax = $taxN . $taxS;

?> 

<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> 
		<link href="bootstrap.min.css" type="text/css" rel="stylesheet">
		<link href="bootstrap2.min.css" type="text/css" rel="stylesheet">	
				
	</head>
	<body class="bg-dark"> 
		<div class="container">
		  <div class="row">
			<div class="col-md-5 mx-auto">
			  <div class="card card-body text-center mt-5">
				<center><a href="http://localhost:81/"><img src="logo.png" id="logo"></a></center>
				<h1 class="font-weight-bold" style="font-size: 24px; font-family:Arial, Helvetica, sans-serif">Uzzini savu taksonomisko nosaukumu!</h1>
				<form id="taksonomic-form" method="get" action="">
				  <div class="form-group">
					<div class="input-group">
					  <span class="input-group-addon">Vārds:</span>
					  <input type="text" class="form-control" id="name" placeholder="bez mīkstinājumiem un garumzīmēm" name="name"/>
					</div>
				  </div>
				  <div class="form-group">
					<div class="input-group">
					  <span class="input-group-addon">Uzvārds:</span>
					  <input type="text" class="form-control" id="surname" placeholder="bez mīkstinājumiem un garumzīmēm" name="surname"/>
					</div>               
				  </div>
				  <div class="form-group">
					<input type="submit" value="Aiziet!" class="btn btn-secondary btn-sm active" name="use_button"/>
				  </div>
				</form>				
				
			<!-- LOADER
			<div id="loading" style="display:none">		
              <img src="img/loading.gif" alt="">
            </div>  -->
			
			<!-- RESULTS-->
			<?php
			if(isset($_GET['use_button'])) {
				//if($tax !="") {
					echo
					'<div><h6 class="font-weight-bold" style="font-size: 20px;">Tavs nosaukums ir:</h6>
						<h6 class ="font-weight-bold" style="font-style: italic; font-size:30px;" id="taksTitle">' . $tax . '</h6></div>' . 
									   '<div class="form-group">
						   <input type="submit" value="Printēt apliecinājumu" class="btn btn-secondary btn-sm active" onclick="exportHTML();">
						 </div>
						<div class="form-group">
							<div class="input-group">
							  <span class="input-group-addon">Tavs e-pasts:</span>
							  <input type="text" class="form-control" id="total-payment" placeholder="Ievadi savu e-pastu">
							</div>
						</div>
						<div class="form-group">
							<input type="submit" value="Nosūtīt apliecinājumu uz e-pastu" class="btn btn-secondary btn-sm active">
						</div>
						  <center><img src="footer.png" id="logo"></center>
					</div>
				  </div>
				</div>
			  </div>
						</div>'; 
						//}
				//else { 
					//echo 
						//'<div><h6 class="font-weight-bold" style="font-size: 20px;">Pārbaudiet, vai ir aizpildīti abi lauki!</h6>				
					//</div>
				 // </div>
				//</div>
			  //</div>' }
			}
			?>

		<script src="app.js"></script>
	</body>
</html>