{$tab_info}

{if $signup_count > 0}
<table cellspacing="0" class="pagetable">
    <thead>
        <tr>
            <th>{$th_id}</th>
            <th>{$th_feu}</th>
            <th>{$th_event}</th>
            <th>{$th_date}</th>
            <th>{$th_signed_up}</th>
            <th>{$th_desc}</th>
            <th class="pageicon">&nbsp;</th>
            <th class="pageicon">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

{foreach from=$signups item=signup}
    <tr>
        <td>{$signup->id}</td>
        <td>{$signup->feu}</td>
        <td>{$signup->event_info}</td>
        <td>{$signup->event_date}</td>
        <td>{$signup->signed_up}</td>
        <td>{$signup->description}</td>
        <td>{$signup->editlink}</td>
        <td>{if isset($signup->deletelink)}{$signup->deletelink}{/if}</td>
    </tr>
{/foreach}
    </tbody>
</table>
{else}
<p><strong>{$no_signups}</strong></p>
{/if}