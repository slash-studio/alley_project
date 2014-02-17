{extends file='admin.tpl'}
{block name='title' append} - Тексты{/block}
{block name='links' append}
  <link href="/css/upload_photos.css" rel="stylesheet" />
  <script src="/js/select_plugin.js"></script>
  <script src="/js/images.js"></script>
{/block}
{block name="div.main"}
<div id="top_block">
  <h1>Тексты</h1>
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  <label for="choose_item">Выберите текст</label>
  <select id="choose_item" name="choose_item">
  {foreach from=$texts item=text}
    <option value="{$text.texts_id}">{$text.texts_name}</option>
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
  </form>
  {if $text.texts_have_photo}
    <div class="upload_photos" id="div_upload{$text.texts_id}">
      <form method="POST" action="/admin/upload_photo">
        <input type="hidden" name="data" value='{literal}{{/literal}"upload_type":"texts", "makeMain":"false", "maxSize":"1024000", "item_id":"{$text.texts_id}", "width":"450", "height":"300", "count":"1", "sizes":"s#225#150,b#450#300"{literal}}{/literal}' />
        <button class="upload">Загрузить фото</button>
      </form>
      <ul>
        {if isset($text.texts_photo_id)}
          <li><a href="/scripts/uploads/{$text.texts_photo_id}_s.jpg"><img src="/scripts/uploads/{$text.texts_photo_id}_s.jpg" /></a><button class="x" data="{$text.texts_photo_id}">x</button></li>
        {/if}
      </ul>
    </div>
  {/if}
  {/foreach}
  {include file='admin.set_select.tpl'}
</div>
{/block}
