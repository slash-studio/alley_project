<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Course.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

define('CID', LAST . 'course_id');
SetLastViewedID(CID);

if (isset($_POST['mode'])) {
   $post        = GetPOST();
   $id          = isset($post['id'])          ? $post['id']          : '';
   $name        = isset($post['name'])        ? $post['name']        : '';
   $teacher     = isset($post['teacher'])     ? $post['teacher']     : '';
   $description = isset($post['description']) ? $post['description'] : '';
   $post['params'] = Array(
      Course::ID_FLD          => $id,
      Course::NAME_FLD        => $name,
      Course::TEACHER_FLD     => $teacher,
      Course::DESCRIPTION_FLD => $description
   );
   $_SESSION[CID] = $id;
   if (empty($name)) {
      SetRequiredFieldError('Название курса');
      SetLastViewedID(CID);
   } elseif (empty($description)) {
      SetRequiredFieldError('Описание курса');
      SetLastViewedID(CID);
   } else {
      HandleAdminData($_course, $post, 'courses');
   }
}
$smarty->assign('courses', $_course->AddOrder(Course::NAME_FLD, OT_ASC)->GetAll())
       ->assign('teachers', $_teachers->SetSamplingScheme(Teachers::COURSE_SCHEME)->GetAll())
       ->display('admin.courses.tpl');
?>