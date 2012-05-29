<?php
elgg_load_js('elgg.full_calendar');
elgg_load_js('lightbox');
elgg_load_css('lightbox');

// TODO: is there an easy way to avoid embedding JS?
?>
<script>

handleEventClick = function(event) {
    if (event.url) {
        //window.location.href = event.url;
        $.fancybox({'href':event.url});
        return false;
    }
};

handleEventDrop = function(event,dayDelta,minuteDelta,allDay,revertFunc) {

    if (!confirm("<?php echo elgg_echo('event_calendar:are_you_sure'); ?>")) {
        revertFunc();
    } else {
    	elgg.action('event_calendar/modify_full_calendar',
    		{
    			data: {event_guid: event.guid,dayDelta: dayDelta, minuteDelta: minuteDelta},
    			success: function (res) {
    				var success = res.success;
    				var msg = res.message;
    				if (!success) {
    					elgg.register_error(msg,2000);
    					revertFunc()
    				}
    			}
    		}
    	);
    }
};

getISODate = function(d) {
	var year = d.getFullYear();
	var month = d.getMonth()+1;
	month =	month < 10 ? '0' + month : month;
	var day = d.getDate();
	day = day < 10 ? '0' + day : day;
	return year +"-"+month+"-"+day;
}

handleGetEvents = function(start, end, callback) {	
	var start_date = getISODate(start);
	var end_date = getISODate(end);
	var url = "event_calendar/get_fullcalendar_events/"+start_date+"/"+end_date+"/<?php echo $vars['filter']; ?>/<?php echo $vars['group_guid']; ?>";
	elgg.getJSON(url, {success: 
		function(events) {
			callback(events);
		}
	});
}

$(document).ready(function() {	
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		month: <?php echo date('n',strtotime($vars['start_date']))-1; ?>,
		ignoreTimezone: true,
		editable: true,
		slotMinutes: 15,
		eventDrop: handleEventDrop,
		eventClick: handleEventClick,
		events: handleGetEvents
	});
});
</script>
<div id='calendar'></div>
