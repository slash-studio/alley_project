{extends file='admin.tpl'}
{block name='title' append} - Мастер-классы{/block}
{block name='links' append}
  <script src="/js/select_plugin.js"></script>
  <link href="/css/upload_photos.css" rel="stylesheet" />
  <script src="/js/images.js"></script>
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
  <h1>Мастер-классы</h1>
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  {if $classes|@count!=0}
    <label for="choose_item">Выберите арт-курс</label>
    <select id="choose_item" name="choose_item">
    {foreach from=$classes item=class}
      <option value="{$class.master_class_id}">{$class.master_class_name}</option>
    {/foreach}
    </select>
  {/if}
  {foreach from=$classes item=class name=foo}
    <form action="/admin/masterclasses" method="post" class="item_edit" id="item{$class.master_class_id}">
      <input type="hidden" class="class_id" name="id" value="{$class.master_class_id}" />
      <label for="class_head_{$smarty.foreach.foo.index}">Название:</label>
      <input class="class_head" name="name" id="class_{$smarty.foreach.foo.index}" value="{$class.master_class_name}" />
      <label for="class_date_{$smarty.foreach.foo.index}">Дата:</label>
      <input class="class_date date_pick" name="date" id="class_date_{$smarty.foreach.foo.index}" value="{$class.master_class_date_of}" />
      <label for="class_body_{$smarty.foreach.foo.index}">Текст:</label>
      <textarea class="class_body" name="description" id="class_body_{$smarty.foreach.foo.index}" rows="5" cols="70">{$class.master_class_description}</textarea>
      <button class="save" name="mode" value="Update">Сохранить</button><button class="delete" name="mode" value="Delete">Удалить</button>
    </form>
    <div class="upload_photos div_upload{$class.master_class_id}">
      <form method="POST" action="/admin/upload_photo">
        <input type="hidden" name="data" value='{literal}{{/literal}"uploadType":"masterclasses", "cropType":"userCrop", "maxSize":"1024000", "item_id":"{$class.master_class_id}", "width":"300", "height":"300", "count":"1", "sizes":"s#100#100,b#300#300"{literal}}{/literal}' />
        <button class="upload">Загрузить фото</button>
      </form>
      <ul>
        {if isset($class.master_class_photo_id)}
          <li><a href="/scripts/uploads/{$class.master_class_photo_id}_s.jpg"><img src="/scripts/uploads/{$class.master_class_photo_id}_s.jpg" /></a><button class="x" data="{$class.master_class_photo_id}">x</button></li>
        {/if}
      </ul>
    </div>
  {/foreach}
  {include file='admin.set_select.tpl'}
  <form action="/admin/masterclasses" method="post" id="add_masterclass">
    <label for="masterclass_head">Название:</label>
    <input class="masterclass_head" name="name" id="masterclass_head" value="" />
    <label for="masterclass_date">Дата:</label>
    <input class="masterclass_date date_pick" name="date" id="masterclass_date" value="" />
    <label for="masterclass_body">Текст:</label>
    <textarea class="masterclass_body" name="description" id="masterclass_body" rows="5" cols="70"></textarea>
    <button class="save" name="mode" value="Insert">Добавить</button>
  </form>
</div>
{/block}