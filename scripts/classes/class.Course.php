<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Teachers.php';

class Course extends Entity
{
   const NAME_FLD         = 'name';
   const TEACHER_FLD      = 'teacher_id';
   const DESCRIPTION_FLD  = 'description';

   const TABLE = 'courses';

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
         )
      );
      $this->orderFields =
         Array(static::NAME_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::NAME_FLD)));
   }
}

$_course = new Course();
?>