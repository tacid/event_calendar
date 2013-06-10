<?php 
$event = $vars['entity'];
if ($event->organizer) {
	$organizer = "\r\nORGANIZER;CN={$event->organizer}\r\n";
} else {
	$organizer = '';
}

if ($event->description) {
	$description = event_calendar_format_text($event->description);
} else {
	$description = '';
}
// DTSTART and DTEND should be in UTC timezone
date_default_timezone_set('UTC');
?>
BEGIN:VEVENT
UID:<?php echo elgg_get_site_url().'event_calendar/view/'.$event->guid; ?>

URL:<?php echo elgg_get_site_url().'event_calendar/view/'.$event->guid; ?>

DTSTAMP:<?php echo date("Ymd\THis\Z", $event->getTimeUpdated())?>

CREATED:<?php echo date("Ymd\THis\Z", $event->getTimeCreated())?>

LAST-MODIFIED:<?php echo date("Ymd\THis\Z", $event->getTimeUpdated())  ?>

DTSTART:<?php echo date("Ymd\THis\Z", $event->start_date);  ?>

DTEND:<?php echo date("Ymd\THis\Z", $event->real_end_time);  ?>

SUMMARY:<?php echo event_calendar_format_text($event->title);  ?>

DESCRIPTION:<?php echo $description;  ?>

LOCATION:<?php echo event_calendar_format_text($event->venue);  ?><?php echo $organizer;  ?>

<?php if(is_array($event->tags)){ ?>
CATEGORIES:<?php implode(",",$event->tags);  ?>

<?php } ?>
END:VEVENT
