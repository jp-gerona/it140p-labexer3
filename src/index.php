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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Course Portal</title>
  <meta name="description" content="Student Portal for MMCL College Students for the third semester of school year 2024-2025.">
  <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <header class="d-flex flex-wrap justify-content-center py-3 px-3 border-bottom">
    <a href="#" class="d-flex align-items-center me-md-auto">
      <image src="assets/mmcl-logo-horizontal.webp" alt="MMCL Logo" class="img-fluid" width="120">
    </a>
  </header>
  <main>
    <section class="d-flex justify-content-center align-items-center p-5 text-center fluid-container search-background">
    <div class="gradient-background"></div>
      <div class="row py-lg-5 search-content">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-bold text-primary">STUDENT COURSE PORTAL<span class="d-block text-secondary">3T 2024-2025<span></h1>
          <p class="fw-normal lead text-black mb-5">Forgot your courses? Don't worry! Quickly look up your courses for the third semester of S.Y. 2024-2025 just by entering your full name.</p>
          <form action="" method="POST" class="container">
            <div class="input-group">
              <input type="text" id="studentName" name="studentName" class="form-control" placeholder="Juan dela Cruz" required>
              <button type="submit" name="submit" class="btn btn-primary" id="basic-addon2">Get courses</button>
            </div>
          </form>
        </div>
      </div>
    </section>

    <?php if ($responseXml): ?>
      <?php if ($responseXml->status == 'success'): ?>
        <h2>Student Information</h2>
        <div class="container">
            <p><strong>Name:</strong> <?= htmlspecialchars($responseXml->studentInfo->StudentName) ?></p>
            <p><strong>Student Number:</strong> <?= htmlspecialchars($responseXml->studentInfo->StudentNumber) ?></p>
            <p><strong>Year Level:</strong> <?= htmlspecialchars($responseXml->studentInfo->YearLevel) ?></p>
            <p><strong>Program:</strong> <?= htmlspecialchars($responseXml->studentInfo->Program) ?></p>
        </div>

        <h2>Courses Taken</h2>
        <?php foreach ($responseXml->studentCourses->course as $course): ?>
          <div class="container">
              <p><strong>Course Code:</strong> <?= htmlspecialchars($course->CourseCode) ?></p>
              <p><strong>Course Title:</strong> <?= htmlspecialchars($course->CourseTitle) ?></p>
              <p><strong>Lecture Hours:</strong> <?= htmlspecialchars($course->LectureHours) ?></p>
              <p><strong>Laboratory Hours:</strong> <?= htmlspecialchars($course->LaboratoryHours) ?></p>
              <p><strong>Credit Units:</strong> <?= htmlspecialchars($course->CreditUnits) ?></p>
          </div>
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
  <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
