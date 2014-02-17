{extends file='admin.tpl'}
{block name='title' append} - Расписание{/block}
{block name='links' append}
  <link href="/css/admin_table.css" rel="stylesheet" />
  <link href="/colorbox/colorbox.css" rel="stylesheet" />
  <script src="/colorbox/jquery.colorbox.js"></script>
  <script>
	{literal}
	$(function(){
		$('a.add').colorbox({inline:true, width:"400px", height:"250px"});
	});	
	{/literal}
  </script>
  <script src="/js/admin_table.js"></script>
{/block}
{block name="div.main"}
<div id="top_block">
  <section id="times_block">
    <h1>Время занятий</h1>
    <small>Время занятий записывается в формате ЧЧ:ММ, например: 09:40</small>
    <form>
      <div>
        <label for="time_begin_1">Начало: </label>
        <input id="time_begin_1" name="time_begin_1" size="5" value="" />
        <label for="time_end_1">Конец: </label>
        <input id="time_end_1" name="time_end_1" size="5" value="" />
        <button class="edit" title="Сохранить изменения"></button>
        <button class="delete" title="Удалить"></button>
      </div>
      <div>
        <label for="time_begin_2">Начало: </label>
        <input id="time_begin_2" name="time_begin_2" size="5" value="" />
        <label for="time_end_2">Конец: </label>
        <input id="time_end_2" name="time_end_2" size="5" value="" />
        <button class="edit" title="Сохранить изменения"></button>
        <button class="delete" title="Удалить"></button>
      </div>
      <h2>Добавить новое время</h2>
      <div>
        <label for="time_begin_new">Начало: </label>
        <input id="time_begin_new" name="time_begin_new" size="5" value="" />
        <label for="time_end_new">Конец: </label>
        <input id="time_end_new" name="time_end_new" size="5" value="" />
        <button class="add" title="Добавить"></button>
      </div>
    </form>
  </section>
  <section>
    <h1>Расписание</h1>
    {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
    <table id="timetable">
    {foreach from=$table_side item=side_caption name=i}
      <tr>
      {foreach from=$table_head item=head_caption name=j}
        {if $smarty.foreach.i.index != 0 && $smarty.foreach.j.index != 0}
          <td>
            <div class="course">
              Бисероплетение
              {literal}<button class="icon delete" data='{{/literal}"course_id":"1", "i":"{$smarty.foreach.i.index}", "j":"{$smarty.foreach.j.index}"{literal}}' title="Удалить"></button>{/literal}
            </div>
            <div class="course">
              Макраме
              <button class="icon delete" data="2" title="Удалить"></button>
            </div>
            <a class="icon add" title="Добавить курс" href="#add_course"></a>
          </td>
        {elseif $smarty.foreach.i.index == 0 && $smarty.foreach.j.index != 0}
          <th>{$head_caption}</th>
        {elseif $smarty.foreach.i.index != 0 && $smarty.foreach.j.index == 0}
          <th>{$side_caption}</th>
        {elseif $smarty.foreach.i.index == 0 && $smarty.foreach.j.index == 0}
          <th></th>
        {/if}
      {/foreach}
      </tr>
    {/foreach}
    </table>
    <div style="display: none">
    <div id="add_course">
      <label for="select_course">Выберите курс</label>
      <select id="select_course" name="select_course">
        <option value="1">Курс1</option>
        <option value="2">Курс2</option>
      </select>
      <button class="save normal">Добавить</button>
    </div>
    </div>
  </section>
</div>
{/block}