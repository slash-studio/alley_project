<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';

class News extends Entity
{
   const TEXT_HEAD_FLD        = 'text_head';
   const TEXT_BODY_FLD        = 'text_body';
   const PUBLICATION_DATE_FLD = 'publication_date';

   const TABLE = 'news';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         new Field(
            static::ID_FLD,
            null,
            false
         ),
         new Field(
            static::TEXT_HEAD_FLD,
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            static::TEXT_BODY_FLD,
            null,
            true,
            Array('IsNotEmpty')
         ),
         new Field(
            static::PUBLICATION_DATE_FLD,
            null,
            true,
            Array('IsNotEmpty'),
            FieldView::LIKE_VIEW
         )
      );
      $this->orderFields =
         Array(static::PUBLICATION_DATE_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::PUBLICATION_DATE_FLD)));
   }

   public function GetAdminMenu()
   {
      $date = static::PUBLICATION_DATE_FLD;
      $packData = function($aggregate) use($date) {
         return "DATE_FORMAT($aggregate($date), '%Y-%m') as $date";
      };
      $query = SQL::SimpleQuerySelect($packData('MIN'), static::TABLE)
             . ' UNION '
             . SQL::SimpleQuerySelect($packData('MAX'), static::TABLE);
      $resMenu = '';
      try {
         global $db;
         $result = $db->Query($query);
         if (!empty($result[0][static::PUBLICATION_DATE_FLD]) && count($result) == 1) {
            $result[] = $result[0];
         }
         if (count($result) != 2) return $resMenu;
         $date1 = new DateTime($result[0][static::PUBLICATION_DATE_FLD]);
         $date2 = new DateTime($result[1][static::PUBLICATION_DATE_FLD]);
         $printMoth = function($y, $m) {
            return "<li><a href='/admin/articles/$y/$m'>" . GetMonthByNumber($m) . "</a></li>";
         };
         while ($date1 <= $date2) {
            $y = $date2->format('Y');
            $m = $date2->format('n');
            $resMenu .= "<ul class='dropdown_block'><li><a href='javascript:void(0)' class='dropdown_head'>$y</a><ul>";
            do {
               $resMenu .= $printMoth($y, $date2->format('n'));
               $date2->sub(new DateInterval('P1M'));
            } while ($date2->format('n') <= $m - 1 && $date1 <= $date2);
            $resMenu .= '</ul></li></ul>';
         }
      } catch (Exception $e) {}
      return $resMenu;
   }

   public function CreateSearchYM($year, $month)
   {
      unset($this->search);
      $date = DateTime::createFromFormat('Y n', "$year $month");
      $whereParams[] = '%' . $date->format('Y-m') . '%';
      $whereFields[] = PackParam(self::TABLE, $this->GetFieldByName(static::PUBLICATION_DATE_FLD));

      $this->search = new Search(self::TABLE, $whereFields, $whereParams);
      return $this;
   }
}

$_news = new News();
?>