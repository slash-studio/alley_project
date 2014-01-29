<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';

class Texts extends Entity
{
   const TABLE = 'texts';

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
            false
         ),
         new Field(
            'text_head',
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            'text_body',
            null,
            true
         )
      );
      $this->orderFields = Array('name' => Array(static::TABLE, $this->GetFieldByName('name')));
   }
}

$_texts = new Texts();
?>