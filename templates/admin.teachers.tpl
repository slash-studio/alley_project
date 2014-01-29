{extends file='admin.tpl'}
{block name='links' append}
  <link href="/css/admin_teachers.css" rel="stylesheet" />
{/block}
{block name="div.main"}
<div id="top_block">
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  {if $teachers|@count!=0}<h1>Учителя</h1>{/if}
  {foreach from=$teachers item=teacher}
    <p><a href="#teacher_{$teacher.teachers_id}">{$teacher.teachers_name}</a></p>
  {/foreach}
  {foreach from=$teachers item=teacher name=foo}
  <a name="teacher_{$teacher.teachers_id}"></a>
  <form action="/admin/teachers" method="post" class="form_teacher">
    <input type="hidden" class="teacher_id" name="id" value="{$teacher.teachers_id}" />
    <label for="teacher_head_{$smarty.foreach.foo.index}">Имя:</label>
    <input class="teacher_head" name="name" id="teacher_head_{$smarty.foreach.foo.index}" value="{$teacher.teachers_name}" />
    <label for="teacher_body_{$smarty.foreach.foo.index}">Текст:</label>
    <textarea class="teacher_body" name="info" id="teacher_body_{$smarty.foreach.foo.index}" rows="5" cols="70">{$teacher.teachers_info}</textarea>
    <button class="save_teacher" name="mode" value="Update">Сохранить</button><button class="delete_teacher" name="mode" value="Delete">Удалить</button>
  </form>
  {/foreach}
  <form action="/admin/teachers" method="post" class="form_teacher">
    <h2>Добавить учителя</h2>
    <label for="teacher_head_new">Имя:</label>
    <input class="teacher_head" name="name" id="teacher_head_new" value="" />
    <label for="teacher_body_new">Текст:</label>
    <textarea class="teacher_body" name="info" id="teacher_body_new" rows="5" cols="70"></textarea>
    <button class="save_teacher" name="mode" value="Insert">Добавить</button>
  </form>
</div>
{/block}