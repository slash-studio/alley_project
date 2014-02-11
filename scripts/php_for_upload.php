<?php
//$_POST['__file']
function checkOther() {
  try {
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/utils.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.TableImages.php';
      $ajaxResult = Array('result' => true, 'message' => 'Загрузка прошла успешно!');
      $post = GetPOST();
      $item_id = $post['item_id'];
      switch ($_POST['upload_type']) {
         case 'texts':
            $_POST['__file'] = $_textsImages->SetFieldByName(TextsImages::TEXT_FLD, $item_id)->Insert(true);
            break;

         case 'courses_photo':
            $_POST['__file'] = $_courseImages->SetFieldByName(CourseImages::COURSE_FLD, $item_id)->Insert(true);
            break;

         case 'news_photo':
            $_POST['__file'] = $_newsImages->SetFieldByName(NewsImages::NEWS_FLD, $item_id)->Insert(true);
            break;

         case 'teachers':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Teachers.php';
            try {
               $db->link->beginTransaction();
               $_POST['__file'] = $_image->Insert(true);
               $_teachers->SetFieldByName(Teachers::ID_FLD, $item_id)->SetFieldByName(Teachers::PHOTO_FLD, $post['__file'])->Update();
               $db->link->commit();
            } catch (DBException $e) {
               $db->link->rollback();
               throw new DBException($e->getMessage());
            }
            break;

         default:
            $ajaxResult['result'] = false;
            $ajaxResult['message'] = 'Неопознаный тип загрузки!';
            return $ajaxResult;
            break;
      }
   } catch (DBException $e) {
      $ajaxResult['result'] = false;
      $ajaxResult['message'] = 'Ошибка связанная с базой данных!'
      return $ajaxResult;
   }
   return $ajaxResult;
}
?>