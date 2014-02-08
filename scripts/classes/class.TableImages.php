<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Image.php';

class TableImages extends Entity
{
   const PHOTO_FLD  = 'photo_id';

   const TABLE = 'course_images';

   public function Insert($getLastInsertId = false)
   {
      global $db, $_image;
      $resId = -1;
      try {
         $db->link->beginTransaction();
         $resId = $_image->Insert($getLastInsertId);
         $this->SetFieldByName(static::PHOTO_FLD, $resId);
         Entity::Insert();
         $db->link->commit();
      } catch (DBException $e) {
         $db->link->rollback();
         throw new Exception($e->getMessage());
      }
      return $resId;
   }
}

class CourseImages extends TableImages
{
   const COURSE_FLD = 'course_id';

   const TABLE = 'course_images';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         new Field(
            static::ID_FLD,
            null,
            false
         ),
         new Field(
            static::PHOTO_FLD,
            null,
            true
         ),
         new Field(
            static::COURSE_FLD,
            null,
            true
         )
      );
   }

}

class NewsImages extends TableImages
{
   const NEWS_FLD  = 'news_id';

   const TABLE = 'news_images';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         new Field(
            static::ID_FLD,
            null,
            false
         ),
         new Field(
            static::PHOTO_FLD,
            null,
            true
         ),
         new Field(
            static::NEWS_FLD,
            null,
            true
         )
      );
   }
}

$_newsImages   = new NewsImages();
$_courseImages = new CourseImages();