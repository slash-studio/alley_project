{extends file='html.tpl'}
{block name='links' append}
  <link href="/imgareaselect/css/imgareaselect-default.css" rel="stylesheet" />
  <link href="/css/resize_photo.css" rel="stylesheet" />
  <script src="/imgareaselect/js/jquery.imgareaselect.js"></script>
  <script src="/js/resize_photo.js"></script>
{/block}
{block name='page'}
  <div id="resize_photo">
    <img class="src_image" src="/scripts/uploads/{$photo_id}.jpg" />
    <span class="info">Выделите область фотографии</small>
  </div>
{/block}