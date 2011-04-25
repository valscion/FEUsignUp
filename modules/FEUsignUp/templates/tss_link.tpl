{assign var=month value=$match.date|date_format:"%m"|regex_replace:"/0([1-9])/":"\\1"}
{$match.hometeam} - {$match.visitorteam}<br />
{$match.date|date_format:"%a %e."}{$month}. klo {$match.date|date_format:"%H:%M"}