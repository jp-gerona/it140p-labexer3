<?php
require 'nusoap/lib/nusoap.php';

$client = new nusoap_client("http://localhost:8080/IT140P/service.php?wsdl"); // Create a instance for nusoap client

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SOAP Web Service Client Side Demo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<main class="container-fluid">
  <h1>SOAP Web Service Client Side Demo</h1>
  <form class="form-inline" action="" method="POST">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" class="form-control"  placeholder="Please Enter Item name" required/>
      <input type="text" name="code" class="form-control"  placeholder="Please enter code" required/>
    </div>
    <input type="submit" name="submit" class="btn btn-default"></input>
  </form>
  <h3>

  <?php
	if(isset($_POST['submit']))
	{
		$name =  $_POST['name'];
                $code =  $_POST['code'];
		
		$response = $client->call('get_count',array("name"=>$name,"code"=>$code));

		if(empty($response))
			echo "No data to extract from the SOAP Response";
		else
			echo $response;

          echo "<h2>Request</h2>";
	  echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
          echo "<h2>Response</h2>";
          echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";
	}
   ?>

  </h3>
</main>
</body>
</html>