<?php
/*
Associative multidimensional arrays for course information and student information.
Reference: https://www.geeksforgeeks.org/multidimensional-arrays-in-php/
*/

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
        "Program" => "Bachelor of Science in Information Technology",
        "Courses Taken" => ["IT140P", "IT145"],
    ],
];

function GetStudentCourses($studentName) {
    global $studentRecord, $courses;

    try {
        if (!array_key_exists($studentName, $studentRecord)) {
            throw new Exception("Student not found.");
        }

        $studentInfo = $studentRecord[$studentName];
        $courseCodes = $studentInfo["Courses Taken"];
        $courseDetails = [];

        foreach ($courseCodes as $code) {
            if (array_key_exists($code, $courses)) {
                $courseDetails[$code] = $courses[$code];
            } else {
                throw new Exception("Course code $code not found.");
            }
        }

        return [
            "Student Number" => $studentInfo["Student Number"],
            "Program" => $studentInfo["Program"],
            "Courses" => $courseDetails,
        ];
    } catch (Exception $e) {
        return ["error" => $e->getMessage()];
    }
}
?>
