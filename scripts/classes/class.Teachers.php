<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';

class Teachers extends Entity
{
   const NAME_FLD      = 'name';
   const INFO_FLD      = 'info';
   const COURSE_SCHEME = 2;

   const TABLE = 'teachers';

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
            static::INFO_FLD,
            null,
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
?>