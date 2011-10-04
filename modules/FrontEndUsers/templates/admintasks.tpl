{if isset($message) }<p>{$message}</p>{/if}

{* A form (simple button) for exporting users to csv *}
{$startform}{$input_hidden}
<fieldset>
<legend>{$legend_importusers}</legend>
{$info_importusersfileformat}<hr/>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_importuserstogroup}:</p>
  <p class="pageinput">{$input_importuserstogroup}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('ignore_userid')}:</p>
  <p class="pageinput">
    <input type="checkbox" name="{$actionid}import_ignore_userid" value="1"/>
    <br/> 
    {$mod->Lang('info_ignore_userid')}
  </p>
</div>
<div class="pageoverflow">
   <p class="pagetext">{$prompt_importusersfile}:</p>
   <p class="pageinput">{$input_importusersfile}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$input_importusersbtn}</p>
</div>
</fieldset>

<fieldset>
<legend>{$legend_exportusers}</legend>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('export_passhash')}:</p>
  <p class="pageinput">
    <input type="checkbox" name="{$actionid}export_passhash" value="1"/>
    <br/>
    {$mod->Lang('info_export_passhash')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_exportusers}:</p>
  <p class="pageinput">
    {$input_exportusers}
  </p>
</div>
</fieldset>

<fieldset>
<legend>{$legend_userhistorymaintenance}</legend>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_exportuserhistory}:</p>
  <p class="pageinput">{$input_exportuserhistory}&nbsp;{$button_exportuserhistory}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_clearuserhistory}:</p>
  <p class="pageinput">{$input_clearuserhistory}&nbsp;{$button_clearuserhistory}</p>
</div>
</fieldset>
{$endform}
