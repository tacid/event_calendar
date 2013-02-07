<?php
/**
 * Elgg ICAL output pageshell
 *
 * @package Elgg
 * @subpackage Core
 *
 */

header("Content-Type: text/calendar; charset=UTF-8");
header("Content-Disposition: inline; filename=\"calendar.ics\"");
?>
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Curverider Ltd//NONSGML Elgg <?php echo get_version(true); ?>//EN
<?php echo $vars['body']; ?>
END:VCALENDAR
