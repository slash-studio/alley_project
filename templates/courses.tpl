{extends file='page.tpl'}
{block name='title' append} - Арт-курсы{/block}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/courses.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div id="top_block" class="text_block">
    {if $courses_text.texts_have_photo && isset($courses_text.texts_photo_id)}<img src="/scripts/uploads/{$courses_text.texts_photo_id}_b.jpg" />{/if}
    <section class="text">
      <h1 class="nice">{$courses_text.texts_text_head}</h1>
      <p>{$courses_text.texts_text_body}</p>
    </section>
  </div>
  <div class="courses">
    <ul>
      {foreach from=$courses item=course}
        <li><a href="/course/{$course.courses_id}"><img src="/scripts/uploads/{$course.courses_photo_id}_b.jpg" /><span>{$course.courses_name}</span></a></li>
      {/foreach}
<!--       <li><a href="/course/{$course.courses_id}"><img src="/images/kurs1.png" /><span>Макраме</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs2.png" /><span>Бисероплетение</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs3.png" /><span>Макраме</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs4.png" /><span>Бисероплетение</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs1.png" /><span>Макраме</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs2.png" /><span>Бисероплетение</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs3.png" /><span>Макраме</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs4.png" /><span>Бисероплетение</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs1.png" /><span>Макраме</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs2.png" /><span>Бисероплетение</span></a></li> -->
    </ul>
  </div>
{/block}
