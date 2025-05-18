<?php
require "backend/nusoap/lib/nusoap.php";
$client = new nusoap_client("http://localhost/it140p-labexer3/src/backend/service.php?wsdl", true);

$response = null;
$responseXml = null;

if (isset($_POST['submit'])) {
    $studentName = $_POST['studentName'];
    $response = $client->call("GetStudentCourses", ["studentName" => $studentName]);

    $responseXml = simplexml_load_string($response);
}
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
  <title>Student Portal</title>
  <meta name="description" content="Student Portal for MMCL College Students for the third semester of school year 2024-2025.">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <main>
    <h1>Student Portal</h1>
    <form action="" method="POST">
      <label for="studentName">Student Name:</label>
      <input type="text" id="studentName" name="studentName" required />
      <button type="submit" name="submit">Submit</button>
    </form>

    <?php if ($responseXml): ?>
      <?php if ($responseXml->status == 'success'): ?>
        <h2>Student Information</h2>
        <p><strong>Name:</strong> <?= htmlspecialchars($responseXml->studentInfo->StudentName) ?></p>
        <p><strong>Student Number:</strong> <?= htmlspecialchars($responseXml->studentInfo->StudentNumber) ?></p>
        <p><strong>Year Level:</strong> <?= htmlspecialchars($responseXml->studentInfo->YearLevel) ?></p>
        <p><strong>Program:</strong> <?= htmlspecialchars($responseXml->studentInfo->Program) ?></p>

        <h2>Courses Taken</h2>
        <?php foreach ($responseXml->studentCourses->course as $course): ?>
          <p><strong>Course Code:</strong> <?= htmlspecialchars($course->CourseCode) ?></p>
          <p><strong>Course Title:</strong> <?= htmlspecialchars($course->CourseTitle) ?></p>
          <p><strong>Lecture Hours:</strong> <?= htmlspecialchars($course->LectureHours) ?></p>
          <p><strong>Laboratory Hours:</strong> <?= htmlspecialchars($course->LaboratoryHours) ?></p>
          <p><strong>Credit Units:</strong> <?= htmlspecialchars($course->CreditUnits) ?></p>
          <hr>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="color: red;"><?= htmlspecialchars($responseXml->message) ?></p>
      <?php endif; ?>
    <?php endif; ?>

    <?php if ($response): ?>
      <h2>Raw XML Payload</h2>
      <pre><?= htmlspecialchars($response) ?></pre>
    <?php endif; ?>
  </main>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
