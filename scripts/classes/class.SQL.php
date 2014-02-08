<?php
class SQL
{
   public static function GenCall($name)
   {
      return "CALL $name()";
   }

   public static function ToPrfxNm($table, $name)
   {
      return $table . '_' . $name;
   }

   public static function ToTblNm($table, $name)
   {
      return $table . '.' . $name;
   }

   public static function ToWhrCls($names)
   {
      $result = '';
      foreach ($names as $name) {
         $result .= "$name = ?, ";
      }

      return substr($result, 0, strrpos($result, ','));
   }

   public static function MakeJoin($mainTable, $tables)
   {
      $result = '';
      foreach ($tables as $table => $description) {
         $result .= 'INNER JOIN '
            . "$table "
            . (!empty($description[0]) ? $description[0] : '')
            . ' ON ';
         for ($i = 1; $i < count($description); $i++) {
            $result .= self::ToTblNm($mainTable, $description[$i][0])
               . ' = '
               . self::ToTblNm(
                  (!empty($description[0]) ? $description[0] : $table),
                  $description[$i][1]
               )
               . ' AND ';
         }
         $result = substr($result, 0, strrpos($result, 'AND'));
      }

      return $result;
   }

   public static function GetListFieldsForSelect($fields)
   {
      $query = '';
      foreach ($fields as $f) {
         $query .= $f . ', ';
      }

      return substr($query, 0, strrpos($query, ', '));
   }

   public static function GetInsertQuery($table, $fields)
   {
      return
         'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') '
         . 'VALUES ('
         . (count($fields) - 1 >= 0 ? str_repeat('?, ', count($fields) - 1) . '?' : '')
         . ')';
   }

   public static function GetUpdateQuery($table, $fields)
   {
      return
         'UPDATE ' . $table . ' SET ' . implode(' = ?, ', $fields) . ' = ?'
         . ' WHERE id = ?';
   }

   public static function PrepareFieldsForSelect($table, $fields)
   {
      $result = Array();
      foreach ($fields as $f) {
         $field = self::ToTblNm($table, $f->name);
         $result[] = "$field  as " . self::ToPrfxNm($table, $f->name);
      }

      return $result;
   }

   public static function ImageSelectSQL($th, $entity, $field)
   {
      return
           'IFNULL(('
         . SQL::SimpleQuerySelect(
               'GROUP_CONCAT(' . $entity->ToTblNm($entity::PHOTO_FLD) . ')',
               $entity::TABLE,
               $entity->ToTblNm($field)
             . '='
             . $th->ToTblNm($th::ID_FLD)
             . ' GROUP BY '
             . $th->ToTblNm($th::ID_FLD)
           )
         . '), \'\') as '
         . $th->ToPrfxNm($th::PHOTO_FLD);
   }

   public static function SimpleQuerySelect($fields, $table, $where = null)
   {
      $result = 'SELECT ' . $fields . ' FROM ' . $table;
      if (!empty($where)) {
         $result .= ' WHERE ' . $where;
      }

      return $result;
   }
}
?>