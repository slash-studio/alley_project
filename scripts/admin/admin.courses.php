<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Course.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

SetLastViewedID(Course::LAST_VIEWED_ID);

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
   $_course->SetLastViewedID($id);
   HandleAdminData($_course, $post, 'courses');
   SetLastViewedID(Course::LAST_VIEWED_ID);
}
$smarty->assign('item_id', $_GET['item_id'])
       ->assign('courses', $_course->SetSamplingScheme(Course::WITH_PHOTOS_SCHEME)->AddOrder(Course::NAME_FLD, OT_ASC)->GetAll())
       ->assign('teachers', $_teachers->SetSamplingScheme(Teachers::COURSE_SCHEME)->GetAll())
       ->display('admin.courses.tpl');