{extends file='page.tpl'}
{block name='title' append} - Арт-курсы{/block}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/courses.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div class="course">
    {if isset($course.courses_photo_id)}<img src="/scripts/uploads/{$course.courses_photo_id}_b.jpg" class="course_logo" />{/if}
    <section class="course_info">
      <h1 class="nice">{$course.courses_name}</h1>
      <span class="teacher dropdown_head">Преподаватель: <span>{$course.teachers_name}</span></span>
      <div class="teacher_info dropdown_block">
        <img src="/scripts/uploads/{$course.teachers_photo_id}_s.jpg" class="teacher_photo" />
        <div class="teacher_right_block">
          {$course.teachers_info}
        </div>
      </div>
      <div class="course_text">{$course.courses_description}</div>
      <div class="gallery">
      {foreach from=$course.courses_photos item=photo}
        {if $course.courses_photo_id!=$photo}
          <a href="#"><img src="/scripts/uploads/{$photo}_s.jpg" /></a>
        {/if}
      {/foreach}
      </div>
    </section>
    <div class="timetable">
      <ul>
        {section name=foo start=1 loop=7 step=1}
          <li>
            <div class="{if isset($courseTime[$smarty.section.foo.index])}yes day{$smarty.section.foo.index}{else}no{/if}"></div>{if isset($courseTime[$smarty.section.foo.index])}{foreach from=$courseTime[$smarty.section.foo.index] item=timePart}<span>{$timePart.time_start} - {$timePart.time_end}</span>{/foreach}{/if}
          </li>
        {/section}
<!--         <li><div class="no yes"></div></li>
        <li><div class="no"></div></li>
        <li><div class="yes day4"></div><span>10:00 - 14:00</span></li>
        <li><div class="no"></div></li>
        <li><div class="yes day6"></div><span>10:00 - 14:00</span></li>
        <li><div class="yes day7"></div><span>10:00 - 14:00</span></li> -->
      </ul>
    </div>
  </div>
{/block}