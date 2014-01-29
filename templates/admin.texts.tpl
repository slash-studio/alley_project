{extends file='admin.tpl'}
{block name='links' append}
  <link href="/css/admin_texts.css" rel="stylesheet" />
  <script src="/js/admin_texts.js"></script>
{/block}
{block name="div.main"}
<div id="top_block">
  <h1>Тексты</h1>
  {if isset($error_txt)}<p class="db_error">{$error_txt}</p>{/if}
  <label for="choose_text"></label>
  <select id="choose_text" name="choose_text">
  {foreach from=$texts item=text}
    <option value="text{$text.texts_id}">{$text.texts_name}</option>
  {/foreach}
  </select>
  {foreach from=$texts item=text name=foo}
  <form action="/admin/texts" method="post" class="text_edit" id="text{$text.texts_id}">
    <h2>{$text.texts_name}</h2>
    <input type="hidden" class="teacher_id" name="id" value="{$text.texts_id}" />
    <label for="text_head_{$smarty.foreach.foo.index}">Заголовок:</label>
    <input id="text_head_{$smarty.foreach.foo.index}" name="text_head" class="text_head" value="{$text.texts_text_head}" />
    <label for="text_body_{$smarty.foreach.foo.index}">Текст:</label>
    <textarea id="text_body_{$smarty.foreach.foo.index}" name="text_body" rows="10" cols="100">{$text.texts_text_body}</textarea>
    <button class="save_text" name="save" value="Update">Сохранить</button>
  </form>
  {/foreach}
  {if isset($last_viewed_text_id)}
  <script type="text/javascript">
    {literal}
    ${/literal}('#choose_text option[value="text{$last_viewed_text_id}"]').attr('selected','selected');{literal}
    $('#choose_text').change();
    {/literal}
  </script>
  {/if}
</div>
{/block}
