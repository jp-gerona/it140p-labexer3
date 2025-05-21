<?php
function GetStudentCourses($studentName) {
    $courses = [
        "IT140P" => [
            "Course Title" => "Application Development and Emerging Technologies",
            "Lecture Hours" => 2.5,
            "Laboratory Hours" => 3.75,
            "Credit Units" => 3,
        ],
        "IT145" => [
            "Course Title" => "System Integration and Architectures",
            "Lecture Hours" => 3.75,
            "Laboratory Hours" => 0,
            "Credit Units" => 3,
        ],
        "CS198L" => [
            "Course Title" => "Comprehensive Examination Module",
            "Lecture Hours" => 0,
            "Laboratory Hours" => 3.75,
            "Credit Units" => 1,
        ],
        "IT190-2P" => [
            "Course Title" => "Networks and Security (Paired)",
            "Lecture Hours" => 2.5,
            "Laboratory Hours" => 3.75,
            "Credit Units" => 2,
        ],
        "IT190-3P" => [
            "Course Title" => "Virtualization and Cloud Security (Paired)",
            "Lecture Hours" => 2.5,
            "Laboratory Hours" => 3.75,
            "Credit Units" => 2,
        ],
    ];
    $studentRecord = [
        "Julian Peter Gerona" => [
            "Student Number" => "2022153329",
            "Year Level" => 3,
            "Program" => "Bachelor of Science in Information Technology",
            "Courses Taken" => ["IT140P", "IT145", "CS198L", "IT190-2P", "IT190-3P"],
        ],
        "Luis Gerard Tiongco" => [
            "Student Number" => "2022152009",
            "Year Level" => 3,
            "Program" => "Bachelor of Science in Information Technology",
            "Courses Taken" => ["IT140P", "IT145", "CS198L"],
        ],
        "Carl Francis Alcantara" => [
            "Student Number" => "2022153255",
            "Year Level" => 3,
            "Program" => "Bachelor of Science in Information Technology",
            "Courses Taken" => ["IT140P", "IT190-2P", "IT190-3P"],
        ],
        "Christian Kerby Salandanan" => [
            "Student Number" => "2022153519",
            "Year Level" => 3,
            "Program" => "Bachelor of Science in Information Technology",
            "Courses Taken" => [],
        ],
    ];

    if (array_key_exists($studentName, $studentRecord)) {
        $studentInfo = $studentRecord[$studentName];
        $xml = new SimpleXMLElement('<response/>');
        $xml->addChild('status', 'success');

        $studentInfoXml = $xml->addChild('studentInfo');
        $studentInfoXml->addChild('StudentName', $studentName);
        $studentInfoXml->addChild('StudentNumber', $studentInfo['Student Number']);
        $studentInfoXml->addChild('YearLevel', $studentInfo['Year Level']);
        $studentInfoXml->addChild('Program', $studentInfo['Program']);

        $coursesXml = $xml->addChild('studentCourses');
        foreach ($studentInfo["Courses Taken"] as $courseCode) {
            $courseXml = $coursesXml->addChild('course');
            $courseXml->addChild('CourseCode', $courseCode);
            $courseXml->addChild('CourseTitle', $courses[$courseCode]['Course Title']);
            $courseXml->addChild('LectureHours', $courses[$courseCode]['Lecture Hours']);
            $courseXml->addChild('LaboratoryHours', $courses[$courseCode]['Laboratory Hours']);
            $courseXml->addChild('CreditUnits', $courses[$courseCode]['Credit Units']);
        }

        return $xml->asXML();
    } else {
        $xml = new SimpleXMLElement('<response/>');
        $xml->addChild('status', 'error');
        $xml->addChild('message', "No courses were found for $studentName");
        return $xml->asXML();
    }

    // If the request is successful and the record for the student name exists in $studentRecord,
    // the XML response will look like this:
    //     <response>
    //     <status>success</status>
    //     <studentInfo>
    //       <StudentName>Julian Peter Gerona</StudentName>
    //       <StudentNumber>2022153329</StudentNumber>
    //       <YearLevel>3</YearLevel>
    //       <Program>Bachelor of Science in Information Technology</Program>
    //     </studentInfo>
    //     <studentCourses>
    //       <course>
    //         <CourseCode>IT140P</CourseCode>
    //         <CourseTitle>Application Development and Emerging Technologies</CourseTitle>
    //         <LectureHours>2.5</LectureHours>
    //         <LaboratoryHours>3.75</LaboratoryHours>
    //         <CreditUnits>3</CreditUnits>
    //       </course>
    //       <course>
    //         <CourseCode>IT145</CourseCode>
    //         <CourseTitle>System Integration and Architectures</CourseTitle>
    //         <LectureHours>3.75</LectureHours>
    //         <LaboratoryHours>0</LaboratoryHours>
    //         <CreditUnits>3</CreditUnits>
    //       </course>
    //     </studentCourses>
    //   </response>
}
?>
