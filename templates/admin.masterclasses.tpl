{extends file='admin.tpl'}
{block name='links' append}
  <script src="/js/select_plugin.js"></script>
{/block}
{block name="div.main"}
<div id="top_block">
  <h1>Мастеркласс</h1>
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  <form action="/admin/masterclasses" method="post" id="add_masterclass">
    <label for="masterclass_head">Название:</label>
    <input class="masterclass_head" name="name" id="masterclass_head" value="" />
	<label for="masterclass_date">Дата:</label>
    <input class="masterclass_date" name="date" id="masterclass_date" value="" />
	<label for="masterclass_body">Текст:</label>
    <textarea class="masterclass_body" name="info" id="masterclass_body" rows="5" cols="70"></textarea>
    <button class="save" name="mode" value="Insert">Добавить</button>
  </form>
</div>
{/block}