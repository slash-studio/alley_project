{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/articles.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}
  <article class="news_open">
    <div class="left_block">
      <img src="/images/photo350.jpg" />
      <div class="gallery">
        <a href="#"><img src="/images/photo1.jpg" /></a><a href="#"><img src="/images/photo1.jpg" /></a><a href="#"><img src="/images/photo1.jpg" /></a><a href="#"><img src="/images/photo1.jpg" /></a>
      </div>
    </div>
    <div class="right_block">
      <h1 class="nice">Новость номер один</h1>
      <time datetime="2014">2014.11.10</time>
      <p>Aрт-студия "Аллея" приглашает детей помладше — в рамках занятий их познакомят с основами анимации и такими вещами, как живопись по стеклу, анимация при помощи кофе, песка или пластилина, а также научат создавать флипбуки и "живые картины". А для самых маленьких предусмотрен курс арт-терапии, где дети научатся осознавать и выражать свою уникальность, общаться со сверстниками и преодолевать страхи. </p>
       <p>Aрт-студия "Аллея" приглашает детей помладше — в рамках занятий их познакомят с основами анимации и такими вещами, как живопись по стеклу, анимация при помощи кофе, песка или пластилина, а также научат создавать флипбуки и "живые картины". А для самых маленьких предусмотрен курс арт-терапии, где дети научатся осознавать и выражать свою уникальность, общаться со сверстниками и преодолевать страхи. </p>
        <p>Aрт-студия "Аллея" приглашает детей помладше — в рамках занятий их познакомят с основами анимации и такими вещами, как живопись по стеклу, анимация при помощи кофе, песка или пластилина, а также научат создавать флипбуки и "живые картины". А для самых маленьких предусмотрен курс арт-терапии, где дети научатся осознавать и выражать свою уникальность, общаться со сверстниками и преодолевать страхи. </p>
         <p>Aрт-студия "Аллея" приглашает детей помладше — в рамках занятий их познакомят с основами анимации и такими вещами, как живопись по стеклу, анимация при помощи кофе, песка или пластилина, а также научат создавать флипбуки и "живые картины". А для самых маленьких предусмотрен курс арт-терапии, где дети научатся осознавать и выражать свою уникальность, общаться со сверстниками и преодолевать страхи. </p>
    </div>
  </article>
  <section id="other_news">
    <h1 class="nice">Новости</h1> 
    <section class="news" id="news_left">    
      <article class="main">
        <a href="/article/{$news.news_id}"><img src="/images/news1.jpg" /></a>
        <h1><a href="/article/{$news.news_id}">Участвуйте вместе с Марком! Участвуйте вместе с Марком!</a></h1>
        <time datetime="{$news.news_publication_date}">2014.11.11</time>
        <p><a href="/article/{$news.news_id}">Это будет великолепноЭто будет великолепно Это будет великолепно Это будет великолепно!</a></p>
      </article>
      <article class="main">
        <a href="/article/{$news.news_id}"><img src="/images/news1.jpg" /></a>
        <h1><a href="/article/{$news.news_id}">Участвуйте вместе с Марком!</a></h1>
        <time datetime="{$news.news_publication_date}">2014.11.11</time>
        <p><a href="/article/{$news.news_id}">Это будет великолепно!</a></p>
      </article>
      <article class="main">
        <a href="/article/{$news.news_id}"><img src="/images/news1.jpg" /></a>
        <h1><a href="/article/{$news.news_id}">Участвуйте вместе с Марком!</a></h1>
        <time datetime="{$news.news_publication_date}">2014.11.11</time>
        <p><a href="/article/{$news.news_id}">Это будет великолепно!</a></p>
      </article>
    </section>
    <section class="news" id="news_right">
      <article class="main">
        <a href="/article/{$news.news_id}"><img src="/images/news1.jpg" /></a>
        <h1><a href="/article/{$news.news_id}">Участвуйте вместе с Марком! Участвуйте вместе с Марком!</a></h1>
        <time datetime="{$news.news_publication_date}">2014.11.11</time>
        <p><a href="/article/{$news.news_id}">Это будет великолепноЭто будет великолепно Это будет великолепно Это будет великолепно!</a></p>
      </article>
      <article class="main">
        <a href="/article/{$news.news_id}"><img src="/images/news1.jpg" /></a>
        <h1><a href="/article/{$news.news_id}">Участвуйте вместе с Марком!</a></h1>
        <time datetime="{$news.news_publication_date}">2014.11.11</time>
        <p><a href="/article/{$news.news_id}">Это будет великолепно!</a></p>
      </article>
      <article class="main">
        <a href="/article/{$news.news_id}"><img src="/images/news1.jpg" /></a>
        <h1><a href="/article/{$news.news_id}">Участвуйте вместе с Марком!</a></h1>
        <time datetime="{$news.news_publication_date}">2014.11.11</time>
        <p><a href="/article/{$news.news_id}">Это будет великолепно!</a></p>
      </article>
    </section>
  </section>
{/block}
