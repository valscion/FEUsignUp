{* search form template *}
<div id="cgcal_searchform">
{$formstart}
  <div class="row">
    <div style="width: 40%; float: left; text-align: right;">
      {$mod->Lang('text')}:
    </div>
    <div style="width: 40%; float: left;">
      <input type="text" name="{$actionid}cal_search_text" value="{$search_text}" size="50"/>
    </div>
  </div>

  <div class="row">
    <div style="width: 40%; float: left; text-align: right;">
      {$mod->Lang('search_type')}:
    </div>
    <div style="width: 40%; float: left;">
      {capture assign='tmp'}{$actionid}cal_search_type{/capture}
      <select name="{$tmp}">
        <option value="or" label="{$mod->Lang('search_any')}">{$mod->Lang('search_any')}</option>
        <option value="and" label="{$mod->Lang('search_all')}">{$mod->Lang('search_all')}</option>
      </select>
    </div>
  </div>

  <div class="row">
    <div style="width: 40%; float: left; text-align: right;">
      {$mod->Lang('start_date')}:
    </div>
    <div style="width: 40%; float: left;">
      {capture assign='tmp'}{$actionid}cal_search_start_date_{/capture}
      {html_select_date prefix=$tmp time=$search_start_date start_year=-2 end_year=+2}
      {* {html_select_time prefix=$tmp time=$search_start_date display_seconds=0} *}
    </div>
  </div>

  <div class="row">
    <div style="width: 40%; float: left; text-align: right;">
      {$mod->Lang('end_date')}:
    </div>
    <div style="width: 40%; float: left;">
      {capture assign='tmp'}{$actionid}cal_search_end_date_{/capture}
      {html_select_date prefix=$tmp time=$search_end_date start_year=-2 end_year=+2}
      {* {html_select_time prefix=$tmp time=$search_end_date display_seconds=0} *}
    </div>
  </div>

  <div class="row">
    <div style="width: 40%; float: left; text-align: right;">
      {$mod->Lang('category')}:
    </div>
    <div style="width: 40%; float: left;">
      <select name="{$actionid}cal_search_category">
        {html_options options=$list_categories selected=$search_category}
      </select>
    </div>
  </div>

  <div class="row">
    <div style="width: 40%; float: left; text-align: right;">&nbsp;</div>
    <div style="width: 40%; float: left;">
      <input type="submit" name="{$actionid}cal_search_submit" value="{$mod->Lang('search')}"/>
    </div>
  </div>

{$formend}
</div>
