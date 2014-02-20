{extends file='page.tpl'}
{block name='title' append} - О нас{/block}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/about.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div id="left_block" class="block">
    {if $about.about1.texts_have_photo && isset($about.about1.texts_photo_id)}<img src="/scripts/uploads/{$about.about1.texts_photo_id}_b.jpg" />{/if}
    <div class="info">Наши телефоны: <b>+7 (914) 701-63-20</b>, <b>+7 (914) 701-63-20</b></div>
    <div class="info">Наш адрес: <b>ул. Санаторная 39, д. 4</b></div>
    <button>Показать на карте</button>
  </div>
  <div id="right_block" class="block">
    <section class="text">
      <h1 class="nice">{$about.about1.texts_text_head}</h1>
      <p>{$about.about1.texts_text_body}</p>
    </section>
    <section class="text">
      <h1 class="nice">{$about.about2.texts_text_head}</h1>
      <p>{$about.about2.texts_text_body}</p>
    </section>
  </div>
{/block}
