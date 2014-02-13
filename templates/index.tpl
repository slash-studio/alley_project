{extends file='page.tpl'}
{block name='title' append} - Главная{/block}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/index.css" rel="stylesheet" />
  <link href="/css/courses.css" rel="stylesheet" />
  <link href="/colorbox/colorbox.css" rel="stylesheet" />
  <script src="/colorbox/jquery.colorbox.js"></script>
  <script>
	{literal}
	$(function(){
		$('a.masterclass_href').colorbox({inline:true, width:"600px", height:"500px"});
	});	
	{/literal}
  </script>
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div id="top_block" class="text_block">
    {if $main_text.texts_have_photo && isset($main_text.texts_photo_id)}<img src="/scripts/uploads/{$main_text.texts_photo_id}.jpg" />{/if}
    <section class="text">
      <h1 class="nice">{$main_text.texts_text_head|default:''}</h1>
      {$main_text.texts_text_body|default:''}
    </section>
    <div class="adress">Наш адрес: <b>ул. Санаторная 39, д. 4</b></div>
    <button>Показать на карте</button>
  </div>
  <div class="courses">
    <ul>
      {foreach from=$courses item=course}
        <li><a href="/course/{$course.courses_id}"><img src="/scripts/uploads/{$course.courses_photo_id}_s.jpg" /><span>{$course.courses_name}</span></a></li>
      {/foreach}
    </ul>
  </div>
  <div id="bottom_block">
    <section id="news">
      <h1 class="nice">Новости</h1>
      {if $news|@count != 0}
        <article class="main">
          <a href="/article/{$news.news_id}"><img src="/scripts/uploads/{$news.news_photo_id}_s.jpg" /></a>
          <h1><a href="/article/{$news.news_id}">{$news.news_text_head}</a></h1>
          <time datetime="{$news.news_publication_date}">{$news.news_publication_date}</time>
          <p><a href="/article/{$news.news_id}">{$news.news_text_body}</a></p>
        </article>
        {foreach from=$news.news item=article}
        <article class="other">
          <time datetime="{$article.news_publication_date}">{$article.news_publication_date}</time>
          <h1><a href="/article/{$article.news_id}">{$article.news_text_head}</a></h1>
        </article>
        {/foreach}
      {/if}
    </section>
    <section id="master">
      {if $class|@count != 0}
      <h1 class="nice">Приглашаем на мастер-класс!</h1>
      <article>
        <a href="#masterclass_open" class="masterclass_href"><img src="/scripts/uploads/{$class.master_class_photo_id}_s.jpg" /></a>
        <h1><a href="#masterclass_open" class="masterclass_href">{$class.master_class_name}</a></h1>
        <time datetime="">{$class.master_class_date_of}</time>
        <p><a href="#masterclass_open" class="masterclass_href">{$class.cut_body}...</a></p>
      </article>
      <div style="display: none">
        <div id="masterclass_open">
          <h1 class="nice">{$class.master_class_name}</h1>
          <time datetime="">{$class.master_class_date_of}</time>
          <img src="/scripts/uploads/{$class.master_class_photo_id}_b.jpg" />
          <p>{$class.master_class_description}</p>
          
        </div>
      </div>
      {/if}
    </section>
  </div>
{/block}
