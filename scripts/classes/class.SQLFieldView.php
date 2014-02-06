<?php
class SQLFieldView
{
   protected
      $arg;

   public function __construct($arg)
   {
      $this->arg = $arg;
   }

   public function GetSQL()
   {
      return '';
   }
}

class LikeView extends SQLFieldView
{
   public function GetSQL()
   {
      return '';
   }
}
?>