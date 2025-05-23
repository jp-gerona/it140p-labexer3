<?php
require "backend/nusoap/lib/nusoap.php";
$client = new nusoap_client("http://localhost/it140p-labexer3/src/backend/service.php?wsdl", true);

$response = null;
$responseXml = null;

if (isset($_POST['submit'])) {
    $studentName = ucwords(strtolower($_POST['studentName']));
    $response = $client->call("GetStudentCourses", ["studentName" => $studentName]);

    $responseXml = simplexml_load_string($response);
}

function prettyPrintXml($xml) {
    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml);
    return $dom->saveXML();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MMCL Student Course Portal 3T 2024-2025</title>
  <meta name="description" content="Student Portal for MMCL College Students for the third semester of school year 2024-2025.">
  <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism.min.css">
  <link rel="icon" href="assets/mmcl-crest.png" type="image/x-icon">
  <link rel="preload" href="assets/mmcl-background.jpg" as="image">
</head>
<body>
  <!-- Header -->
  <header class="d-flex flex-wrap justify-content-center py-3 px-3 border-bottom sticky-top bg-white shadow" id="school-header">
    <a href="#" class="d-flex align-items-center me-md-auto">
      <image src="assets/mmcl-logo-horizontal.webp" alt="MMCL Logo" class="img-fluid" width="120">
    </a>
  </header>

  <main>
    <!-- Search Student & Courses Section -->
    <section class="d-flex justify-content-center align-items-center p-5 text-center fluid-container search-background">
      <div class="gradient-background"></div>
      <div class="row py-lg-5 search-content">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-bold text-primary">STUDENT COURSE PORTAL<span class="d-block text-secondary">3T 2024-2025<span></h1>
          <p class="fw-normal lead text-black mb-5">Forgot your courses? Don't worry! Simply search for your full name to quickly view the list of courses you have enrolled for the third semester of S.Y. 2024-2025.</p>
          <form action="" method="POST" class="container">
            <div class="input-group shadow-lg">
              <input type="text" id="studentName" name="studentName" class="form-control" placeholder="Juan dela Cruz" required>
              <button type="submit" name="submit" class="btn btn-primary" id="basic-addon2">
                <span class="d-none d-md-inline">Get Courses</span>
                <span class="d-inline d-md-none"><i class="bi bi-search"></i></span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- Get Student Records Section -->
    <section class="container mt-4" id="student-courses">
      <?php if ($responseXml): ?>
        <?php if ($responseXml->status == 'success'): ?>
          <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill flex-shrink-0 me-2"></i>
            Success! Student records successfully retrieved for&nbsp;<strong><?= htmlspecialchars($responseXml->studentInfo->StudentName) ?></strong>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
          <h2 class="text-secondary">Student Information</h2>
          <div class="card p-3 shadow mb-4">
              <p><strong>Name:</strong> <?= htmlspecialchars($responseXml->studentInfo->StudentName) ?></p>
              <p><strong>Student Number:</strong> <?= htmlspecialchars($responseXml->studentInfo->StudentNumber) ?></p>
              <p><strong>Year Level:</strong> <?= htmlspecialchars($responseXml->studentInfo->YearLevel) ?></p>
              <p><strong>Program:</strong> <?= htmlspecialchars($responseXml->studentInfo->Program) ?></p>
          </div>
          <h2 class="text-secondary">Courses Taken</h2>
          <?php if (count($responseXml->studentCourses->course) > 0): ?>
            <div class="table-responsive shadow">
              <table class="table table-bordered table-striped align-middle">
                <thead class="table-secondary">
                  <tr>
                    <th>Course Code</th>
                    <th>Course Title</th>
                    <th>Lecture Hours</th>
                    <th>Laboratory Hours</th>
                    <th>Credit Units</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($responseXml->studentCourses->course as $course): ?>
                    <tr>
                      <td><?= htmlspecialchars($course->CourseCode) ?></td>
                      <td><?= htmlspecialchars($course->CourseTitle) ?></td>
                      <td><?= htmlspecialchars($course->LectureHours) ?></td>
                      <td><?= htmlspecialchars($course->LaboratoryHours) ?></td>
                      <td><?= htmlspecialchars($course->CreditUnits) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php else: ?>
            <div class="card text-center p-5 shadow">
              <i class="bi bi-emoji-frown display-4 text-muted mb-3"></i>
              <p class="lead mb-0">It seems that there are no 3T courses enrolled for this student.</p>
            </div>
          <?php endif; ?>
        <?php else: ?>
          <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"></i>
            Oops!&nbsp;<strong><?= htmlspecialchars($responseXml->message) ?></strong>.
            Make sure to check your spelling and try again.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </section>

    <!-- Raw XML Response Section -->
    <section class="container mt-4 mb-5">
      <?php if ($response): ?>
        <h2 class="text-secondary">SOAP Response</h2>
        <div class="card">
          <div class="card-header font-monospace d-flex justify-content-between align-items-center">
            XML
            <small>Powered by NuSOAP v.0.9.5</small>
          </div>
          <div class="card-body shadow">
            <small>
              <pre class="language-xml bg-white"><code><?= htmlspecialchars(prettyPrintXml($response)) ?></code></pre>
            </small>
          </div>
        </div>
        <!-- Back to Top -->
        <div class="container text-center mt-4 mb-5">
          <a href="#school-header" class="btn btn-primary btn-sm shadow" id="back-to-top">
            <i class="bi bi-arrow-up"></i>
            Back to Top
          </a>
        </div>
      <?php endif; ?>
    </section>
  </main>
  <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-xml.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const backToTopButton = document.getElementById('back-to-top');
      backToTopButton.addEventListener('click', function(event) {
        event.preventDefault();
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
    });
  </script>
</body>
</html>

<?php if ($responseXml): ?>
  <script>
    window.addEventListener('DOMContentLoaded', function() {
      const section = document.getElementById('student-courses');
      const header = document.getElementById('school-header');
      if (section) {
        const headerHeight = header ? header.offsetHeight : 0;
        const sectionTop = section.getBoundingClientRect().top + window.pageYOffset;
        window.scrollTo({
          top: sectionTop - headerHeight - 16,
          behavior: 'smooth'
        });
      }
    });
  </script>
<?php endif; ?>
