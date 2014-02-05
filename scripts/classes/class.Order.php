<?php
class OrderField
{
   private
      $field;

   public
      $table;

   public function __construct($table, $field)
   {
      $this->table = $table;
      $this->field = $field;
   }

   public function GetFieldName()
   {
      return $this->field->name;
   }
}

class SQLOrder
{
   private
      $fields = Array();

   public function AddField($fInfo, $orderType)
   {
      foreach ($this->fields as &$field) {
         if ($field['info']->GetFieldName() == $fInfo->GetFieldName()) {
            $field['type'] = $orderType;
            return;
         }
      }
      $this->fields[] = Array(
         'info' => $fInfo,
         'type' => $orderType
      );
   }

   public function GetOrder()
   {
      $result = '';
      $amount = count($this->fields);
      foreach ($this->fields as $key => $field) {
         $result .= (!empty($field['info']) ? SQL::ToTblNm($field['info']->table, $field['info']->GetFieldName()) : '')
                  . ' '
                  . $field['type']
                  . ($key < $amount - 1 ? ', ' : '');
      }
      return $result;
   }
}

?>