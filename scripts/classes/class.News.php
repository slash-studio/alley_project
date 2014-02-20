<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.TableImages.php';

class News extends Entity
{
   const INFO_SCHEME        = 2;
   const OTHER_SCHEME       = 3;
   const MAIN_PAGE_SCHEME   = 4;
   const WITH_PHOTOS_SCHEME = 5;

   const PHOTO_FLD            = 'photo_id';
   const PHOTOS_FLD           = 'photos';
   const TEXT_HEAD_FLD        = 'text_head';
   const TEXT_BODY_FLD        = 'text_body';
   const PUBLICATION_DATE_FLD = 'publication_date';

   const TABLE = 'news';

   const LAST_VIEWED_ID = 'last_viewed_news_id';

   const NEWS_ON_PAGE = 10;

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         $this->idField,
         new Field(
            static::TEXT_HEAD_FLD,
            StrType(150),
            true,
            'заголовок новости',
            Array(Validate::IS_NOT_EMPTY)
         ),
         new Field(
            static::TEXT_BODY_FLD,
            TextType(),
            true,
            'описание новости',
            Array(Validate::IS_NOT_EMPTY)
         ),
         new Field(
            static::PUBLICATION_DATE_FLD,
            TimestampType(),
            true,
            'дата новости',
            Array(Validate::IS_NOT_EMPTY)
         ),
         new Field(
            static::PHOTO_FLD,
            IntType(),
            true
         )
      );
      $this->orderFields =
         Array(static::PUBLICATION_DATE_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::PUBLICATION_DATE_FLD)));
   }

   public function CutNewsBody($news, $delimiter = ' ')
   {
      $amount = 14;
      $amount = $delimiter == ' ' ? $amount : 1;
      $arr = explode($delimiter, $news);
      $result = implode($delimiter, array_slice($arr, 0, $amount));
      $result .= $delimiter == ' ' && count($arr) >= $amount ? '...' : '';
      return $result;
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
            $dateKey = $this->ToPrfxNm(static::PUBLICATION_DATE_FLD);
            foreach ($sample as &$set) {
               $date_var = new DateTime($set[$dateKey]);
               $set[$dateKey] = $date_var->format('d-m-Y H:i');
               $set[$key] = !empty($set[$key]) ? explode(',', $set[$key]) : Array();
            }
            break;

         case static::INFO_SCHEME:
            $dateKey = $this->ToPrfxNm(static::PUBLICATION_DATE_FLD);
            foreach ($sample as $key => &$set) {
               $date_var = new DateTime($set[$dateKey]);
               $set[$dateKey] = $date_var->format('d-m-Y H:i');
            }
            break;

         case static::OTHER_SCHEME:
            $dateKey = $this->ToPrfxNm(static::PUBLICATION_DATE_FLD);
            $textKey = $this->ToPrfxNm(static::TEXT_BODY_FLD);
            foreach ($sample as $key => &$set) {
               $date = new DateTime($set[$dateKey]);
               $set[$textKey] = $this->CutNewsBody($set[$textKey]);
               $set[$dateKey] = $date->format('d-m-Y');
            }
            $resArr = array_chunk($sample, 3);
            $arr['left_news']  = isset($resArr[0]) ? $resArr[0] : Array();
            $arr['right_news'] = isset($resArr[1]) ? $resArr[1] : Array();
            $sample = $arr;
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

         case static::INFO_SCHEME:
         case static::WITH_PHOTOS_SCHEME:
            global $_newsImages;
            $fields =
               Array(
                  $this->GetFieldByName(static::ID_FLD),
                  $this->GetFieldByName(static::TEXT_HEAD_FLD),
                  $this->GetFieldByName(static::TEXT_BODY_FLD),
                  $this->GetFieldByName(static::PHOTO_FLD),
                  $this->GetFieldByName(static::PUBLICATION_DATE_FLD)
               );
            if ($this->samplingScheme == static::INFO_SCHEME) {
               $fields[] = $this->GetFieldByName(static::PUBLICATION_DATE_FLD);
            }
            $fields =
               SQL::PrepareFieldsForSelect(
                  static::TABLE,
                  $fields
               );
            $fields[] = SQL::ImageSelectSQL($this, $_newsImages, NewsImages::NEWS_FLD);
            break;

         case static::OTHER_SCHEME:
            $this->AddLimit(6, 0);
            $fields = SQL::PrepareFieldsForSelect(static::TABLE, $this->fields);
            break;
      }
      $this->selectFields = SQL::GetListFieldsForSelect($fields);
   }

   public function GetNews($page)
   {
      global $db;
      $sample = Array();
      try {
         $dateField = $this->ToTblNm(static::PUBLICATION_DATE_FLD);
         $queryPart =
            SQL::SimpleQuerySelect(
               SQL::GetListFieldsForSelect(
                  SQL::PrepareFieldsForSelect(
                     static::TABLE,
                     $this->fields
                  )
               ),
               static::TABLE
         );
         $query = '('
                . $queryPart
                . " ORDER BY $dateField DESC limit 0, 1) UNION ("
                . $queryPart
                . " ORDER BY $dateField DESC limit ?, ?)";
         $sample = $db->Query($query, Array($page * static::NEWS_ON_PAGE + 1, static::NEWS_ON_PAGE));
         $textKey = $this->ToPrfxNm(static::TEXT_BODY_FLD);
         $dateKey = $this->ToPrfxNm(static::PUBLICATION_DATE_FLD);
         foreach ($sample as $key => &$set) {
            $date = new DateTime($set[$dateKey]);
            $set[$dateKey] = $date->format('d-m-Y');
            $set[$textKey] = $key == 0 ? $this->CutNewsBody($set[$textKey], '.') : $this->CutNewsBody($set[$textKey]);
         }
         $firstNews['top_news'] = array_shift($sample);
         $resArr = array_chunk($sample, intval(static::NEWS_ON_PAGE / 2));
         $firstNews['left_news']  = isset($resArr[0]) ? $resArr[0] : Array();
         $firstNews['right_news'] = isset($resArr[1]) ? $resArr[1] : Array();
         $sample = $firstNews;
      } catch (DBException $e) {}
      return $sample;
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