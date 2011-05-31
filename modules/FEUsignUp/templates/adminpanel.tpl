{if isset($message)}<p>{$message}</p>{/if}
{$tabs_start}
    {$start_overview_tab}
        {if isset($error)}{$error}{/if}
        {$content_overview}
    {$tab_end}
    {$start_linkings_tab}
        {if isset($error)}{$error}{/if}
        {$content_linkings}
    {$tab_end}
    {$start_template_displayevent_tab}
        {if isset($error)}{$error}{/if}
        {$content_template_displayevent}
    {$tab_end}
{$tabs_end}

<p>Copyright &copy; 2011, VesQ <a href="mailto:laakso.vesa@gmail.com">&lt;laakso.vesa@gmail.com&gt;</a>. All Rights Are Reserved.</p>
