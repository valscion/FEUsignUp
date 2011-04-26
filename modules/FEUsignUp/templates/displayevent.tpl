{literal}
<style type="text/css">
.displayevent_test ul {
    list-style-type: none;
}
.displayevent_test ul ul {
    padding-left: 2em;
    margin-bottom: 1em;
}
.displayevent_test ul ul ul {
    margin-bottom: 0;
}
</style>
{/literal}
<div style="background-color: #fff; padding: 10px; width: 400px;" class="displayevent_test">
<p>
<ul>
{foreach from=$users item=user}
    <li><strong>{$user->username}</strong>
        <ul>
            <li>Calendar link: <strong>{$user->cal_link}</strong></li>
            <li>ID: {$user->id}</li>
            {if !empty($user->props)}
            <li>Props:
                <ul>
                {foreach from=$user->props key=field item=value}
                    <li><em>{$field}:</em> {$value}</li>
                {/foreach}
                </ul>
            </li>
            {/if}
        </ul>
    </li>
{/foreach}
</ul>

</div>