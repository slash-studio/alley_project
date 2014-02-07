<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Course.php';

$id = !empty($request[1]) ? $request[1] : null;
if (!empty($id)) {
   $course = $_course->SetSamplingScheme(Course::INFO_SCHEME)->GetById($id);
}
if (empty($id) || empty($course)) {
   header('Location: /courses');
}
$smarty->assign('course', $course)
       ->display('course.tpl');