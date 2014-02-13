{extends file='admin.tpl'}
{block name='title' append} - Учителя{/block}
{block name='links' append}
  <script src="/js/select_plugin.js"></script>
  <script src="/js/ajaxupload.3.5.js"></script>
  <script src="/js/upload_photo.js"></script>
  <link href="/css/upload_photos.css" rel="stylesheet" />
{/block}
{block name="div.main"}
<div id="top_block">
  <h1>Учителя</h1>
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  {if $teachers|@count!=0}
    <label for="choose_item">Выберите учителя</label>
    <select id="choose_item" name="choose_item">
    {foreach from=$teachers item=teacher}
      <option value="item{$teacher.teachers_id}">{$teacher.teachers_name}</option>
    {/foreach}
    </select>
  {/if}
  {foreach from=$teachers item=teacher name=foo}
  <form action="/admin/teachers" method="post" class="item_edit" id="item{$teacher.teachers_id}">
    <input type="hidden" class="teacher_id" name="id" value="{$teacher.teachers_id}" />
    <label for="teacher_head_{$smarty.foreach.foo.index}">Имя:</label>
    <input class="teacher_head" name="name" id="teacher_head_{$smarty.foreach.foo.index}" value="{$teacher.teachers_name}" />
    <label for="teacher_body_{$smarty.foreach.foo.index}">Текст:</label>
    <textarea class="teacher_body" name="info" id="teacher_body_{$smarty.foreach.foo.index}" rows="5" cols="70">{$teacher.teachers_info}</textarea>
    <button class="save" name="mode" value="Update">Сохранить</button><button class="delete" name="mode" value="Delete">Удалить</button>
    <div class="upload_photos">
      <button class="upload" data='{literal}{{/literal}"buttonId": "{$teacher.teachers_id}", "upload_type":"teachers", "makeMain":"false", "maxSize":"1024000", "item_id":"{$teacher.teachers_id}", "count":"1", "sizes":"s,b"{literal}}{/literal}'>Загрузить фото</button>
      <ul>
        {if isset($teacher.teachers_photo_id)}
          <li><a href="/scripts/uploads/{$teacher.teachers_photo_id}_s.jpg"><img src="/scripts/uploads/{$teacher.teachers_photo_id}_s.jpg" /></a><button class="x" data="{$teacher.teachers_photo_id}">x</button></li>
        {/if}
      </ul>
    </div>
  </form>
  {/foreach}
  {include file='admin.set_select.tpl'}
  <form action="/admin/teachers" method="post" id="add_teacher">
    <h2>Добавить учителя</h2>
    <label for="teacher_head_new">Имя:</label>
    <input class="teacher_head" name="name" id="teacher_head_new" value="" />
    <label for="teacher_body_new">Текст:</label>
    <textarea class="teacher_body" name="info" id="teacher_body_new" rows="5" cols="70"></textarea>
    <button class="save" name="mode" value="Insert">Добавить</button>
  </form>
</div>
{/block}