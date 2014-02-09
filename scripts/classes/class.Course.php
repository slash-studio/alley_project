<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Teachers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.TableImages.php';

class Course extends Entity
{
   const INFO_SCHEME        = 2;
   const MAIN_PAGE_SCHEME   = 3;
   const WITH_PHOTOS_SCHEME = 4;

   const NAME_FLD         = 'name';
   const PHOTO_FLD        = 'photo_id';
   const PHOTOS_FLD       = 'photos';
   const TEACHER_FLD      = 'teacher_id';
   const DESCRIPTION_FLD  = 'description';

   const TABLE = 'courses';

   const LAST_VIEWED_ID = 'last_viewed_course_id';

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
            static::NAME_FLD,
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            static::DESCRIPTION_FLD,
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            static::TEACHER_FLD,
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            static::PHOTO_FLD,
            null,
            true
         )
      );
      $this->orderFields =
         Array(
               static::RAND_FLD => null,
               static::NAME_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::NAME_FLD))
         );
   }

   public function ModifySample(&$sample)
   {
      switch ($this->samplingScheme) {
         case static::INFO_SCHEME:
         case static::WITH_PHOTOS_SCHEME:
            $key = $this->ToPrfxNm(static::PHOTOS_FLD);
            foreach ($sample as &$set) {
               $set[$key] = $set[$key] ? explode(',', $set[$key]) : Array();
            }
            break;
      }
   }

   public function SetSelectValues()
   {
      if ($this->TryToApplyUsualScheme()) return;
      $fields = Array();
      switch ($this->samplingScheme) {
         case static::MAIN_PAGE_SCHEME:
            $fields = SQL::PrepareFieldsForSelect(
               static::TABLE,
               Array(
                  $this->GetFieldByName(static::ID_FLD),
                  $this->GetFieldByName(static::NAME_FLD),
                  // $this->GetFieldByName(static::PHOTO_FLD),
               )
            );
            $this->AddOrder(static::RAND_FLD, OT_RAND);
            $this->AddLimit(5);
            break;

         case static::WITH_PHOTOS_SCHEME:
            global $_courseImages;
            $fields =
               array_merge(
                  SQL::PrepareFieldsForSelect(
                     static::TABLE,
                     Array(
                        $this->GetFieldByName(static::ID_FLD),
                        $this->GetFieldByName(static::NAME_FLD),
                        $this->GetFieldByName(static::DESCRIPTION_FLD),
                        $this->GetFieldByName(static::TEACHER_FLD),
                        $this->GetFieldByName(static::PHOTO_FLD)
                     )
                  )
               );
            $fields[] = SQL::ImageSelectSQL($this, $_courseImages, $_courseImages::COURSE_FLD);
            break;

         case static::INFO_SCHEME:
            global $_teachers, $_courseImages;
            $fields =
               array_merge(
                  SQL::PrepareFieldsForSelect(
                     static::TABLE,
                     Array(
                        $this->GetFieldByName(static::ID_FLD),
                        $this->GetFieldByName(static::NAME_FLD),
                        $this->GetFieldByName(static::DESCRIPTION_FLD),
                        $this->GetFieldByName(static::PHOTO_FLD)
                     )
                  ),
                  SQL::PrepareFieldsForSelect(
                     Teachers::TABLE,
                     $_teachers->fields
                  )
               );
            $fields[] = SQL::ImageSelectSQL($this, $_courseImages, CourseImages::COURSE_FLD);
            $this->search->SetJoins(Array(Teachers::TABLE => Array(null, Array(static::TEACHER_FLD, Teachers::ID_FLD))));
            break;
      }
      $this->selectFields = SQL::GetListFieldsForSelect($fields);
   }
}

$_course = new Course();