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
   return array_map('trim', $_POST);
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
?>