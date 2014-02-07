{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/courses.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <div class="course">
    <img src="/images/kurs1.png" class="course_logo" />
    <section class="course_info">
      <h1 class="nice">Бисероплетение</h1>
      <span class="teacher dropdown_head">Преподаватель: <span>Тертышный Марк</span></span>
      <div class="teacher_info dropdown_block">
        <img src="/images/teacher1.jpg" class="teacher_photo" />
        <div class="teacher_right_block">
          <p>
            Aрт-студия "Аллея" приглашает детей помладше — в рамках занятий их познакомят с основами анимации и такими вещами, как живопись по стеклу, анимация при помощи кофе, песка или пластилина, а также научат создавать флипбуки и "живые картины". А для самых маленьких предусмотрен курс арт-терапии, где дети научатся осознавать и выражать свою уникальность, общаться со сверстниками и преодолевать страхи.
          </p>
        </div>
      </div>
      <p class="course_text">
        Aрт-студия "Аллея" приглашает детей помладше — в рамках занятий их познакомят с основами анимации и такими вещами, как живопись по стеклу, анимация при помощи кофе, песка или пластилина, а также научат создавать флипбуки и "живые картины". А для самых маленьких предусмотрен курс арт-терапии, где дети научатся осознавать и выражать свою уникальность, общаться со сверстниками и преодолевать страхи.
      </p>
      <div class="gallery">
        <a href="#"><img src="/images/photo1.jpg" /></a>
        <a href="#"><img src="/images/photo1.jpg" /></a>
        <a href="#"><img src="/images/photo1.jpg" /></a>
        <a href="#"><img src="/images/photo1.jpg" /></a>
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
