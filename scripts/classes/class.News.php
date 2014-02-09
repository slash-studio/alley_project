<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.TableImages.php';

class News extends Entity
{
   const MAIN_PAGE_SCHEME   = 2;
   const WITH_PHOTOS_SCHEME = 3;

   const PHOTO_FLD            = 'photo_id';
   const PHOTOS_FLD           = 'photos';
   const TEXT_HEAD_FLD        = 'text_head';
   const TEXT_BODY_FLD        = 'text_body';
   const PUBLICATION_DATE_FLD = 'publication_date';

   const TABLE = 'news';

   const LAST_VIEWED_ID = 'last_viewed_news_id';

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
            Array('IsNotEmpty')
         ),
         new Field(
            static::PHOTO_FLD,
            null,
            true
         )
      );
      $this->orderFields =
         Array(static::PUBLICATION_DATE_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::PUBLICATION_DATE_FLD)));
   }

   public function ModifySample(&$sample)
   {
      if (empty($sample)) return $sample;
      switch ($this->samplingScheme) {
         case static::MAIN_PAGE_SCHEME:
            $textKey = $this->ToPrfxNm(static::TEXT_BODY_FLD);
            $dateKey = $this->ToPrfxNm(static::PUBLICATION_DATE_FLD);
            foreach ($sample as $key => &$set) {
               $date = new DateTime($set[$dateKey]);
               $set[$dateKey] = $date->format('d-m-Y');
               if ($key == 0) {
                  $set[$textKey] = CutString($set[$textKey], 130);
               } else {
                  unset($set[$textKey]);
               }
            }
            $firstNews = array_shift($sample);
            $firstNews['news'] = $sample;
            $sample = $firstNews;
            break;

         case static::WITH_PHOTOS_SCHEME:
            $key = $this->ToPrfxNm(static::PHOTOS_FLD);
            foreach ($sample as &$set) {
               $set[$key] = !empty($set[$key]) ? explode(',', $set[$key]) : Array();
            }
            break;
      }
   }

   public function SetSelectValues()
   {
      $this->AddOrder(static::PUBLICATION_DATE_FLD, OT_DESC);
      if ($this->TryToApplyUsualScheme()) return;
      $fields = Array();
      switch ($this->samplingScheme) {
         case static::MAIN_PAGE_SCHEME:
            $this->AddLimit(5);
            $fields = SQL::PrepareFieldsForSelect(static::TABLE, $this->fields);
            break;

         case static::WITH_PHOTOS_SCHEME:
            global $_newsImages;
            $fields =
               array_merge(
                  SQL::PrepareFieldsForSelect(
                     static::TABLE,
                     Array(
                        $this->GetFieldByName(static::ID_FLD),
                        $this->GetFieldByName(static::TEXT_HEAD_FLD),
                        $this->GetFieldByName(static::TEXT_BODY_FLD),
                        $this->GetFieldByName(static::PHOTO_FLD)
                     )
                  )
               );
            $fields[] = SQL::ImageSelectSQL($this, $_newsImages, NewsImages::NEWS_FLD);
            break;
      }
      $this->selectFields = SQL::GetListFieldsForSelect($fields);
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
            $resMenu .= "<ul><li><a href='javascript:void(0)' class='dropdown_head'>$y</a><ul class='dropdown_block'>";
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
      $this->search = new Search(self::TABLE);
      $date = DateTime::createFromFormat('Y n', "$year $month");
      $this->search->AddClause(
         CCond(
            CF(static::TABLE, $this->GetFieldByName(static::PUBLICATION_DATE_FLD)),
            new LikeView(CVP('%' . $date->format('Y-m') . '%')),
            'AND',
            ''
         )
      );
      return $this;
   }
}

$_news = new News();