{extends file='admin.tpl'}
{block name='title' append} - Новости{/block}
{block name='links' append}
  <script src="/js/select_plugin.js"></script>
  <link href="/css/upload_photos.css" rel="stylesheet" />
  <script src="/js/images.js"></script>
  <link href="/css/admin_articles.css" rel="stylesheet" />
  <script>
  {literal}
    $(function(){
      $('aside a.dropdown_head').append('<div class="arrow"></div>');
    });
  {/literal}
  </script>
  <link rel="stylesheet" href="/css/jquery-ui.css">
  <script src="/js/jquery-ui.js"></script>
  <script src="/js/jquery-ui-timepicker-addon.js"></script>
  <script>
    $(function() {
      $( ".date_pick" ).datetimepicker($.extend($.datepicker.regional['ru'],{
        dateFormat: "dd-mm-yy",
        stepMinute: 5
      }));
    });
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
        <label for="article_date_{$smarty.foreach.foo.index}">Дата:</label>
        <input class="article_date date_pick" name="date" id="article_date_{$smarty.foreach.foo.index}" value="{$article.news_publication_date}" />
        <label for="article_body_{$smarty.foreach.foo.index}">Текст:</label>
        <textarea class="article_body" name="text_body" id="article_body_{$smarty.foreach.foo.index}" rows="5" cols="70">{$article.news_text_body}</textarea>
        <button class="save" name="mode" value="Update">Сохранить</button><button class="delete" name="mode" value="Delete">Удалить</button>
      </form>
      <div class="upload_photos div_upload{$article.news_id}">
        <form method="POST" action="/admin/upload_photo">
          <input type="hidden" name="data" value='{literal}{{/literal}"uploadType":"articles", "cropType":"userCrop", "maxSize":"1024000", "item_id":"{$article.news_id}", "width":"300", "height":"300", "count":"1", "sizes":"s#100#100,m#200#200,b#300#300"{literal}}{/literal}' />
          <button class="upload">Загрузить главное фото</button>
        </form>
        <ul>
          {if isset($article.news_photo_id)}
            <li><a href="/scripts/uploads/{$article.news_photo_id}_s.jpg"><img src="/scripts/uploads/{$article.news_photo_id}_s.jpg" /></a><button class="x" data="{$article.news_photo_id}">x</button></li>
          {/if}
        </ul>
      </div>
      <div class="upload_photos div_upload{$article.news_id}">
        <form method="POST" action="/admin/upload_photo">
          <input type="hidden" name="data" value='{literal}{{/literal}"uploadType":"articles", "cropType":"userCrop", "maxSize":"1024000", "item_id":"{$article.news_id}", "width":"750", "height":"500", "count":"10", "sizes":"s#150#100,m#450#300,b#750#500"{literal}}{/literal}' />
          <button class="upload">Загрузить фото</button>
        </form>
        <ul>
          {foreach from=$article.news_photos item=photo}
            {if $article.news_photo_id != $photo}
              <li><a href="/scripts/uploads/{$photo}_s.jpg"><img src="/scripts/uploads/{$photo}_s.jpg" /></a><button class="x" data="{$photo}">x</button></li>
            {/if}
          {/foreach}
        </ul>
      </div>
      {/foreach}
    {/if}
    {include file='admin.set_select.tpl'}
    <form action="/admin/articles{if isset($year)}/{$year}/{$month}{/if}" method="post" id="add_article">
      <h2>Добавить новость</h2>
      <label for="article_head_new">Заголовок:</label>
      <input class="article_head" name="text_head" id="article_head_new" value="" />
      <label for="article_date_new">Дата:</label>
      <input class="article_date date_pick" name="date" id="article_date_new" value="" />
      <label for="article_body_new">Текст:</label>
      <textarea class="article_body" name="text_body" id="article_body_new" rows="5" cols="70"></textarea>
      <button class="save" name="mode" value="Insert">Добавить</button>
    </form>
  </div>
</div>
{/block}