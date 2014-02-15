<?php
  $smarty->assign('photo_id', $_GET['id'])
         ->display('admin.resize_photo.tpl');