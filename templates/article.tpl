{extends file='page.tpl'}
{block name='title' append} - Новости{/block}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/articles.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <article class="news_open">
    <div class="left_block">
      {if isset($article.news_photo_id)}<img src="/scripts/uploads/{$article.news_photo_id}_b.jpg" />{/if}
    </div>
    <div class="right_block">
      <h1 class="nice">{$article.news_text_head}</h1>
      <time datetime="{$article.news_publication_date}">{$article.news_publication_date}</time>
      <section class="text">{$article.news_text_body}</section>
    </div>
    <div class="gallery">
    {foreach from=$article.news_photos item=photo}
      {if $article.news_photo_id!=$photo}
        <a href="#"><img src="/scripts/uploads/{$photo}_s.jpg" /></a>
      {/if}
    {/foreach}
    </div>
  </article>
  {if isset($news.left_news)}
    <section id="other_news">
      <h1 class="nice">Читайте также:</h1>
      <section class="news" id="news_left">
      {foreach from=$news.left_news item=article}
        <article class="main">
          {if isset($article.news_photo_id)}<a href="/article/{$article.news_id}"><img src="/scripts/uploads/{$article.news_photo_id}_s.jpg" /></a>{/if}
          <h1><a href="/article/{$article.news_id}">{$article.news_text_head}</a></h1>
          <time datetime="{$article.news_publication_date}">{$article.news_publication_date}</time>
          <p><a href="/article/{$article.news_id}">{$article.news_text_body}</a></p>
        </article>
      {/foreach}
      </section>
      <section class="news" id="news_right">
      {foreach from=$news.right_news item=article}
        <article class="main">
          {if isset($article.news_photo_id)}<a href="/article/{$article.news_id}"><img src="/scripts/uploads/{$article.news_photo_id}_s.jpg" /></a>{/if}
          <h1><a href="/article/{$article.news_id}">{$article.news_text_head}</a></h1>
          <time datetime="{$article.news_publication_date}">{$article.news_publication_date}</time>
          <p><a href="/article/{$article.news_id}">{$article.news_text_body}</a></p>
        </article>
      {/foreach}
      </section>
    </section>
  {/if}
{/block}
