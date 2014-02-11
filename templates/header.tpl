<header>
  <a href='/'><img src="/images/logo.png" /></a>
  <nav>
    <ul>
      <li><a href="/" data='main'>Главная</a></li>
      <li><a href="/articles" data='articles'>Новости</a></li>
      <li><a href="/courses" data='courses'>Арт-курсы</a></li>
      <li><a href="/timetable" data='timetable'>Расписание</a></li>
      <li><a href="/about" data='about'>О нас</a></li>
      <script type="text/javascript">
        $('header a[data="{$active_item|default:'main'}"]').addClass('active');
      </script>
  </ul>
  </nav>
</header>