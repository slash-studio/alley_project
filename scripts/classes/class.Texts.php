<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Entity.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.TableImages.php';

class Texts extends Entity
{
   const MAIN_TEXT_ID   = 1;
   const COURSE_TEXT_ID = 2;
   const ABOUT1_TEXT_ID = 3;
   const ABOUT2_TEXT_ID = 4;

   const NAME_FLD       = 'name';
   const TEXT_HEAD_FLD  = 'text_head';
   const TEXT_BODY_FLD  = 'text_body';
   const HAVE_PHOTO_FLD = 'have_photo';

   const TABLE = 'texts';

   const ABOUT_SCHEME = 2;

   const LAST_VIEWED_ID = 'last_viewed_texts_id';

   public function __construct()
   {
      parent::__construct();
      $this->fields = Array(
         $this->idField,
         new Field(
            static::NAME_FLD,
            StrType(150),
            false
         ),
         new Field(
            static::HAVE_PHOTO_FLD,
            IntType(),
            false
         ),
         new Field(
            static::TEXT_HEAD_FLD,
            TextType(),
            true,
            'заголовок текста',
            Array(Validate::IS_NOT_EMPTY)
         ),
         new Field(
            static::TEXT_BODY_FLD,
            TextType(),
            true
         )
      );
      $this->orderFields = Array(static::NAME_FLD => new OrderField(static::TABLE, $this->GetFieldByName(static::NAME_FLD)));
   }

   public function ModifySample(&$sample)
   {
      if (empty($sample)) return $sample;
      if ($this->samplingScheme == static::ABOUT_SCHEME) {
         $arr['about1'] = $sample[0];
         $arr['about2'] = $sample[1];
         $sample = $arr;
      }
   }

   public function SetSelectValues()
   {
      global $_textsImages;
      $fields =
         SQL::PrepareFieldsForSelect(
            static::TABLE,
            $this->fields
         );
      $clause = new Clause();
      $clause->AddClause(
        CCond(
            CF(TextsImages::TABLE, $_textsImages->GetFieldByName(TextsImages::TEXT_FLD)),
            CF(static::TABLE, $this->GetFieldByName(static::ID_FLD))
         )
      );
      $clause->AddClause(
         CCond(
            CF(static::TABLE, $this->GetFieldByName(static::HAVE_PHOTO_FLD)),
            CVS(1),
            'AND'
         )
      );
      $fields[] =
         '(' .
         SQL::SimpleQuerySelect(
            $_textsImages->ToTblNm(TextsImages::PHOTO_FLD),
            TextsImages::TABLE,
            $clause
         ) . ') as ' . $this->ToPrfxNm(TextsImages::PHOTO_FLD);
      switch ($this->samplingScheme) {
         case static::ABOUT_SCHEME:
            $this->search->AddClause(
               CCond(
                  CF(static::TABLE, $this->GetFieldByName(static::ID_FLD)),
                  CVP(static::ABOUT1_TEXT_ID)
               )
            );
            $this->search->AddClause(
               CCond(
                  CF(static::TABLE, $this->GetFieldByName(static::ID_FLD)),
                  CVP(static::ABOUT2_TEXT_ID),
                  'OR'
               )
            );
            break;
      }
      $this->selectFields = SQL::GetListFieldsForSelect($fields);
   }
}

$_texts = new Texts();