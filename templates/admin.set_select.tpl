{if isset($last_viewed_id)}
<script type="text/javascript">
   {literal}
   ${/literal}('#choose_item option[value="item{$last_viewed_id}"]').attr('selected','selected');{literal}
   $('#choose_item').change();
   {/literal}
</script>
{/if}