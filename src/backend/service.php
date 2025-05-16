<?php
require "nusoap/lib/nusoap.php";
require "data.php";

$server = new nusoap_server(); // Create a instance for soap server

$server->configureWSDL("Soap Service Test","urn:soaptest"); // Configure Web Services Description Language file

$server->register(
    "GetStudentCourses",
    array("studentName" => "xsd:string"),  // inputs
    array("return" => "tns:StudentCoursesResponse"),  // outputs
);

$server->service(file_get_contents("php://input"));

?>
