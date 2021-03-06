<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Course.php';

$id = !empty($request[1]) ? $request[1] : null;
if (!empty($id)) {
   $course = $_course->SetSamplingScheme(Course::INFO_SCHEME)->GetById($id);
   $courseTime = $_course->GetTimetable($id);
}
if (empty($id) || empty($course)) {
   header('Location: /courses');
}
$smarty->assign('course', $course)
       ->assign('courseTime', $courseTime)
       ->display('course.tpl');