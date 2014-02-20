<?php
function SetActiveItem($item = 'main')
{
   global $smarty;
   $smarty->assign('active_item', $item);
}

function DateToMySqlDate($date_str)
{
   $date_var = new DateTime($date_str);
   return !empty($date_str) ? $date_var->format('Y-m-d H:i:s') : null;
}

function SetLastViewedID($name)
{
   global $smarty;
   if (isset($_SESSION[$name])) {
      $smarty->assign('last_viewed_id', $_SESSION[$name]);
      unset($_SESSION[$name]);
   }
}

function GeneratePages($pages_count, $current_page)
{
   $result = Array();
   if ($pages_count <= 1) {
      return $result;
   }
   if ($pages_count > 7) {
      if ($current_page <= 4) {
         $result = array_merge(range(1, $current_page + 2), array('...', $pages_count));
      } elseif ($current_page > 4 and $pages_count - $current_page > 4) {
         $result = array_merge(array(1, '...'), range($current_page - 2, $current_page + 2), array('...', $pages_count));
      } elseif ($pages_count - $current_page <= 4) {
         $result = array_merge(array(1, '...'), range($current_page - 2, $pages_count));
      }
   } else {
      $result = range(1, $pages_count);
   }
   return $result;
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