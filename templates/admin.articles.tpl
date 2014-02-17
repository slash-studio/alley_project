{extends file='admin.tpl'}
{block name='title' append} - Новости{/block}
{block name='links' append}
  <script src="/js/select_plugin.js"></script>
  <script src="/js/ajaxupload.3.5.js"></script>
  <script src="/js/upload_photo.js"></script>
  <link href="/css/upload_photos.css" rel="stylesheet" />
  <link href="/css/admin_articles.css" rel="stylesheet" />
  <script>
  {literal}
    $(function(){
      $('aside a.dropdown_head').append('<div class="arrow"></div>');
    });
  {/literal}
  </script>
{/block}
{block name="div.main"}
<div id="top_block">
  <h1>Новости</h1>
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  <aside class="menu">{$article_menu}</aside>
  <div class="body">
    {if $article_level==2}
      {if $articles|@count!=0}
        <label for="choose_item">Выберите новость</label>
        <select id="choose_item" name="choose_item">
        {foreach from=$articles item=article}
          <option value="{$article.news_id}">{$article.news_text_head}</option>
        {/foreach}
        </select>
      {/if}
      {foreach from=$articles item=article name=foo}
      <form action="/admin/articles/{$year}/{$month}" method="post" class="item_edit" id="item{$article.news_id}">
        <input type="hidden" class="article_id" name="id" value="{$article.news_id}" />
        <label for="article_head_{$smarty.foreach.foo.index}">Заголовок:</label>
        <input class="article_head" name="text_head" id="article_head_{$smarty.foreach.foo.index}" value="{$article.news_text_head}" />
        <label for="article_body_{$smarty.foreach.foo.index}">Текст:</label>
        <textarea class="article_body" name="text_body" id="article_body_{$smarty.foreach.foo.index}" rows="5" cols="70">{$article.news_text_body}</textarea>
        <button class="save" name="mode" value="Update">Сохранить</button><button class="delete" name="mode" value="Delete">Удалить</button>
        <div class="upload_photos">
          <button class="upload" data='{literal}{{/literal}"buttonId": "{$article.news_id}", "makeMain":"true", "upload_type":"news_photo", "maxSize":"1024000", "item_id":"{$article.news_id}", "count":"1", "sizes":"s,b"{literal}}{/literal}'>Загрузить фото</button>
          <ul>
            {foreach from=$article.news_photos item=photo}
              <li><a href="/scripts/uploads/{$photo}_s.jpg"><img src="/scripts/uploads/{$photo}_s.jpg" /></a><button class="x" data="{$photo}">x</button><div><input type="radio" data-table="news" data-id="{$article.news_id}" name="make_main" value="{$photo}" {if $article.news_photo_id==$photo}checked="checked"{/if} /><label for="make_main">Сделать главной</label></div></li>
            {/foreach}
          </ul>
        </div>
      </form>
      {/foreach}
    {/if}
    {include file='admin.set_select.tpl'}
    <form action="/admin/articles{if isset($year)}/{$year}/{$month}{/if}" method="post" id="add_article">
      <h2>Добавить новость</h2>
      <label for="article_head_new">Заголовок:</label>
      <input class="article_head" name="text_head" id="article_head_new" value="" />
      <label for="article_body_new">Текст:</label>
      <textarea class="article_body" name="text_body" id="article_body_new" rows="5" cols="70"></textarea>
      <button class="save" name="mode" value="Insert">Добавить</button>
    </form>
  </div>
</div>
{/block}