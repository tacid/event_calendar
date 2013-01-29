<?php

/**
 * Elgg event calendar widget
 *
 * @package event_calendar
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Kevin Jardine <kevin@radagast.biz>
 * @copyright Radagast Solutions 2008
 * @link http://radagast.biz/
 *
 */

	// Load event calendar model
	elgg_load_library('elgg:event_calendar');

    //the number of events to display
	$num = (int) $vars['entity']->num_display;
	if (!$num)
		$num = 5;
		
    // Get the events
#<<<<<<< HEAD

        if(!$vars['entity']->events_type or $vars['entity']->events_type == 'personal_events') {
            if($vars['entity']->context == 'index') {
                $events = event_calendar_get_personal_events_for_user(elgg_get_logged_in_user_guid(),$num);
            } else {
                $events = event_calendar_get_personal_events_for_user(elgg_get_page_owner_guid(),$num);
            }

        } else {
            $now = time(); $day = 60*60*24;
            $events=[];
            foreach(event_calendar_get_events_between($now,$now+3650*$day,false,$num) as $event) { $events[] = $event['event']; }
        }
#=======
#  $owner = elgg_get_page_owner_entity();
#  if(elgg_instanceof($owner, 'group')) {
#    $events = event_calendar_get_events_for_group(elgg_get_page_owner_guid(),$num);
#  } else {
#    $events = event_calendar_get_personal_events_for_user(elgg_get_page_owner_guid(),$num);
#  }
#>>>>>>> 39bca929f875ca6e9bd422b112d1e48b717fa126
		
	// If there are any events to view, view them
	if (is_array($events) && sizeof($events) > 0) {

		echo "<div id=\"widget_calendar\">";

		foreach($events as $event) {
			echo elgg_view("object/event_calendar",array('entity' => $event));
		}

		echo "</div>";
			
    }
	
?>
