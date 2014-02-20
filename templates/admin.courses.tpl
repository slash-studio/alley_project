{extends file='admin.tpl'}
{block name='title' append} - Арт-курсы{/block}
{block name='links' append}
  <script src="/js/select_plugin.js"></script>
  <link href="/css/upload_photos.css" rel="stylesheet" />
  <script src="/js/images.js"></script>
{/block}
{block name="div.main"}
<div id="top_block">
  <h1>Арт-курсы</h1>
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  {if $courses|@count!=0}
    <label for="choose_item">Выберите арт-курс</label>
    <select id="choose_item" name="choose_item">
    {foreach from=$courses item=course}
      <option value="{$course.courses_id}">{$course.courses_name}</option>
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
  </form>
  <div class="upload_photos div_upload{$course.courses_id}">
    <form method="POST" action="/admin/upload_photo">
      <input type="hidden" name="data" value='{literal}{{/literal}"uploadType":"courses", "cropType":"userCrop", "maxSize":"1024000", "item_id":"{$course.courses_id}", "width":"185", "height":"185", "count":"1", "sizes":"s#150#150,b#185#185"{literal}}{/literal}' />
      <button class="upload">Загрузить аватар</button>
    </form>
    <ul>
      {if isset($course.courses_photo_id)}
        <li><a href="/scripts/uploads/{$course.courses_photo_id}_s.jpg"><img src="/scripts/uploads/{$course.courses_photo_id}_s.jpg" /></a><button class="x" data="{$course.courses_photo_id}">x</button></li>
      {/if}
    </ul>
  </div>
  <div class="upload_photos div_upload{$course.courses_id}">
    <form method="POST" action="/admin/upload_photo">
      <input type="hidden" name="data" value='{literal}{{/literal}"uploadType":"courses", "cropType":"userCrop", "maxSize":"1024000", "item_id":"{$course.courses_id}", "width":"750", "height":"500", "count":"10", "sizes":"s#150#100,m#450#300,b#750#500"{literal}}{/literal}' />
      <button class="upload">Загрузить фото</button>
    </form>
    <ul>
      {foreach from=$course.courses_photos item=photo}
        {if $course.courses_photo_id != $photo}
          <li><a href="/scripts/uploads/{$photo}_s.jpg"><img src="/scripts/uploads/{$photo}_s.jpg" /></a><button class="x" data="{$photo}">x</button></li>
        {/if}
      {/foreach}
    </ul>
  </div>
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