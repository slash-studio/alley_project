{extends file='admin.tpl'}
{block name='links' append}
  <script src="/js/select_plugin.js"></script>
{/block}
{block name="div.main"}
<div id="top_block">
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  {if $articles|@count!=0}
	  <h1>Новости</h1>
	  <label for="choose_item">Выберите новость</label>
	  <select id="choose_item" name="choose_item">
	  {foreach from=$articles item=article}
		<option value="article{$article.articles_id}">{$article.articles_name}</option>
	  {/foreach}
	  </select>
  {/if}
  
  {foreach from=$articles item=article name=foo}
  <form action="/admin/articles" method="post" class="item_edit" id="article{$article.articles_id}">
	<h2>{$article.articles_name}</h2>
    <input type="hidden" class="article_id" name="id" value="{$article.teachers_id}" />
    <label for="article_head_{$smarty.foreach.foo.index}">Заголовок:</label>
    <input class="article_head" name="name" id="article_head_{$smarty.foreach.foo.index}" value="{$article.articles_name}" />
    <label for="article_body_{$smarty.foreach.foo.index}">Текст:</label>
    <textarea class="article_body" name="info" id="article_body_{$smarty.foreach.foo.index}" rows="5" cols="70">{$article.articles_info}</textarea>
    <button class="save" name="mode" value="Update">Сохранить</button><button class="delete" name="mode" value="Delete">Удалить</button>
  </form>
  {/foreach}
  <form action="/admin/articles" method="post" id="add_article">
    <h2>Добавить новость</h2>
    <label for="article_head_new">Заголовок:</label>
    <input class="article_head" name="name" id="article_head_new" value="" />
    <label for="article_body_new">Текст:</label>
    <textarea class="article_body" name="info" id="article_body_new" rows="5" cols="70"></textarea>
    <button class="save" name="mode" value="Insert">Добавить</button>
  </form>
</div>
{/block}