<?php
function SetActiveItem($item = 'main')
{
   global $smarty;
   $smarty->assign('active_item', $item);
}

function GetPOST()
{
   return array_map('trim', $_POST);
}
?>