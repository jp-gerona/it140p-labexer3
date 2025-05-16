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
    ];

    $studentRecord = [
        "Julian Peter Gerona" => [
            "Student Number" => "2022153329",
            "Year Level" => 3,
            "Program" => "Bachelor of Science in Information Technology",
            "Courses Taken" => ["IT140P", "IT145"],
        ],
    ];

    if (array_key_exists($studentName, $studentRecord)) {
        $studentInfo = $studentRecord[$studentName];
        $studentCourses = [];
        foreach ($studentInfo["Courses Taken"] as $courseCode) {
            $studentCourses[$courseCode] = $courses[$courseCode];
        }
        return json_encode([
            "status" => "success",
            "studentInfo" => $studentInfo,
            "studentCourses" => $studentCourses,
        ]);
    } else {
        return json_encode([
            "status" => "error",
            "message" => "Record not found for: $studentName",
        ]);
    }

    // if (array_key_exists($studentName, $studentRecord)) {
    //     $studentInfo = $studentRecord[$studentName];
    //     $xml = new SimpleXMLElement('<response/>');
    //     $xml->addChild('status', 'success');

    //     $studentInfoXml = $xml->addChild('studentInfo');
    //     $studentInfoXml->addChild('StudentName', $studentName);
    //     $studentInfoXml->addChild('StudentNumber', $studentInfo['Student Number']);
    //     $studentInfoXml->addChild('YearLevel', $studentInfo['Year Level']);
    //     $studentInfoXml->addChild('Program', $studentInfo['Program']);

    //     $coursesXml = $xml->addChild('studentCourses');
    //     foreach ($studentInfo["Courses Taken"] as $courseCode) {
    //         $courseXml = $coursesXml->addChild('course');
    //         $courseXml->addChild('CourseCode', $courseCode);
    //         $courseXml->addChild('CourseTitle', $courses[$courseCode]['Course Title']);
    //         $courseXml->addChild('LectureHours', $courses[$courseCode]['Lecture Hours']);
    //         $courseXml->addChild('LaboratoryHours', $courses[$courseCode]['Laboratory Hours']);
    //         $courseXml->addChild('CreditUnits', $courses[$courseCode]['Credit Units']);
    //     }

    //     return $xml->asXML();
    // } else {
    //     $xml = new SimpleXMLElement('<response/>');
    //     $xml->addChild('status', 'error');
    //     $xml->addChild('message', "Record not found for: $studentName");
    //     return $xml->asXML();
    // }

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
