{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/courses.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div id="top_block">
    <img src="/images/slide1.jpg" />
    <section class="text">
      <h1 class="nice">Выберите курс который подходит именно вам!</h1>
      <p>Aрт-студия "Аллея" приглашает детей помладше — в рамках занятий их познакомят с основами анимации и такими вещами, как живопись по стеклу, анимация при помощи кофе, песка или пластилина, а также научат создавать флипбуки и "живые картины". А для самых маленьких предусмотрен курс арт-терапии, где дети научатся осознавать и выражать свою уникальность, общаться со сверстниками и преодолевать страхи.</p>
    </section>
  </div>
  <div class="courses">
    <ul>
      <!--{foreach from=$courses item=course}
        <li><a href="/course/{$course.courses_id}"><img src="/images/kurs1.png" /><span>{$course.courses_name}</span></a></li>
      {/foreach}
    -->
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs1.png" /><span>Макраме</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs2.png" /><span>Бисероплетение</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs3.png" /><span>Макраме</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs4.png" /><span>Бисероплетение</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs1.png" /><span>Макраме</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs2.png" /><span>Бисероплетение</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs3.png" /><span>Макраме</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs4.png" /><span>Бисероплетение</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs1.png" /><span>Макраме</span></a></li>
      <li><a href="/course/{$course.courses_id}"><img src="/images/kurs2.png" /><span>Бисероплетение</span></a></li>
    </ul>
  </div>
{/block}
