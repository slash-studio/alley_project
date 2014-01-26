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
					<li><a href="/admin/admin.texts.php">Тексты</a></li>
					<li><a href="/admin/admin.courses.php">Арт-курсы</a></li>
					<li><a href="/admin/admin.teachers.php">Учителя</a></li>
					<li><a href="/admin/admin.news.php">Новости</a></li>
					<li><a href="/admin/admin.table.php">Расписание</a></li>
					<li><a href="/admin/admin.masterclasses.php">Мастер-класс</a></li>
				</ul>
			</nav>
		</header>
		{block name='div.main'}{/block}
	</div>
{/block}
