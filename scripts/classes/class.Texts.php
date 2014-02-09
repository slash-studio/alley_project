<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';

class Texts extends Entity
{
   const NAME_FLD      = 'name';
   const TEXT_HEAD_FLD = 'text_head';
   const TEXT_BODY_FLD = 'text_body';

   const TABLE = 'texts';

   const LAST_VIEWED_ID = 'last_viewed_texts_id';

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
            false
         ),
         new Field(
            static::TEXT_HEAD_FLD,
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            static::TEXT_BODY_FLD,
            null,
            true
         )
      );
      $this->orderFields = Array(static::NAME_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::NAME_FLD)));
   }
}

$_texts = new Texts();