<?php
require "nusoap/lib/nusoap.php";
require "data.php";

$server = new nusoap_server();
$server->configureWSDL("StudentService", "urn:StudentService");

$server->register(
    "GetStudentCourses",
    array("studentName" => "xsd:string"),  // Input parameter
    array("return" => "xsd:string"),      // Output parameter
    "urn:StudentService",
    "urn:StudentService#GetStudentCourses",
    "rpc",
    "encoded",
    "Fetches student information and courses based on the student name."
);

$server->service(file_get_contents("php://input"));
?>
