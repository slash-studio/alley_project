{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/index.css" rel="stylesheet" />
  <link href="/css/timetable.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <h1 class="nice">Расписание</h1>
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
                </div>
              {/if}
            {/foreach}
          {/if}
        </td>
      {elseif $smarty.foreach.i.index == 0 && $smarty.foreach.j.index != 0}
        <th>{$time.time_start} - {$time.time_end}</th>
      {elseif $smarty.foreach.i.index != 0 && $smarty.foreach.j.index == 0}
        <th class="left_head">{$day.days_of_week_name}</th>
      {elseif $smarty.foreach.i.index == 0 && $smarty.foreach.j.index == 0}
        <th></th>
      {/if}
    {/foreach}
    </tr>
  {/foreach}
  </table>
{/block}
