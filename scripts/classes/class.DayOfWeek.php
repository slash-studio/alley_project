<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';

class DayOfWeek extends Entity
{
   const NAME_FLD = 'name';

   const TABLE = 'days_of_week';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         $this->idField,
         new Field(
            static::NAME_FLD,
            StrType(13),
            false
         )
      );
      $this->orderFields = Array(static::NAME_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::NAME_FLD)));
   }
}

$_dayOfWeek = new DayOfWeek();