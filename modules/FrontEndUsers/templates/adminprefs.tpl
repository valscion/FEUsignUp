{if isset($message) }<p>{$message}</p>{/if}
{$startform}
<fieldset>
<legend>{$mod->Lang('general_settings')}:</legend>
	<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('auth_module')}:</p>
		<p class="pageinput">
                  <select name="{$actionid}auth_module">
                  {html_options options=$auth_modules selected=$auth_module}
                  </select>
                  <br/>{$mod->Lang('info_auth_module')}
                </p>
	</div>
 	<div class="pageoverflow">
	  <p class="pagetext">{$mod->Lang('prompt_auto_create_unknown')}:</p>
          <p class="pageinput">
             {cge_yesno_options prefix=$actionid name='auto_create_unknown' selected=$auto_create_unknown}
             <br/> 
             {$mod->Lang('info_auto_create_unknown')}
          </p>
        </div>
	<div class="pageoverflow">
		<p class="pagetext">{$prompt_allow_repeated_logins}:</p>
		<p class="pageinput">{$input_allow_repeated_logins}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$prompt_requireonegroup}:</p>
		<p class="pageinput">{$input_requireonegroup}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$prompt_dfltgroup}:</p>
		<p class="pageinput">{$input_dfltgroup}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('prompt_expireage')}:</p>
		<p class="pageinput">{$input_expireage}&nbsp;({$mod->Lang('months')})</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$mod->Lang('prompt_randomusername')}:</p>
		<p class="pageinput">{$input_randomusername}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$prompt_feusers_specific_permissions}:</p>
		<p class="pageinput">{$input_feusers_specific_permissions}<br/>
                   {$info_feusers_specific_permissions}</p>
	</div>
</fieldset>

<fieldset>
<legend>{$mod->Lang('session_settings')}:</legend>
	<div class="pageoverflow">
		<p class="pagetext">{$prompt_sessiontimeout}:</p>
		<p class="pageinput">{$input_sessiontimeout}</p>
	</div>
</fieldset>

<fieldset>
<legend>{$mod->Lang('property_settings')}:</legend>
	<div class="pageoverflow">
		<p class="pagetext">{$prompt_image_destination_path}:</p>
		<p class="pageinput">{$input_image_destination_path}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$prompt_allowed_image_extensions}:</p>
		<p class="pageinput">{$input_allowed_image_extensions}</p>
	</div>
</fieldset>

<fieldset>
<legend>{$mod->Lang('notification_settings')}:</legend>
	<div class="pageoverflow">
	        <p class="pagetext">{$prompt_notifications}:</p>
                <p class="pageinput">{$input_notifications}</p>        
	</div>
	<div class="pageoverflow">
	        <p class="pagetext">{$prompt_notification_address}:</p>
                <p class="pageinput">{$input_notification_address}</p>        
	</div>
	<div class="pageoverflow">
	        <p class="pagetext">{$prompt_notification_subject}:</p>
                <p class="pageinput">{$input_notification_subject}</p>        
	</div>
	<div class="pageoverflow">
	        <p class="pagetext">{$prompt_notification_template}:</p>
                <p class="pageinput">{$input_notification_template}</p>        
	</div>
</fieldset>

        {if $data_numresetrecords != ""}
 	  <div class="pageoverflow">
                <hr width="50%" align="left"/>
  	  </div>
          <div class="pageoverflow">
   	    <p class="pagetext">{$prompt_numresetrecords}</p>
	    <p class="pageinput">{$data_numresetrecords}</p>
          </div>
          <div class="pageoverflow">
	    <p class="pagetext">&nbsp;</p>
	    <p class="pageinput">{$input_remove1week}{$input_remove1month}{$input_removeall}</p>
          </div>
        {/if}
	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$hidden}{$submit}{$cancel}</p>
	</div>
{$endform}
