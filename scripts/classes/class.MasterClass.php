<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Teachers.php';

class MasterClass extends Entity
{
   const MAIN_PAGE_SCHEME = 2;

   const NAME_FLD        = 'name';
   const DATE_FLD        = 'date_of';
   const PHOTO_FLD       = 'photo_id';
   const DESCRIPTION_FLD = 'description';

   const TABLE = 'master_class';

   private $dateOfInterval = 1;

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         $this->idField,
         new Field(
            static::NAME_FLD,
            StrType(150),
            true,
            'название мастер-класса',
            Array(Validate::IS_NOT_EMPTY)
         ),
         new Field(
            static::DESCRIPTION_FLD,
            TextType(),
            true
         ),
         new Field(
            static::PHOTO_FLD,
            IntType(),
            true
         ),
         new Field(
            static::DATE_FLD,
            TimestampType(),
            true,
            'дата мастер-класса',
            Array(Validate::IS_NOT_EMPTY)
         )
      );
      $this->orderFields =
         Array(static::DATE_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::DATE_FLD)));
   }

   public function ResetDateOfInterval()
   {
      $this->dateOfInterval = 0;
      return $this;
   }

   public function ModifySample(&$sample)
   {
      switch ($this->samplingScheme) {
         case static::MAIN_PAGE_SCHEME;
            $key = $this->ToPrfxNm(static::DATE_FLD);
            foreach ($sample as &$set) {
               $date = new DateTime($set[$key]);
               $set[$key] = $date->format('j') . ' ' . GetBentMonthByNumber($date->format('n'));
            }
      }
   }

   public function SetSelectValues()
   {
      $this->AddOrder(static::DATE_FLD, OT_ASC);
      $this->search->AddClause(
         CCond(
            CCond(
               CF(static::TABLE, $this->GetFieldByName(static::DATE_FLD)),
               CVS('INTERVAL ' . $this->dateOfInterval . ' HOUR'),
               'AND',
               '+'
            ),
            CVS(MYSQL_NOW),
            'AND',
            '>'
         )
      );
      if ($this->TryToApplyUsualScheme()) return;
      $fields = Array();
      switch ($this->samplingScheme) {
         case static::MAIN_PAGE_SCHEME:
            $this->AddLimit(1);
            $fields = SQL::PrepareFieldsForSelect(static::TABLE, $this->fields);
            break;
      }
      $this->selectFields = SQL::GetListFieldsForSelect($fields);
   }

   public function Insert($getLastInsertId = false)
   {
      global $db;
      $resId = -1;
      try {
         $db->link->beginTransaction();
         $resId = parent::Insert($getLastInsertId);
         $db->query(SQL::GenCall('remove_old_master_classes'));
         $db->link->commit();
      } catch (DBException $e) {
         $db->link->rollback();
         throw new Exception($e->getMessage());
      }
      return $resId;
   }
}

$_masterClass = new MasterClass();