<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';

class Teachers extends Entity
{
   const COURSE_SCHEME = 2;

   const NAME_FLD  = 'name';
   const INFO_FLD  = 'info';
   const PHOTO_FLD = 'photo_id';

   const TABLE = 'teachers';

   const LAST_VIEWED_ID = 'last_viewed_teachers_id';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         $this->idField,
         new Field(
            static::NAME_FLD,
            StrType(120),
            true,
            'имя преподавателя',
            Array(Validate::IS_NOT_EMPTY)
         ),
         new Field(
            static::INFO_FLD,
            TextType(),
            true,
            'информация о преподавателе',
            Array(Validate::IS_NOT_EMPTY)
         ),
         new Field(
            static::PHOTO_FLD,
            IntType(),
            true
         )
      );
      $this->orderFields = Array(static::NAME_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::NAME_FLD)));
   }

   public function SetSelectValues()
   {
      $this->AddOrder(static::NAME_FLD);
      if ($this->TryToApplyUsualScheme()) return;
      $this->CheckSearch();
      $fields = Array();
      switch ($this->samplingScheme) {
         case static::COURSE_SCHEME:
            $fields = SQL::PrepareFieldsForSelect(
               static::TABLE,
               Array(
                  $this->GetFieldByName(static::ID_FLD),
                  $this->GetFieldByName(static::NAME_FLD)
               )
            );
            break;
      }
      $this->selectFields = SQL::GetListFieldsForSelect($fields);
   }

}

$_teachers = new Teachers();