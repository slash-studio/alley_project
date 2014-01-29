<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';

class Teachers extends Entity
{
   const TABLE = 'teachers';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         new Field(
            'id',
            null,
            false
         ),
         new Field(
            'name',
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            'info',
            null,
            true
         )
      );
      $this->orderFields = Array('name' => Array(static::TABLE, $this->GetFieldByName('name')));
   }
}

$_teachers = new Teachers();
?>