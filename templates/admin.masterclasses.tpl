{extends file='admin.tpl'}
{block name='title' append} - Мастер-классы{/block}
{block name='links' append}
  <script src="/js/select_plugin.js"></script>
  <script src="/js/ajaxupload.3.5.js"></script>
  <script src="/js/upload_photo.js"></script>
  <link href="/css/upload_photos.css" rel="stylesheet" />
{/block}
{block name="div.main"}
<div id="top_block">
  <h1>Мастер-классы</h1>
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  {if $classes|@count!=0}
    <label for="choose_item">Выберите арт-курс</label>
    <select id="choose_item" name="choose_item">
    {foreach from=$classes item=class}
      <option value="item{$class.master_class_id}">{$class.master_class_name}</option>
    {/foreach}
    </select>
  {/if}
  {foreach from=$classes item=class name=foo}
    <form action="/admin/masterclasses" method="post" class="item_edit" id="item{$class.master_class_id}">
      <input type="hidden" class="class_id" name="id" value="{$class.master_class_id}" />
      <label for="class_head_{$smarty.foreach.foo.index}">Название:</label>
      <input class="class_head" name="name" id="class_{$smarty.foreach.foo.index}" value="{$class.master_class_name}" />
      <label for="class_date_{$smarty.foreach.foo.index}">Дата:</label>
      <input class="class_date" name="date" type="datetime" id="class_date_{$smarty.foreach.foo.index}" value="{$class.master_class_date_of}" />
      <label for="class_body_{$smarty.foreach.foo.index}">Текст:</label>
      <textarea class="class_body" name="description" id="class_body_{$smarty.foreach.foo.index}" rows="5" cols="70">{$class.master_class_description}</textarea>
      <button class="save" name="mode" value="Update">Сохранить</button><button class="delete" name="mode" value="Delete">Удалить</button>
      <div class="upload_photos">
        <button class="upload" data='{literal}{{/literal}"buttonId": "{$class.master_class_id}", "makeMain":"false", "upload_type":"masterclass", "maxSize":"1024000", "item_id":"{$class.master_class_id}", "count":"1", "sizes":"s,b"{literal}}{/literal}'>Загрузить фото</button>
        <ul>
          {foreach from=$class.master_class_photos item=photo}
            <li><a href="/scripts/uploads/{$photo}_s.jpg"><img src="/scripts/uploads/{$photo}_s.jpg" /></a><button class="x" data="{$photo}">x</button></li>
          {/foreach}
        </ul>
      </div>
    </form>
  {/foreach}
  {include file='admin.set_select.tpl'}
  <form action="/admin/masterclasses" method="post" id="add_masterclass">
    <label for="masterclass_head">Название:</label>
    <input class="masterclass_head" name="name" id="masterclass_head" value="" />
    <label for="masterclass_date">Дата:</label>
    <input class="masterclass_date" type="datetime" name="date" id="masterclass_date" value="" />
    <label for="masterclass_body">Текст:</label>
    <textarea class="masterclass_body" name="description" id="masterclass_body" rows="5" cols="70"></textarea>
    <button class="save" name="mode" value="Insert">Добавить</button>
  </form>
</div>
{/block}