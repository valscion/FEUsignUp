{literal}
<script type="text/javascript">
/*<![CDATA[*/
function select_all()
{
  cb = document.getElementsByName('{/literal}{$feuactionid}selected[]{literal}');
  el = document.getElementById('selectall');
  st = el.checked;
  for( i = 0; i < cb.length; i++ )
  {
    if( cb[i].type == "checkbox" )
    {
      cb[i].checked=st;
    }
  }
}

function confirm_delete()
{
  var cb = document.getElementsByName('{/literal}{$feuactionid}selected[]{literal}');
  var count = 0;
  for( i = 0; i < cb.length; i++ )
  {
     if( cb[i].checked )
     {
       count++;
     }
  }

  if( count > 250 )
  {
     alert('{/literal}{$mod->Lang('error_toomanyselected')}{literal}');
     return false;
  }
  return confirm('{/literal}{$mod->Lang('confirm_delete_selected')}{literal}');
}

/*]]> */
</script>
{/literal}

{$startform}
<fieldset>
<legend>{$prompt_filter}:</legend>
<div class="pageoverflow">
 <p class="pagetext">{$prompt_group}</p>
 <p class="pageinput">{$filter_group}</p>
</div>
<div class="pageoverflow">
 <p class="pagetext">{$prompt_userfilter}</p>
 <p class="pageinput">{$filter_regex}</p>
</div>
<div class="pageoverflow">
 <p class="pagetext">{$prompt_propertyfiltersel}</p>
 <p class="pageinput">{$filter_propertysel}</p>
</div>
<div class="pageoverflow">
 <p class="pagetext">{$prompt_propertyfilter}</p>
 <p class="pageinput">{$filter_property}</p>
</div>
<div class="pageoverflow">
 <p class="pagetext">{$prompt_loggedinonly}</p>
 <p class="pageinput">{$filter_loggedinonly}</p>
</div>
<div class="pageoverflow">
 <p class="pagetext">{$prompt_limit}</p>
 <p class="pageinput">{$filter_limit}</p>
</div>
</fieldset>

<fieldset>
<legend>{$prompt_sort}:</legend>
<div class="pageoverflow">
 <p class="pagetext">{$prompt_sortby}</p>
 <p class="pageinput">{$filter_sortby}</p>
</div>
</fieldset>

<div class="pageoverflow">
 <p class="pagetext">&nbsp;</p>
 <p class="pageinput">{$input_select}{$input_hidden}</p><br/>
</div>

<div class="pageoverflow">
 <p>{$numusers}&nbsp;{$usersingroup}</p>
 <p>{$itemcount}&nbsp;{$usersfound}</p>
</div>
{if $itemcount > 0}
<table cellspacing="0" class="pagetable cms_sortable tablesorter">
	<thead>
		<tr>
			<th>{$usernametext}</th>
			<th>{$createdtext}</th>
			<th>{$expirestext}</th>
			<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
			<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
			<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
			<th class="pageicon {literal}{sorter: false}{/literal}">&nbsp;</th>
			<th class="pageicon {literal}{sorter: false}{/literal}"><input id="selectall" type="checkbox" name="junk" onclick="select_all();"/></th>
		</tr>
	</thead>
	<tbody>
{foreach from=$items item=entry}
		<tr>
			<td>{$entry->username}</td>
			<td>{$entry->created}</td>
			<td>{$entry->expires}</td>
			<td>{if isset($entry->logoutlink)}{$entry->logoutlink}{/if}</td>
			<td>{$entry->historylink}</td>
			<td>{$entry->editlink}</td>
			<td>{if isset($entry->deletelink)}{$entry->deletelink}{/if}</td>
			<td><input type="checkbox" name="{$feuactionid}selected[]" value="{$entry->id}"/></td>
		</tr>	 
{/foreach}
	</tbody>
</table>
{/if}
<div class="pageoverflow">
 <div style="float: left;">{$addlink}</div>
 <div style="float: right;">{if isset($perm_removeusers) && $perm_removeusers == 1}<input type="submit" name="{$feuactionid}bulkdelete" value="{$mod->Lang('delete_selected')}" onclick="return confirm_delete();"/>{/if}</div>
</div>
{$endform}
