{extends file='admin.tpl'}
{block name='links' append}
  <script src="/js/select_plugin.js"></script>
  <script src="/js/ajaxupload.3.5.js"></script>
  <script src="/js/upload_photo.js"></script>
{/block}
{block name="div.main"}
<div id="top_block">
  <h1>Арт-курсы</h1>
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  {if $courses|@count!=0}
    <label for="choose_item">Выберите арт-курс</label>
    <select id="choose_item" name="choose_item">
    {foreach from=$courses item=course}
      <option value="item{$course.courses_id}">{$course.courses_name}</option>
    {/foreach}
    </select>
  {/if}
  {foreach from=$courses item=course name=foo}
  <form action="/admin/courses" method="post" class="item_edit" id="item{$course.courses_id}">
    <input type="hidden" class="course_id" name="id" value="{$course.courses_id}" />
    <label for="course_head_{$smarty.foreach.foo.index}">Название:</label>
    <input class="course_head" name="name" id="course_{$smarty.foreach.foo.index}" value="{$course.courses_name}" />
    <label for="course_teacher_{$smarty.foreach.foo.index}">Учитель:</label>
    <select class="course_teacher" name="teacher" id="course_teacher_{$smarty.foreach.foo.index}">
      {foreach from=$teachers item=teacher}
        <option value="{$teacher.teachers_id}" {if $teacher.teachers_id==$course.courses_teacher_id}selected{/if}>{$teacher.teachers_name}</option>
      {/foreach}
    </select>
    <label for="course_body_{$smarty.foreach.foo.index}">Текст:</label>
    <textarea class="course_body" name="description" id="course_body_{$smarty.foreach.foo.index}" rows="5" cols="70">{$course.courses_description}</textarea>
    <button class="save" name="mode" value="Update">Сохранить</button><button class="delete" name="mode" value="Delete">Удалить</button>
    <button class="upload" data='{literal}{{/literal}"upload_type":"courses_photo", "make_main":"true", "item_id":"{$course.courses_id}", "count":"1", "width":"", "height":"", "sizes":"s,b"{literal}}{/literal}'>Загрузить фото</button>
    <ul class="imgs">
      {foreach from=$course.courses_photo_id item=photo}
        <li><a href="/scripts/uploads/{$photo}_s.jpg"><img src="/scripts/uploads/{$photo}_s.jpg" /></a><button class="x" data="{$photo}">x</button><div><input type="radio" name="make_main" value="{$photo}" /><label for="make_main">Сделать главной</label></div></li> 
      {/foreach}
    </ul>
  </form>
  {/foreach}
  {include file='admin.set_select.tpl'}
  {if $teachers|@count != 0}
    <form action="/admin/courses" method="post" id="add_course">
      <h2>Добавить арт-курс</h2>
      <label for="course_head_new">Название:</label>
      <input class="course_head" name="name" id="course_head_new" value="" />
      <label for="course_teacher_new">Учитель:</label>
      <select class="course_teacher" name="teacher" id="course_teacher_new">
        {foreach from=$teachers item=teacher}
          <option value="{$teacher.teachers_id}">{$teacher.teachers_name}</option>
        {/foreach}
      </select>
      <label for="course_body_new">Текст:</label>
      <textarea class="course_body" name="description" id="course_body_new" rows="5" cols="70"></textarea>
      <button class="save" name="mode" value="Insert">Добавить</button>
    </form>
  {else}
    <h2>Для добавления курса необходимо добавить учителей!</h2>
  {/if}
</div>
{/block}