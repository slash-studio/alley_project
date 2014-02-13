<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';

class Admin extends Entity
{
   const COURSE_SCHEME = 2;

   const PASS_FLD  = 'pass_md5';
   const LOGIN_FLD = 'login';

   const TABLE = 'admin';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         $this->idField,
         new Field(
            static::LOGIN_FLD,
            StrType(50),
            true,
            'Логин администратора',
            Array(Validate::IS_NOT_EMPTY)
         ),
         new Field(
            static::PASS_FLD,
            StrType(50),
            true,
            'информация о преподавателе',
            Array(Validate::IS_NOT_EMPTY)
         )
      );
   }

   public function IsAdmin($login = null, $pass = null)
   {
      if (!empty($login) && !empty($pass)) {
         $admin_login = $login;
         $admin_pass  = $pass;
      } elseif (!empty($_SESSION['admin_login']) && !empty($_SESSION['admin_pass'])) {
         $admin_login = $_SESSION['admin_login'];
         $admin_pass  = $_SESSION['admin_pass'];
      } else return false;
      $this->CreateSearch();
      $this->search->AddClause(
         CCond(
            CF(static::TABLE, $this->GetFieldByName(static::LOGIN_FLD)),
            CVP($admin_login)
         )
      );
      $this->search->AddClause(
         CCond(
            CF(static::TABLE, $this->GetFieldByName(static::PASS_FLD)),
            new MD5View(CVP($admin_pass)),
            'AND'
         )
      );
      $adminInfo = $this->GetPart();
      $result = !empty($adminInfo);
      $this->SetSessionParams($admin_login, $admin_pass);
      return $result;
   }

   public function Update()
   {
      parent::Update();
      $this->SetSessionParams(
         $this->GetFieldByName(static::LOGIN_FLD)->GetValue(),
         $this->GetFieldByName(static::PASS_FLD)->GetValue()
      );
   }

   private function SetSessionParams($login, $pass)
   {
      $_SESSION['admin_login'] = $login;
      $_SESSION['admin_pass']  = $pass;
   }

}

$_admin = new Admin();