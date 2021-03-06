<?php
//numeric and string constants
define('COOKIE_LIFETIME', 86400000); //86400000 seconds in a 1000 days
define('COOKIE_SITE', 'alley.local');
define('LOGIN_LEN', 6);
define('PASS_LEN', 6);
define('ADMIN_ID', 1);

//errors messages
define('ERROR_QUERY', 'В данный момент невозможно подключение к базе данных.');
define('ERROR_LOGIN_ALREADY_REGISTERED', 'Этот логин уже зарегистрирован, используйте другой.');
define('ERROR_LOGIN', 'Неверное имя пользователя или пароль.');
define('ERROR_PASS', 'Неверный пароль.');
define('ERROR_OLD_NEW_PASS', 'Введенные пароли не совпадают.');
define('ERROR_FORM_FILL', 'Некорректно заполнена форма.');
define('ERROR_PASS_LEN', 'Пароль должен быть длиннее ' . (PASS_LEN - 1) . '-ти символов.');
define('ERROR_LOGIN_LEN', 'Логин должен быть длиннее ' . (LOGIN_LEN - 1) . '-ти символов.');
define('ERROR_AGE', 'Возраст должен быть положительным числом.');

//database consts
define('OT_ASC', 'ASC');
define('OT_DESC', 'DESC');
define('OT_RAND', 'RAND()');
define('MYSQL_NOW', 'NOW()');

define('SMARTY_APP_NAME', 'alley');

// define('REGISTER_TEXT_ID', 2);