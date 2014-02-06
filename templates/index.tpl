{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/index.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div id="top_block">
    <img src="/images/slide1.jpg" />
    <section class="text">
      <h1>{$main_text.texts_text_head|default:''}</h1>
      <p>{$main_text.texts_text_body|default:''}</p>
    </section>
    <div class="adress">Наш адрес: <b>ул. Санаторная 39, д. 4</b></div>
    <button>Показать на карте</button>
  </div>
  <div id="courses">
    <ul>
      {foreach from=$courses item=course}
        <li><a href="/course/{$course.courses_id}"><!-- <img src="/images/kurs1.png" /> --><span>{$course.courses_name}</span></a></li>
      {/foreach}
<!--       <li><a href="#"><img src="/images/kurs1.png" /><span>Гончарное дело</span></a></li>
      <li><a href="#"><img src="/images/kurs2.png" /><span>Валяние из шерсти</span></a></li>
      <li><a href="#"><img src="/images/kurs3.png" /><span>Бисероплетение</span></a></li>
      <li><a href="#"><img src="/images/kurs4.png" /><span>Вышивание</span></a></li>
      <li><a href="#"><img src="/images/kurs2.png" /><span>Макраме</span></a></li> -->
    </ul>
  </div>
  <div id="bottom_block">
    <section id="news">
      <h1>Новости</h1>
      {if $news|@count != 0}
        <article class="main">
          <a href="/news/{$news.news_id}"><!-- <img src="/images/news1.jpg" /> --></a>
          <h1><a href="/news/{$news.news_id}">{$news.news_text_head}</a></h1>
          <time datetime="{$news.news_publication_date}">{$news.news_publication_date}</time>
          <p><a href="/news/{$news.news_id}">{$news.news_text_body}</a></p>
        </article>
        {foreach from=$news.news item=article}
        <article class="other">
          <time datetime="{$article.news_publication_date}">{$article.news_publication_date}</time>
          <h1><a href="/news/{$article.news_id}">{$article.news_text_head}</a></h1>
        </article>
        {/foreach}
      {/if}
    </section>
    <section id="master">
      {if $class|@count != 0}
      <h1>Приглашаем на мастер-класс!</h1>
      <article>
        <a href="/classes/{$class.master_class_id}"><!-- <img src="/images/master1.jpg" /> --></a>
        <h1><a href="/classes/{$class.master_class_id}">{$class.master_class_name}</a></h1>
        <time datetime="">{$class.master_class_date_of}</time>
        <p><a href="/classes/{$class.master_class_id}">{$class.master_class_description}</a></p>
      </article>
      {/if}
    </section>
  </div>
{/block}
