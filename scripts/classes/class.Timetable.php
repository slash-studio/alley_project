<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Time.php';

class Timetable extends Entity
{
   const TABLE_SCHEME  = 2;
   const COURSE_SCHEME = 3;
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
      $this->orderFields = Array(static::TIME_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::TIME_FLD)));
   }

   public function ModifySample(&$sample)
   {
      if (empty($sample)) return $sample;
      switch ($this->samplingScheme) {
         case static::TABLE_SCHEME:
            $result = Array();
            foreach ($sample as &$set) {
               $result[$set[$this->ToPrfxNm(static::DAY_FLD)]][] = $set;
            }
            $sample = $result;
            break;

         case static::COURSE_SCHEME:
            $result = Array();
            $startKey = SQL::ToPrfxNm(DBTime::TABLE, DBTime::START_FLD);
            $endKey   = SQL::ToPrfxNm(DBTime::TABLE, DBTime::END_FLD);
            foreach ($sample as &$set) {
               $date = new DateTime($set[$startKey]);
               $set[$startKey] = $date->format("H:i");
               $date = new DateTime($set[$endKey]);
               $set[$endKey] = $date->format("H:i");
               $result[$set[$this->ToPrfxNm(static::DAY_FLD)]][] = $set;
            }
            $sample = $result;
            break;
      }
   }

   public function SetSelectValues()
   {
      parent::SetSelectValues();
      $this->AddOrder(static::DAY_FLD, OT_ASC);
      $this->AddOrder(static::TIME_FLD, OT_ASC);
      if ($this->samplingScheme != static::COURSE_SCHEME) return;
      global $_time;
      $fields =
         array_merge(
            SQL::PrepareFieldsForSelect(
               static::TABLE,
               Array($this->GetFieldByName(static::DAY_FLD))
            ),
            SQL::PrepareFieldsForSelect(
               DBTime::TABLE,
               Array(
                  $_time->GetFieldByName(DBTime::START_FLD),
                  $_time->GetFieldByName(DBTime::END_FLD)
               )
            )
         );
      $joins = Array(
         DBTime::TABLE => Array(null, Array(static::TIME_FLD, DBTime::ID_FLD))
      );
      $this->search->SetJoins($joins);
      $this->selectFields = SQL::GetListFieldsForSelect($fields);
   }
}

$_timetable = new Timetable();