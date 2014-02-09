{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/courses.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div class="course">
    <img src="/scripts/uploads/{$course.courses_photo_id}_s.jpg" class="course_logo" />
    <section class="course_info">
      <h1 class="nice">{$course.courses_name}</h1>
      <span class="teacher dropdown_head">Преподаватель: <span>{$course.teachers_name}</span></span>
      <div class="teacher_info dropdown_block">
        <img src="/scripts/uploads/{$course.teachers_photo_id}_s.jpg" class="teacher_photo" />
        <div class="teacher_right_block">
          <p>{$course.teachers_info}</p>
        </div>
      </div>
      <p class="course_text">{$course.courses_description}</p>
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
        <li><div class="yes day1"></div><span>10:00 - 14:00</span></li>
        <li><div class="no"></div></li>
        <li><div class="no"></div></li>
        <li><div class="yes day4"></div><span>10:00 - 14:00</span></li>
        <li><div class="no"></div></li>
        <li><div class="yes day6"></div><span>10:00 - 14:00</span></li>
        <li><div class="yes day7"></div><span>10:00 - 14:00</span></li>
      </ul>
    </div>
  </div>
{/block}