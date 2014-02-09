<?php
function SetActiveItem($item = 'main')
{
   global $smarty;
   $smarty->assign('active_item', $item);
}

function SetLastViewedID($name)
{
   global $smarty;
   if (isset($_SESSION[$name])) {
      $smarty->assign('last_viewed_id', $_SESSION[$name]);
      unset($_SESSION[$name]);
   }
}

function SetRequiredFieldError($name, $message = null)
{
   global $smarty;
   $smarty->assign('error_txt', empty($message) ? "$name не может быть пустым!" : $message);
}

function GetPOST()
{
   foreach ($_POST as &$value) {
      if (!is_array($value)) {
         $value = trim($value);
      }
   }
   return $_POST;
}

function CutString($str, $amount)
{
   $new_str = mb_substr($str, 0, $amount);
   if ($str != $new_str) {
      $new_str .= '...';
   }
   return $new_str;
}

function GetMonthByNumber($m)
{
   switch ($m) {
      case 1:
         $result = 'Январь';
         break;
      case 2:
         $result = 'Февраль';
         break;
      case 3:
         $result = 'Март';
         break;
      case 4:
         $result = 'Апрель';
         break;
      case 5:
         $result = 'Май';
         break;
      case 6:
         $result = 'Июнь';
         break;
      case 7:
         $result = 'Июль';
         break;
      case 8:
         $result = 'Август';
         break;
      case 9:
         $result = 'Сентябрь';
         break;
      case 10:
         $result = 'Октябрь';
         break;
      case 11:
         $result = 'Ноябрь';
         break;
      case 12:
         $result = 'Декабрь';
         break;
      default:
         $result = '';
         break;
   }
   return $result;
}

function GetBentMonthByNumber($m)
{
   switch ($m) {
      case 1:
         $result = 'Января';
         break;
      case 2:
         $result = 'Февраля';
         break;
      case 3:
         $result = 'Марта';
         break;
      case 4:
         $result = 'Апреля';
         break;
      case 5:
         $result = 'Мая';
         break;
      case 6:
         $result = 'Июня';
         break;
      case 7:
         $result = 'Июля';
         break;
      case 8:
         $result = 'Августа';
         break;
      case 9:
         $result = 'Сентября';
         break;
      case 10:
         $result = 'Октября';
         break;
      case 11:
         $result = 'Ноября';
         break;
      case 12:
         $result = 'Декабря';
         break;
      default:
         $result = '';
         break;
   }
   return $result;
}