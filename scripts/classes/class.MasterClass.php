<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Teachers.php';

class MasterClass extends Entity
{
   const NAME_FLD        = 'name';
   const DATE_FLD        = 'date_of';
   const DESCRIPTION_FLD = 'description';

   const TABLE = 'master_class';

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
            true
         ),
         new Field(
            static::DATE_FLD,
            null,
            true,
            Array('IsNotEmpty')
         )
      );
      $this->orderFields =
         Array(static::DATE_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::DATE_FLD)));
   }

   public function SetSelectValues()
   {
      $this->AddOrder(static::DATE_FLD, OT_ASC);
      if ($this->TryToApplyUsualScheme()) return;
      // $this->CheckSearch();
      // $fields = Array();
      // switch ($this->samplingScheme) {
      //    case static::COURSE_SCHEME:
      //       $fields = SQL::PrepareFieldsForSelect(
      //          static::TABLE,
      //          Array(
      //             $this->GetFieldByName(static::ID_FLD),
      //             $this->GetFieldByName(static::NAME_FLD)
      //          )
      //       );
      //       break;
      // }
      // $this->selectFields = SQL::GetListFieldsForSelect($fields);
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
?>