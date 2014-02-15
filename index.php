<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/container.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Image.php';

switch ($request[0]) {
   case '': case null: case false:
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/main.php';
      break;

   case 'articles':
      SetActiveItem('articles');
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/articles.php';
      break;

   case 'article':
      SetActiveItem('articles');
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/article.php';
      break;

   case 'courses':
      SetActiveItem('courses');
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/courses.php';
      break;

   case 'course':
      SetActiveItem('courses');
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/course.php';
      break;

   case 'timetable':
      SetActiveItem('timetable');
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/timetable.php';
      break;

   case 'about':
      SetActiveItem('about');
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/about.php';
      break;

   case 'admin':
      require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Admin.php';
      $isLoginPage = empty($request[1]) || $request[1] == 'login';
      if ($_admin->IsAdmin()) {
         if ($isLoginPage) {
            header('Location: /admin/newt_textbox_set_height(textbox, height)');
         }
      } elseif (!$isLoginPage) {
         header('Location: /admin/');
      }
      $request[1] = !empty($request[1]) ? $request[1] : null;
      switch ($request[1]) {
         case '': case 'login': case null: case false:
            require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/admin/admin.login.php';
            break;

         case 'courses':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/admin/admin.courses.php';
            break;

         case 'change_pass':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/admin/admin.change_pass.php';
            break;

         case 'masterclasses':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/admin/admin.masterclasses.php';
            break;

         case 'articles':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/admin/admin.articles.php';
            break;

         case 'table':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/admin/admin.table.php';
            break;

         case 'teachers':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/admin/admin.teachers.php';
            break;

         case 'texts':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/admin/admin.texts.php';
            break;

         case 'resize_photo':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/admin/admin.resize_photo.php';
            break;

         case 'logout':
            unset($_SESSION['admin_login']);
            unset($_SESSION['admin_pass']);
            header('Location: /admin');
            break;

         default:
            header('Location: /admin/texts');
            break;
      }
      break;

   default:
      # display error page
      break;
}