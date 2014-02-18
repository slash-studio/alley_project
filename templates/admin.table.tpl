{extends file='admin.tpl'}
{block name='title' append} - Расписание{/block}
{block name='links' append}
  <link href="/css/admin_table.css" rel="stylesheet" />
  <link href="/colorbox/colorbox.css" rel="stylesheet" />
  <script src="/colorbox/jquery.colorbox.js"></script>
  <script src="/js/admin_table.js"></script>
{/block}
{block name="div.main"}
<div id="top_block">
  <section id="times_block">
    <h1>Время занятий</h1>
    <small>Время занятий записывается в формате ЧЧ:ММ, например: 09:40</small>
    <form>
      {foreach from=$times item=time name=i}
        {if $smarty.foreach.i.index != 0}
        <div>
          <label for="time_begin_{$smarty.foreach.i.index}">Начало: </label>
          <input id="time_begin_{$smarty.foreach.i.index}" name="time_begin_{$smarty.foreach.i.index}" size="5" value="{$time.time_start}" />
          <label for="time_end_{$smarty.foreach.i.index}">Конец: </label>
          <input id="time_end_{$smarty.foreach.i.index}" name="time_end_{$smarty.foreach.i.index}" size="5" value="{$time.time_end}" />
          <button class="edit times" data-num="{$smarty.foreach.i.index}" data-id="{$time.time_id}" data-mode="Update" title="Сохранить изменения"></button>
          <button class="delete times" data-num="{$smarty.foreach.i.index}" data-id="{$time.time_id}" data-mode="Delete" title="Удалить"></button>
        </div>
        {/if}
      {/foreach}
      <h2>Добавить новое время</h2>
      <div>
        <label for="time_begin_0">Начало: </label>
        <input id="time_begin_0" name="time_begin_0" size="5" value="" />
        <label for="time_end_0">Конец: </label>
        <input id="time_end_0" name="time_end_0" size="5" value="" />
        <button class="add times" data-num="0" data-id="" data-mode="Insert" title="Добавить"></button>
      </div>
    </form>
  </section>
  <section>
    <h1>Расписание</h1>
    {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
    <table id="timetable">
    {foreach from=$days item=day name=i}
      <tr>
      {foreach from=$times item=time name=j}
        {if $smarty.foreach.i.index != 0 && $smarty.foreach.j.index != 0}
          <td>
          {if isset($timetable[$day.days_of_week_id])}
            {foreach from=$timetable[$day.days_of_week_id] item=info}
              {if $info.timetable_time_id==$time.time_id}
                <div class="course">
                  {$courses[$info.timetable_course_id]}
                  <button class="icon delete" data-id='{$info.timetable_id}' title="Удалить"></button>
                </div>
              {/if}
            {/foreach}
          {/if}
            <a class="icon add" title="Добавить курс" href="#add_course" data-day-id="{$day.days_of_week_id}" data-time-id="{$time.time_id}"></a>
          </td>
        {elseif $smarty.foreach.i.index == 0 && $smarty.foreach.j.index != 0}
          <th>{$time.time_start} - {$time.time_end}</th>
        {elseif $smarty.foreach.i.index != 0 && $smarty.foreach.j.index == 0}
          <th>{$day.days_of_week_name}</th>
        {elseif $smarty.foreach.i.index == 0 && $smarty.foreach.j.index == 0}
          <th></th>
        {/if}
      {/foreach}
      </tr>
    {/foreach}
    </table>
    <div style="display: none">
      <div id="add_course">
      {if $courses|@count != 0}
        <label for="select_course">Выберите курс</label>
        <select id="select_course" name="select_course">
        {foreach from=$courses item=course_name key=course_id}
          <option value="{$course_id}">{$course_name}</option>
        {/foreach}
        </select>
        <button class="save normal" data-mode="Insert" data-id="" data-day-id="" data-time-id="">Добавить</button>
      {else}
        <h2>Вы не добавили арт-курсы!</h2>
      {/if}
      </div>
    </div>
  </section>
</div>
{/block}