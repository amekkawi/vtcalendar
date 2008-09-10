<?php
require_once('config.inc.php');
require_once('session_start.inc.php');
require_once('globalsettings.inc.php');

$database = DBCONNECTION;
if (!authorized($database)) { exit; }
if (!$_SESSION["AUTH_ADMIN"]) { exit; } // additional security

if (isset($_POST['approveallevents'])) { setVar($approveallevents,$_POST['approveallevents'],'approveallevents'); } else { unset($approveallevents); }
if (isset($_POST['eventidlist'])) { setVar($eventidlist,$_POST['eventidlist'],'eventidlist'); } else { unset($eventidlist); }
if (isset($_GET['approveall'])) { setVar($approveall,$_GET['approveall'],'approveall'); } else { unset($approveall); }
if (isset($_GET['approvethis'])) { setVar($approvethis,$_GET['approvethis'],'approvethis'); } else { unset($approvethis); }
if (isset($_GET['reject'])) { setVar($reject,$_GET['reject'],'reject'); } else { unset($reject); }
if (isset($_POST['eventid'])) { setVar($eventid,$_POST['eventid'],'eventid'); } 
else {
  if (isset($_GET['eventid'])) { setVar($eventid,$_GET['eventid'],'eventid'); } else { unset($eventid); }
}
if (isset($_POST['rejectreason'])) { setVar($rejectreason,$_POST['rejectreason'],'rejectreason'); } else { unset($rejectreason); }
if (isset($_POST['rejectconfirmedall'])) { setVar($rejectconfirmedall,$_POST['rejectconfirmedall'],'rejectconfirmedall'); } else { unset($rejectconfirmedall); }
if (isset($_POST['rejectconfirmedthis'])) { setVar($rejectconfirmedthis,$_POST['rejectconfirmedthis'],'rejectconfirmedthis'); } else { unset($rejectconfirmedthis); }

// Approve all events.
if (isset($approveallevents)) {
  $eventids=split(",",$eventidlist);
	for ($i = 0; $i < count($eventids); $i++) {
		$eventid = $eventids[$i];
		if (!empty($eventid)) {
			$result = DBQuery($database, "SELECT * FROM vtcal_event WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($eventid)."'" );
			$event = $result->fetchRow(DB_FETCHMODE_ASSOC);
			if ($event["approved"]==0) {
				//eventaddslashes($event);
				if (!empty($event['repeatid'])) {
					repeatpublicizeevent($eventid,$event,$database);
				}
				else {
					publicizeevent($eventid,$event,$database);
				}
			}
	  }
	}
  redirect2URL("approval.php");
  exit;
}

// Approve a single event.
elseif (isset($eventid)) {
  // check if event is marked as "submitted" (to avoid multiple approvals/rejections)
  $query = "SELECT * FROM vtcal_event WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($eventid)."'";
	$result = DBQuery($database, $query ); 
  $event = $result->fetchRow(DB_FETCHMODE_ASSOC);

  if ($event["approved"]==0) {

    if (isset($approvethis)) {
      // eventaddslashes($event);
      publicizeevent($eventid,$event,$database);
    }
    // approve all events with the same repeatid
    elseif (isset($approveall)) {
      repeatpublicizeevent($eventid,$event,$database);
    }
    elseif (isset($rejectconfirmedthis)) {
      $result = DBQuery($database, "UPDATE vtcal_event SET approved=-1, rejectreason='".sqlescape($rejectreason)."' WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($eventid)."'" );
      sendrejectionemail($eventid,$database);
    }
    elseif (isset($rejectconfirmedall)) {
      // determine repeatid
      $result = DBQuery($database, "UPDATE vtcal_event SET approved=-1, rejectreason='".sqlescape($rejectreason)."' WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND approved=0 AND repeatid='".sqlescape($event['repeatid'])."'" ); 
      sendrejectionemail($eventid,$database);
    }
    // ask for confirmation, reason for rejection
    elseif (isset($reject)) {
      include("reject.inc.php");
      exit;
    }
  }
  redirect2URL("approval.php");
  exit;
}

pageheader(lang('approve_reject_event_updates'),
           lang('approve_reject_event_updates'),
           "Update","",$database);

contentsection_begin(lang('approve_reject_event_updates'),true);

// print list with events
$query = "SELECT e.id AS id,e.approved,e.timebegin,e.timeend,e.repeatid,e.sponsorid,e.displayedsponsor,e.displayedsponsorurl,e.title,e.wholedayevent,e.categoryid,e.description,e.location,e.price,e.contact_name,e.contact_phone,e.contact_email,e.url,c.id AS cid,c.name AS category_name,s.id AS sid,s.name AS sponsor_name,s.calendarid AS sponsor_calendarid,s.url AS sponsor_url,s.calendarid AS sponsor_calendarid, e.showondefaultcal as showondefaultcal, e.showincategory as showincategory";
$query.= " FROM vtcal_event e, vtcal_category c, vtcal_sponsor s";
$query.= " WHERE e.calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND c.calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND e.categoryid = c.id AND e.sponsorid = s.id AND e.approved = 0";
$query.= " ORDER BY e.timebegin asc, e.wholedayevent DESC";
$result = DBQuery($database, $query ); 

echo "<div>&nbsp;</div>";

if ($result->numRows() == 0 ) {
	echo "There are no events currently awaiting approval.";
}
else {
	?>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="margin: 0; padding: 0;">
		<INPUT type="submit" name="approveallevents" value="<?php echo lang('approve_all_events'); ?>">
		<input type="hidden" name="eventidlist" value="<?php
		  // read first event if one exists
		  $ievent = 0;
		  while ($ievent < $result->numRows()) {
		    if ( $ievent > 0 ) { echo ","; }
		  	$event = $result->fetchRow(DB_FETCHMODE_ASSOC, $ievent);
			  echo htmlentities($event["id"]);
		  	$ievent++;
		  }
			?>">
	</form>
	
	<?php
	$defaultcalendarname = getCalendarName($database, 'default');
	
	// Loop through all the events waiting for approval
  for ($i=0; $i<$result->numRows(); $i++) {
    $event = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
    disassemble_eventtime($event);
		
		// Keep track of repeat IDs so we only output repeating events once.
  	if (!empty($event['repeatid']) ) { 
		  if ( isset($recurring_exists) && array_key_exists($event['repeatid'],$recurring_exists) ) {
		  	// Skip to the next event if this event is repeating and has already been outputted.
		  	continue;
		  }
			else { 
			  // Remember this recurring event so we only add it once.
				$recurring_exists[$event['repeatid']] = $event['repeatid']; 
			}
		}

		?>
		<div>&nbsp;</div>
		<div style="padding-bottom: 2px;"><b style="font-size: 18px; font-weight: normal;"><?php
			echo Day_of_Week_to_Text(Day_of_Week($event['timebegin_month'],$event['timebegin_day'],$event['timebegin_year']));
		  echo ", ";
		  echo Month_to_Text($event['timebegin_month'])," ",$event['timebegin_day'],", ",$event['timebegin_year'];
		  ?></b><?php
		  
		  // Output details about how the event repeats, if it is a repeating event.
		  if (!empty($event['repeatid'])) {
				echo "<br>\n";
				echo '<font color="#00AA00">';
				readinrepeat($event['repeatid'],$event,$repeat,$database);
				$repeatdef = repeatinput2repeatdef($event,$repeat);
				printrecurrence($event['timebegin_year'],
												$event['timebegin_month'],
												$event['timebegin_day'],
												$repeatdef);
				echo '</font>';
			}
			
			// Note that the event will also be submitted to the default calendar.
			if ($_SESSION['CALENDARID'] != "default" && $event['showondefaultcal'] == 1) {
				echo "<br>\n",'<font color="#CC0000"><b>Note:</b> This event will also be submitted to the &quot;'.htmlentities($defaultcalendarname).'&quot; calendar under the &quot;'.htmlentities(getCategoryName($database,$event['showincategory'])).'&quot; category.</font>';
			}
		  ?></div>
		<table border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td style="background-color: #E3E3E3; border: 1px solid #666666; padding: 5px;">
					<div><b>Submitted by: </b><?php echo htmlentities($event['sponsor_name']); ?><?php
					if ($_SESSION['CALENDARID'] == "default" && $event['sponsor_calendarid'] != "default") {
						echo ' <font color=#CC0000">(from the &quot;'.htmlentities(getCalendarName($database,$event['sponsor_calendarid'])).'&quot; calendar)</font>';
					}
					?>
					</div>
					<div style="padding-top: 5px; padding-bottom: 5px;"><?php adminButtons($event, array('approve','reject','edit'), "small", "horizontal"); ?></div>
					<div style="border: 0 solid #666666;"><?php print_event($event, false); ?></div>
				</td>
			</tr>
		</table>
		<?php
  }
}
contentsection_end();
require("footer.inc.php");
DBclose($database);
  
function sendrejectionemail($eventid,$database) {
  // determine sponsor id, name
  $query = "SELECT e.title AS event_title, e.rejectreason AS event_rejectreason, s.name AS sponsor_name, s.email AS sponsor_email, s.id AS sponsorid FROM vtcal_event e, vtcal_sponsor s WHERE e.calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND e.sponsorid=s.id AND e.id='".sqlescape($eventid)."'";
  $result = DBQuery($database, $query ); 
  $d = $result->fetchRow(DB_FETCHMODE_ASSOC);
  
  $subject = lang('email_submitted_event_rejected');
  $body = lang('email_admin_rejected_event')."\n";
  $body.= $d['event_title']."\n\n";
  $body.= lang('email_reason_for_rejection')."\n";
  $body.= $d['event_rejectreason']."\n\n";
  $body.= lang('email_login_edit_resubmit');

	/* taken out because it would need to be adapted to work for the calendar forwarding
	   feature which it currently does not. also, rejection is extremely rarely used.
		$body.= "You can update the information for this particular event by clicking here:\n";
		if ( isset($_SERVER["HTTPS"]) ) { $body .= "https"; } else { $body .= "http"; } 
		$body.= "://".$_SERVER['HTTP_HOST'].substr($_SERVER['SCRIPT_NAME'],0,strrpos($_SERVER['SCRIPT_NAME'], "/"))."/";
		$body.= "changeeinfo.php?calendarid=".$_SESSION["CALENDARID"];
		$body.= "&authsponsorid=".$d['sponsorid'];
		$body.= "&eventid=$eventid&httpreferer=update.php";
	*/
	
  sendemail2sponsor($d['sponsor_name'],$d['sponsor_email'],$subject,$body);
} // end: function sendrejectionemail
?>