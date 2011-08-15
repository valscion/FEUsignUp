{strip}
{assign var=day_name value=$event.event_date_start|date_format:"%A"}
{assign var=time_start value=$event.event_date_start|date_format:"%H:%M"}
{assign var=time_end value=$event.event_date_end|date_format:"%H:%M"}
{assign var=description value="$day_name, $time_start - $time_end"}
{$description}{if ($ccuser->loggedin() && !$ccuser->memberof('pending'))} ({$signups_amount}){/if}
{/strip}