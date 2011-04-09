{* admin panel template *}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('allowed_upload_filetypes')}:</p>
  <p class="pageinput">{$input_alloweduploadfiles}
  <br/>{$mod->Lang('info_allowed_upload_filetypes')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_prioritycountries}:</p>
  <p class="pageinput">{$input_prioritycountries}</p>
</div>

<fieldset>
<legend>{$prompt_template}</legend>
<div class="pageoverflow">
  <p class="pagetext">{$prompt_template}:</p>
  <p class="pageinput">{$input_template}</p>
</div>
<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$submit_template}&nbsp;{$reset}</p>
</div>
</fieldset>

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$submit}</p>
</div>
