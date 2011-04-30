{literal}
<script>
$("a.jslink").click( function(clickEvent) {
    clickEvent.preventDefault();
    var href = $(this).attr("href");
    $.fancybox.showActivity();
    var msgObj = $(this).closest("li").find(".togglespan");
    // Let's fade out the text there already is.
    msgObj.fadeOut( 100, function() {
        msgObj.load( href,'', function() {
            $.fancybox.hideActivity();
            // And now flash the text by fading it in, out and in again.
            msgObj.fadeIn( 400, function() { 
                msgObj.fadeOut( 400, function() { 
                    msgObj.fadeIn( 400 );
                });
            });
        });
    });
});
</script>
{/literal}
<div style="background-color: #fff; padding: 10px; width: 400px;" class="displayevent_test">

<ul>
{foreach from=$users item=user}
    <li><strong>{$user->username}</strong>
        <ul>
            <li>Calendar link: <strong>{$user->cal_link}</strong></li>
            <li>Toggle {$user->toggle_in} {$user->toggle_out} <span class="togglespan">&nbsp;</span></li>
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