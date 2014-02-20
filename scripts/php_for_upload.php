<?php
//$_POST['__file']
try {
  require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/utils.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.TableImages.php';
  $ajaxOtherResult = Array('result' => true, 'message' => 'Загрузка прошла успешно!');
  $post = GetPOST();
  $item_id = $post['item_id'];
  switch ($_POST['uploadType']) {
    case 'texts':
      $_POST['__file'] = $_textsImages->SetFieldByName(TextsImages::TEXT_FLD, $item_id)->Insert(true);
      break;

    case 'courses':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Course.php';
      if (empty($post['isAvatar']) || !$post['isAvatar']) {
         $_POST['__file'] = $_courseImages->SetFieldByName(CourseImages::COURSE_FLD, $item_id)->Insert(true);
      } else {
         try {
            $db->link->beginTransaction();
            $_POST['__file'] = $_image->Insert(true);
            $_course->SetFieldByName(Course::ID_FLD, $item_id)->SetFieldByName(Course::PHOTO_FLD, $_POST['__file'])->Update();
            $db->link->commit();
         } catch (DBException $e) {
            $db->link->rollback();
            throw new Exception($e->getMessage());
         }
      }
      break;

    case 'articles':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.News.php';
      if (empty($post['isAvatar']) || !$post['isAvatar']) {
         $_POST['__file'] = $_newsImages->SetFieldByName(NewsImages::NEWS_FLD, $item_id)->Insert(true);
      } else {
         try {
            $db->link->beginTransaction();
            $_POST['__file'] = $_image->Insert(true);
            $_news->SetFieldByName(News::ID_FLD, $item_id)->SetFieldByName(News::PHOTO_FLD, $_POST['__file'])->Update();
            $db->link->commit();
         } catch (DBException $e) {
            $db->link->rollback();
            throw new Exception($e->getMessage());
         }
      }
      break;

    case 'teachers':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Teachers.php';
      try {
         $db->link->beginTransaction();
         $_POST['__file'] = $_image->Insert(true);
         $_teachers->SetFieldByName(Teachers::ID_FLD, $item_id)->SetFieldByName(Teachers::PHOTO_FLD, $_POST['__file'])->Update();
         $db->link->commit();
      } catch (DBException $e) {
         $db->link->rollback();
         throw new DBException($e->getMessage());
      }
      break;

    case 'masterclasses':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.MasterClass.php';
      try {
         $db->link->beginTransaction();
         $_POST['__file'] = $_image->Insert(true);
         $_masterClass->SetFieldByName(MasterClass::ID_FLD, $item_id)->SetFieldByName(MasterClass::PHOTO_FLD, $_POST['__file'])->Update();
         $db->link->commit();
      } catch (DBException $e) {
         $db->link->rollback();
         throw new DBException($e->getMessage());
      }
      break;

    default:
      $ajaxOtherResult['result'] = false;
      $ajaxOtherResult['message'] = 'Неопознаный тип загрузки!';
      break;
  }
} catch (DBException $e) {
  $ajaxOtherResult['result'] = false;
  $ajaxOtherResult['message'] = 'Ошибка связанная с базой данных!';
}
?>