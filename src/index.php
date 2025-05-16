<?php
require "backend/nusoap/lib/nusoap.php";

$client = new nusoap_client("http://localhost/it140p-labexer3/src/backend/service.php?wsdl");

$response = null;
if (isset($_POST['submit'])) {
    $studentName = $_POST['studentName'];
    $client = new nusoap_client("http://localhost/it140p-labexer3/src/backend/service.php?wsdl", true);
    $response = $client->call("GetStudentCourses", ["studentName" => $studentName]);
    $response = json_decode($response, true);
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
  <title>MMCL Student Portal</title>
  <meta name="description" content="Student Portal for MMCL College Students for the third semester of school year 2024-2025.">
</head>
<body>
  <main>
    <h1>Student Portal</h1>
    <form action="" method="POST">
      <label for="studentName">Student Name:</label>
      <input type="text" id="studentName" name="studentName" required />
      <button type="submit" name="submit">Submit</button>
    </form>

    <?php if ($response): ?>
      <?php if ($response['status'] === 'success'): ?>
        <h2>Student Information</h2>
        <p><strong>Name:</strong> <?= htmlspecialchars($studentName) ?></p>
        <p><strong>Student Number:</strong> <?= htmlspecialchars($response['studentInfo']['Student Number']) ?></p>
        <p><strong>Year Level:</strong> <?= htmlspecialchars($response['studentInfo']['Year Level']) ?></p>
        <p><strong>Program:</strong> <?= htmlspecialchars($response['studentInfo']['Program']) ?></p>

        <h2>Courses Taken</h2>
        <?php foreach ($response['studentCourses'] as $courseCode => $courseInfo): ?>
          <p><strong>Course Code:</strong> <?= htmlspecialchars($courseCode) ?></p>
          <p><strong>Course Title:</strong> <?= htmlspecialchars($courseInfo['Course Title']) ?></p>
          <p><strong>Lecture Hours:</strong> <?= htmlspecialchars($courseInfo['Lecture Hours']) ?></p>
          <p><strong>Laboratory Hours:</strong> <?= htmlspecialchars($courseInfo['Laboratory Hours']) ?></p>
          <p><strong>Credit Units:</strong> <?= htmlspecialchars($courseInfo['Credit Units']) ?></p>
          <hr>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="color: red;"><?= htmlspecialchars($response['message']) ?></p>
      <?php endif; ?>
    <?php endif; ?>
  </main>
</body>
</html>
