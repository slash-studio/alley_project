{extends file='admin.tpl'}
{block name='links' append}
  <script src="/js/select_plugin.js"></script>
{/block}
{block name="div.main"}
<div id="top_block">
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  {$article_menu}
  {if $article_level==2}
    {if $articles|@count!=0}
      <h1>Новости</h1>
      <label for="choose_item">Выберите новость</label>
      <select id="choose_item" name="choose_item">
      {foreach from=$articles item=article}
        <option value="item{$article.news_id}">{$article.news_text_head}</option>
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
{/block}