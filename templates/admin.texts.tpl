{extends file='admin.tpl'}
{block name='links' append}
  <script src="/js/select_plugin.js"></script>
  <script src="/js/ajaxupload.3.5.js"></script>
  <script src="/js/upload_photo.js"></script>
{/block}
{block name="div.main"}
<div id="top_block">
  <h1>Тексты</h1>
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  <label for="choose_item">Выберите текст</label>
  <select id="choose_item" name="choose_item">
  {foreach from=$texts item=text}
    <option value="item{$text.texts_id}">{$text.texts_name}</option>
  {/foreach}
  </select>
  {foreach from=$texts item=text name=foo}
  <form action="/admin/texts" method="post" class="item_edit" id="item{$text.texts_id}">
    <h2>{$text.texts_name}</h2>
    <input type="hidden" class="teacher_id" name="id" value="{$text.texts_id}" />
    <label for="text_head_{$smarty.foreach.foo.index}">Заголовок:</label>
    <input id="text_head_{$smarty.foreach.foo.index}" name="text_head" class="text_head" value="{$text.texts_text_head}" />
    <label for="text_body_{$smarty.foreach.foo.index}">Текст:</label>
    <textarea id="text_body_{$smarty.foreach.foo.index}" name="text_body" rows="10" cols="100">{$text.texts_text_body}</textarea>
    <button class="save_text" name="save" value="Update">Сохранить</button>
    {if $text.texts_id == 1}
      <button class="upload" data='{literal}{{/literal}"upload_type":"texts", "item_id":"{$text.texts_id}", "count":"1", "width":"454", "height":"300", "sizes":"s,b"{literal}}{/literal}'>Загрузить фото</button>
      <ul class="imgs">
      </ul>
    {/if}
  </form>
  {/foreach}
  {include file='admin.set_select.tpl'}
</div>
{/block}
