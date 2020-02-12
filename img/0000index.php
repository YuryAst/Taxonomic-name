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
    <link href="style.css" type="text/css" rel="stylesheet">
  
  </head>
  <body class="bg-dark"> 
    <div class="container">
      <div class="row">
        <div class="col-md-5 mx-auto">
          <div class="card card-body text-center mt-5">
            <center><img src="logo.png" id="logo"></center>
            <h1 class="font-weight-bold" style="font-size: 24px; font-family:Arial, Helvetica, sans-serif">Uzzini savu taksonomisko nosaukumu!</h1>
            <form id="taksonomic-form" method="get" action="">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">Vārds:</span>
                  <input type="text" class="form-control" id="name" placeholder="Ievadi savu vārdu" name="name"/>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">Uzvārds:</span>
                  <input type="text" class="form-control" id="surname" placeholder="Ievadi savu uzvārdu" name="surname"/>
                </div>               
              </div>
              <div class="form-group">
                <input type="submit" value="Aiziet!" class="btn btn-secondary btn-sm active"/>
              </div>
            </form>
            <!-- LOADER -->
           
            <div id="loading">
              <img src="img/loading.gif" alt="">
            </div>

            <!-- RESULTS -->
            <div id="results">
            <h6 class="font-weight-bold" style="font-size: 20px;">Tavs nosaukums ir:</h6>
			<h6 class ="font-weight-bold" style="font-style: italic; font-size:30px;">

				<?php			
				$conn = pg_connect("host=localhost port=5432 dbname=ITIS user=postgres password=bumerangs21");
				if (!$conn) { echo "An error occurred.\n"; exit; }
				$result = pg_query($conn, "SELECT complete_name FROM taxonomic_units WHERE complete_name LIKE 'B%'");
				if (!$result) { echo "An error occurred.\n"; exit; }
				
				$var1 = $_GET['name'];
				$var2 = $_GET["surname"];
				if(!$var1 && !&var2) { echo "Null"; }
				else { echo "Name: " . "$var1" . "$var2" "<br />\n"; }			

				//while ($row = pg_fetch_row($result)) {
					 //echo "$row[0]";
					 //echo "<br />\n";
				//}
				?>	
				
			</h6>
            <h6 class ="font-weight-bold" id="taksTitle"  style="font-style: italic; font-size:30px;"></h6>
            <div class="form-group">
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
    </div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="app.js"></script>
  </body>
</html>
