{extends file='page.tpl'}
{block name='links' append}
  <link href="/css/header.css" rel="stylesheet" />
  <link href="/css/footer.css" rel="stylesheet" />
  <link href="/css/index.css" rel="stylesheet" />
{/block}
{block name='div.main'}
  {include file="header.tpl"}

  {if $pagesAmount > 1}
    <div id="nav_num">
    {foreach from = $pagesNum item=t}
      {if $t == '...'} ... {else}
      <button class="button {if $curPage == $t}active{/if}" onClick="javascript:location.assign('/news/?page={$t}')">{$t}</button>
      {/if}
    {/foreach}
    </div>
  {/if}
{/block}
