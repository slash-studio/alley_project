<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';

class Teachers extends Entity
{
   const NAME_FLD = 'name';
   const INFO_FLD = 'info';

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
      $this->orderFields = Array(static::NAME_FLD => Array(static::TABLE, $this->GetFieldByName(static::NAME_FLD)));
   }
}

$_teachers = new Teachers();
?>