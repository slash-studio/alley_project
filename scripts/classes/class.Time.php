<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';

class DBTime extends Entity
{
   const END_FLD   = 'end';
   const START_FLD = 'start';

   const TABLE = 'time';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         $this->idField,
         new Field(
            static::START_FLD,
            TimestampType(),
            true,
            'Время начала',
            Array(Validate::IS_NOT_EMPTY, Validate::IS_TIME)
         ),
         new Field(
            static::END_FLD,
            TimestampType(),
            true,
            'Время конца',
            Array(Validate::IS_NOT_EMPTY, Validate::IS_TIME)
         )
      );
      $this->orderFields = Array(static::START_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::START_FLD)));
   }

   public function ModifySample(&$sample)
   {
      if (empty($sample)) return $sample;
      $startKey = $this->ToPrfxNm(static::START_FLD);
      $endKey   = $this->ToPrfxNm(static::END_FLD);
      foreach ($sample as &$set) {
         $date = new DateTime($set[$startKey]);
         $set[$startKey] = $date->format("H:i");
         $date = new DateTime($set[$endKey]);
         $set[$endKey] = $date->format("H:i");
      }
   }

   public function SetSelectValues()
   {
      parent::SetSelectValues();
      $this->AddOrder(static::START_FLD, OT_ASC);
   }
}

$_time = new DBTime();