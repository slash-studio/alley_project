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
  {foreach from=$table_side item=side_caption name=i}
    <tr>
    {foreach from=$table_head item=head_caption name=j}
      {if $smarty.foreach.i.index != 0 && $smarty.foreach.j.index != 0}
        <td>
          <div class="course">
            Бисероплетение
          </div>
          <div class="course">
            Макраме
          </div>
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
{/block}
