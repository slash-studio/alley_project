{extends file='page.tpl'}
{block name='title' append} - Новости{/block}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/articles.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  {if $news.top_news|@count > 0}
  <article class="news_not_open">
    <div class="left_block">
      <img src="/scripts/uploads/{$news.top_news.news_photo_id}_m.jpg" />
    </div>
    <div class="right_block">
      <h1 class="nice">{$news.top_news.news_text_head|default:''}</h1>
      <time datetime="{$news.news_publication_date|default:''}">{$news.top_news.news_publication_date|default:''}</time>
      <section class="text">{$news.top_news.news_text_body|default:''}</section>
      <a href="/article/{$news.top_news.news_id}">Читать далее</a>
    </div>
  </article>
  {/if}

  <section id="other_news">
    {if $news.left_news|@count > 0}
    <h1 class="nice">Новости</h1>
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
    {elseif $news.top_news|@count == 0}
       <h1 class="nice">Новости еще не добавлены</h1>
    {/if}
    <div id="nav_num">
    {foreach from=$pagesNum item=t}
      {if $t == '...'} ... {else}
        <button class="button {if $curPage == $t}active{/if}" onClick="javascript:location.assign('/articles/?page={$t}')">{$t}</button>
      {/if}
    {/foreach}
     </div>
  </section>
{/block}
