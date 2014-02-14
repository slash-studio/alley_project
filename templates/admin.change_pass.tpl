{extends file='html.tpl'}
{block name='title' append} - Смена пароля{/block}
{block name='links' append}
  <link href="/css/admin_login.css" rel="stylesheet" />
  <link href="/css/main.css" rel="stylesheet" />
{/block}
{block name='page'}
<div id="floater">&nbsp;</div>
<div id="center_block">
  <form action="/admin/change_pass" method="POST" ENCTYPE="multipart/form-data">
    {if isset($invalid_pass)}<p class="invalid_pass">Неправильное имя пользователя или пароль</p>{/if}
    <label for="login">Логин</label>
    <input type="text" name="login" id="login" value="{$admin_login|default:''}">
    <label for="pass">Пароль</label>
    <input type="password" name="pass" id="pass">
    <label for="new_pass">Новый пароль</label>
    <input type="password" name="new_pass" id="new_pass">
    <button type="submit" name="submit" value="submit">Изменить</button>
  </form>
</div>
{/block}
