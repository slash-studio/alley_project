{extends file='html.tpl'}
{block name='links' append}
  <link href="/css/admin.css" rel="stylesheet" />
  <link href="/css/main.css" rel="stylesheet" />
{/block}
{block name='page'}
<div id="wrap">
  <header>
    <nav>
      <ul>
        <li><a href="/admin/texts">Тексты</a></li>
        <li><a href="/admin/courses">Арт-курсы</a></li>
        <li><a href="/admin/teachers">Учителя</a></li>
        <li><a href="/admin/news">Новости</a></li>
        <li><a href="/admin/table">Расписание</a></li>
        <li><a href="/admin/masterclasses">Мастер-класс</a></li>
      </ul>
    </nav>
  </header>
  {block name='div.main'}{/block}
</div>
{/block}