<?php
$uploaddir = 'uploads/';
preg_match('/(.*)(\..*)/', basename($_FILES['uploadimage']['name']), $arr);
$ext       = $arr[2];
$filetypes = Array('.jpg', '.JPG', '.jpeg', '.JPEG');
if (!in_array($ext, $filetypes)) {
   echo 'error';
} else {
   try {
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/utils.php';
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.TableImages.php';
      $post = GetPOST();
      $item_id = $post['item_id'];
      switch ($_POST['upload_type']) {
         case 'texts':
            $file = $_textsImages->SetFieldByName(TextsImages::TEXT_FLD, $item_id)->Insert(true);
            break;

         case 'courses_photo':
            $file = $_courseImages->SetFieldByName(CourseImages::COURSE_FLD, $item_id)->Insert(true);
            break;

         case 'news_photo':
            $file = $_newsImages->SetFieldByName(NewsImages::NEWS_FLD, $item_id)->Insert(true);
            break;

         case 'teachers':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Teachers.php';
            try {
               $db->link->beginTransaction();
               $file = $_image->Insert(true);
               $_teachers->SetFieldByName(Teachers::ID_FLD, $item_id)->SetFieldByName(Teachers::PHOTO_FLD, $file)->Update();
               $db->link->commit();
            } catch (DBException $e) {
               $db->link->rollback();
               throw new DBException($e->getMessage());
            }
            break;

         default:
            echo 'error';
            break;
            exit;
      }
      // $file = $_image->/*SetFieldByName('user_id', $_POST['user_id'])->SetFieldByName('category_id', $_POST['category_id'])->SetFieldByName('name', $_POST['work_name'])->*/Insert(true);
      $path = $uploaddir . $file . '.jpg';
      if (move_uploaded_file($_FILES['uploadimage']['tmp_name'], $path)) {
         echo $file;
      } else {
         echo 'error';
      }
   } catch (DBException $e) {
      echo 'error';
   }
}