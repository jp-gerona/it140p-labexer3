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

// The request will look like this:
// <SOAP-ENV:Envelope>
//   <SOAP-ENV:Body>
//     <tns:GetStudentCourses>
//       <studentName xsi:type="xsd:string">Julian Peter Gerona</studentName>
//     </tns:GetStudentCourses>
//   </SOAP-ENV:Body>
// </SOAP-ENV:Envelope>

$server->service(file_get_contents("php://input"));
?>
