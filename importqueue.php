<?php
define("QUEUE_IMPORTS", true);

$lang['import_queue'] = 'Event Import Queue';
$lang['import_nothing_queued'] = 'You have no queued items waiting to be imported.';

require_once('application.inc.php');
if (!authorized()) { exit; }

pageheader(lang('import_queue'), "Update");
contentsection_begin(lang('import_queue'));

$result =& DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_importqueue WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND userid='".sqlescape($_SESSION['AUTH_USERID'])."' ORDER BY queued DESC");

if (is_string($result)) {
	DBErrorBox($result);
}
else {
	if ($result->numRows() == 0) {
		echo lang('import_nothing_queued');
	}
	else {
		?>
		<p>TODO</p>
		<table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse;" bordercolor="<?php echo $_SESSION['COLOR_BORDER']; ?>">
			<tr class="TableHeaderBG">
				<td>&nbsp;</td>
				<td><b>Date/Time Queued</b></td>
				<td><b>Status</b></td>
				<td><b>Date/Time Finished</b></td>
				<td><b>Format</b></td>
				<td><b>File Name</b></td>
				<td>&nbsp;</td>
			</tr>
			<?php
			for ($i = 0; $i < $result->numRows(); $i++) {
				$record =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
				
				switch ($record['result']) {
					case 0:
						$resultMessage = "Waiting";
						break;
					case 1:
						$resultMessage = "Canceled";
						break;
					case 2:
						$resultMessage = "Running";
						break;
					case 3:
						$resultMessage = "Imported";
						break;
					case 4:
						$resultMessage = "Failed";
						break;
					default:
						$resultMessage = "Unknown";
						break;
				}
				
				echo '<tr>'
					.'<td><a href="importqueue.php?action=view&id='.urlencode($record['importid']).'">Details</a></td>'
					.'<td>'.htmlentities($record['queued']).'</td>'
					.'<td>'.htmlentities($resultMessage).'</td>'
					.'<td>'.(htmlentities($record['finished']) == '' ? '&nbsp;' : htmlentities($record['finished'])).'</td>'
					.'<td>'.htmlentities($record['format']).'</td>'
					.'<td><code>'.htmlentities($record['filename']).'</code></td>'
					//.'<td>'.htmlentities(formatBytes($record['filesize'])).'</td>'
					.'<td><a href="importqueue.php?action=delete&id='.urlencode($record['importid']).'">Cancel</a></td>'
					.'</tr>';
			}
			?>
		</table>
		<?php
	}
}
contentsection_end();
pagefooter();
DBclose();
?>