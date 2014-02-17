<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';

class Timetable extends Entity
{
   const DAY_FLD    = 'day_id';
   const TIME_FLD   = 'time_id';
   const COURSE_FLD = 'course_id';

   const TABLE = 'timetable';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         $this->idField,
         new Field(
            static::DAY_FLD,
            IntType(),
            true
         ),
         new Field(
            static::TIME_FLD,
            IntType(),
            true
         ),
         new Field(
            static::COURSE_FLD,
            IntType(),
            true
         )
      );
      $this->orderFields = Array(static::DAY_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::DAY_FLD)));
   }

   public function ModifySample(&$sample)
   {
      if (empty($sample)) return $sample;
      $result = Array();
      foreach ($sample as &$set) {
         $result[$set[$this->ToPrfxNm(static::DAY_FLD)]][] = $set;
      }
      $sample = $result;
   }

   public function SetSelectValues()
   {
      parent::SetSelectValues();
      $this->AddOrder(static::DAY_FLD, OT_ASC);
   }
}

$_timetable = new Timetable();