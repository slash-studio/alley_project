{extends file='admin.tpl'}
{block name='links' append}
   <link href="/css/admin_teachers.css" rel="stylesheet" />
{/block}
{block name="div.main"}
<div id="top_block">
  <h1>Учителя</h1>
  <form action="/admin/teachers" method="post" class="form_teacher">
    <input type="hidden" class="teacher_id" name="id" value="" />
    <label for="teacher_head_1">Имя:</label>
    <input class="teacher_head" name="name" id="teacher_head_1" value="" />
    <label for="teacher_body_1">Текст:</label>
    <textarea class="teacher_body" name="info" id="teacher_body_1" rows="5" cols="70"></textarea>
    <button class="save_teacher" name="mode" value="Update">Сохранить</button><button class="delete_teacher" name="mode" value="Delete">Удалить</button>
  </form>
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