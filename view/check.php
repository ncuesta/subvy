<img src="{ $image }" alt="{ $status }" title="{ $status }" /> { $message }
<em style="display: block; color: #3399dd;">
  { $name }
</em>

<script type="text/javascript">
//<![CDATA[
if ('Error' == '{ $status }')
{
  jQuery('#do-submit').attr('disabled', 'disabled');
}
else
{
  jQuery('#do-submit').removeAttr('disabled');
}
//]]>
</script>
