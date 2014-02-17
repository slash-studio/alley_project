<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Time.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.DayOfWeek.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Course.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Timetable.php';

$times = $_time->GetAll();
$daysOfWeek = $_dayOfWeek->GetAll();
array_unshift($times, '');
array_unshift($daysOfWeek, '');
$smarty->assign('times', $times)
       ->assign('days', $daysOfWeek)
       ->assign('timetable', $_timetable->GetAll())
       ->assign('courses', $_course->SetSamplingScheme(Course::TIMETABLE_SCHEME)->GetAll())
       ->display('admin.table.tpl');