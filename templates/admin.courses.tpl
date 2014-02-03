{extends file='admin.tpl'}
{block name='links' append}
  <script src="/js/select_plugin.js"></script>
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
  <h2>{$course.courses_name}</h2>
    <input type="hidden" class="course_id" name="id" value="{$course.courses_id}" />
    <label for="course_head_{$smarty.foreach.foo.index}">Название:</label>
    <input class="course_head" name="name" id="course_{$smarty.foreach.foo.index}" value="{$course.courses_name}" />
    <label for="course_teacher_{$smarty.foreach.foo.index}">Учитель:</label>
    <select class="course_teacher" name="teacher" id="course_teacher_{$smarty.foreach.foo.index}">
		<option value="1">Марина Михайловна</option> <!-- ID УЧИТЕЛЯ-->
	</select>
	<label for="course_body_{$smarty.foreach.foo.index}">Текст:</label>
    <textarea class="course_body" name="info" id="course_body_{$smarty.foreach.foo.index}" rows="5" cols="70">{$course.courses_info}</textarea>
    <button class="save" name="mode" value="Update">Сохранить</button><button class="delete" name="mode" value="Delete">Удалить</button>
  </form>
  {/foreach}
  {include file='admin.set_select.tpl'}
  <form action="/admin/courses" method="post" id="add_course">
    <h2>Добавить арт-курс</h2>
    <label for="course_head_new">Название:</label>
    <input class="course_head" name="name" id="course_head_new" value="" />
	<label for="course_teacher_new">Учитель:</label>
    <select class="course_teacher" name="teacher" id="course_teacher_new">
		<option value="1">Марина Михайловна</option> <!-- ID УЧИТЕЛЯ-->
	</select>
    <label for="course_body_new">Текст:</label>
    <textarea class="course_body" name="info" id="course_body_new" rows="5" cols="70"></textarea>
    <button class="save" name="mode" value="Insert">Добавить</button>
  </form>
</div>
{/block}