{$startform}
{if isset($grouplist)}
  <div class="pageoverflow">
    <p class="pagetext">{$mod->lang('prompt_feedit_group')}:</p>
    <p class="pageinput">
      <select name="{$actionid}frontend_group">
        {html_options options=$grouplist selected=$frontend_group}
      </select>
    </p>
  </div>

  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('prompt_feedit_page')}:</p>
    <p class="pagetext">
      <input type="text" name="{$actionid}frontend_redirectpage" size="50" maxlength="255" value="{$frontend_redirectpage}"/>
    </p>
  </div>
{/if}

  <div class="pageoverflow">
	<p class="pagetext">{$twelvehourtext}:</p>
	<p class="pageinput">{$twelvehourinput}</p>
 </div>

  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('prompt_overlap_policy')}:</p>
    <p class="pageinput">
      <select name="{$actionid}overlap_policy">
      {html_options options=$overlap_policies selected=$overlap_policy}
      </select>
    </p>
  </div>

  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('prompt_overlap_action')}:</p>
    <p class="pageinput">
      <select name="{$actionid}overlap_action">
      {html_options options=$overlap_actions selected=$overlap_action}
      </select>
    </p>
  </div>

	<div class="pageoverflow">
		<p class="pagetext">{$forcecattext}:</p>
		<p class="pageinput">{$forcecatinput}</p>
	</div>

	<div class="pageoverflow">
		<p class="pagetext">{$defcattext}:</p>
		<p class="pageinput">{$defcatinput}</p>
	</div>
	
	<div class="pageoverflow">
		<p class="pagetext">{$pastyearstext}:</p>
		<p class="pageinput">{$pastyearsinput}</p>
	</div>
	
	<div class="pageoverflow">
		<p class="pagetext">{$futureyearstext}:</p>
		<p class="pageinput">{$futureyearsinput}</p>
	</div>
	
	<div class="pageoverflow">
		<p class="pagetext">{$hidesummarytext}:</p>
		<p class="pageinput">{$hidesummaryinput}</p>
	</div>
	
	<div class="pageoverflow">
		<p class="pagetext">{$hidecontenttext}:</p>
		<p class="pageinput">{$hidecontentinput}</p>
        <div class="pageoverflow">
                <p class="pagetext">{$defaultcalendarpage_text}:</p>
                <p class="pageinput">{$defaultcalendarpage_input}</p>
        </div>

	<div class="pageoverflow">
		<p class="pagetext">{$uploaddirectory_text}:</p>
		<p class="pageinput">{$uploaddirectory_input}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$uploadfiletypes_text}:</p>
		<p class="pageinput">{$uploadfiletypes_input}</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">{$uploadunique_text}:</p>
		<p class="pageinput">{$uploadunique_input}</p>
	</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('dflt_alldayevent')}:</p>
  <p class="pageinput">
    {cge_yesno_options prefix=$actionid name='dflt_alldayevent' selected=$dflt_alldayevent}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('dflt_starttime')}:</p>
  <p class="pageinput">
    {capture assign='tmp'}{$actionid}dflt_starttime_{/capture}
    {html_select_time prefix=$tmp display_seconds=false time=$dflt_starttime minute_interval=15}
    <br/>
    {$mod->Lang('info_dflt_starttime')}
  </p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('dflt_urlprefix')}:</p>
  <p class="pageinput">
    <input type="text" size="20" name="{$actionid}url_prefix" value="{$url_prefix}" />
  </p>
</div>

	<div class="pageoverflow">
		<p class="pagetext">&nbsp;</p>
		<p class="pageinput">{$submit}</p>
	</div>
{$endform}