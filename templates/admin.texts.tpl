{extends file='admin.tpl'}
{block name='links' append}
    <link href="/css/admin_texts.css" rel="stylesheet" />
	<script src="/js/admin_texts.js"></script>
{/block}
{block name="div.main"}
<div id="top_block">
  <h1>Тексты</h1>
  <label for="choose_text"></label>
  <select id="choose_text" name="choose_text">
	<option value="text1">Текст 1</option>
	<option value="text2">Текст 2</option>
  </select>
  <form action="/admin/main_news" method="post" class="text_edit" id="text1" style="display: block;">
	<h2>Текст 1</h2>
	<label for="text_head_1">Заголовок:</label>
	<input id="text_head_1" name="text_head" class="text_head" value="" />
	<label for="text_body_1">Текст:</label>
	<textarea id="text_body_1" name="text_body" rows="10" cols="100"></textarea>
	<button class="save_text" name="save" value="Update">Сохранить</button>
  </form>
  <form action="/admin/main_news" method="post" class="text_edit" id="text2">
	<h2>Текст 2</h2>
	<label for="text_head_2">Заголовок:</label>
	<input id="text_head_2" name="text_head" class="text_head" value="" />
	<label for="text_body_2">Текст:</label>
	<textarea id="text_body_2" name="text_body" rows="10" cols="100"></textarea>
	<button class="save_text" name="save" value="Update">Сохранить</button>
  </form>
</div>
{/block}
