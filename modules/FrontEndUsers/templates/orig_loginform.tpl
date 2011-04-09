{* login form template *}
{* this is a sample template, feel free to customize it *}
{$startform}
{if $error}
  {$error}<br>
{/if}
<p>
 {$prompt_username}:&nbsp;{$input_username}<br/>
 {$prompt_password}:&nbsp;{$input_password}
 {if isset($captcha)}
   <br/>
   {$captcha_title}: {$input_captcha}<br/>
   {$captcha}
 {/if}
 {if isset($input_rememberme)}
   <br/>
   {$input_rememberme}&nbsp;{$prompt_rememberme}<br/>
 {/if}
 <br/>
 <input type="submit" name="{$feuactionid}submit" value="{$mod->Lang('login')}"/><br/>
  <a href="{$url_forgot}" title="{$mod->Lang('info_forgotpw')}">{$mod->Lang('forgotpw')}</a><br/>
  <a href="{$url_lostun}" title="{$mod->Lang('info_lostun')}">{$mod->Lang('lostusername')}</a>
</p>
{$endform}
