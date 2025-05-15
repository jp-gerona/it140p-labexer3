<?php
require "backend/nusoap/lib/nusoap.php";

$client = new nusoap_client("http://localhost/it140p-labexer3/src/backend/service.php?wsdl");

//tip: You can write php code inside html tags
//todo: user input that accepts student's full name and student number
//todo: display student's courses taken
//todo: style the page using bootstrap
//todo: finalize ui and ux
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MMCL Student Portal</title>
  <meta name="description" content="Student Portal for MMCL College Students for the third semester of school year 2024-2025.">
</head>
<body>
  <main>
    <h1>Student Portal 3T 2024-2025</h1>
    <form method="POST">
      <input type="text" required/>
      <input type="text" required/>
      <button type="submit">Submit</button>
    </form>
  </main>
</body>
</html>
