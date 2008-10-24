<?php
// Must end with a slash.
define("IMPORT_DIR", "import/");
define("QUEUE_IMPORTS", true);

if (!defined("UPLOAD_ERR_NO_TMP_DIR")) define("UPLOAD_ERR_NO_TMP_DIR", 6);
if (!defined("UPLOAD_ERR_CANT_WRITE")) define("UPLOAD_ERR_CANT_WRITE", 7);
if (!defined("UPLOAD_ERR_EXTENSION")) define("UPLOAD_ERR_EXTENSION", 8);

require_once('application.inc.php');
if (!authorized()) { exit; }

$lang['import_format'] = 'Import Format';
$lang['import_format_error'] = 'You must select an &quot;Export Format&quot;.';

$lang['import_file'] = 'Import File';
$lang['import_choose_file'] = 'Choose a file to upload';
$lang['import_file_error'] = 'You must choose a file from your computer to upload.';

$lang['import_file_error_ini_size'] = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
$lang['import_file_error_form_size'] = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
$lang['import_file_error_partial'] = 'The uploaded file was only partially uploaded.';
$lang['import_file_error_no_file'] = 'You must choose a file to be uploaded.';
$lang['import_file_error_no_tmp_dir'] = 'Missing a temporary folder.';
$lang['import_file_error_cant_write'] = 'Failed to write file to disk.';
$lang['import_file_error_extension'] = 'File upload stopped by extension.';
$lang['import_file_error_unknown'] = 'An unknown error occurred while attempting to upload the file.';

$lang['import_queue_submit'] = 'Queue Import';
$lang['import_submit'] = 'Import';

$lang['import_error_check'] = 'An error occurred while checking the uploaded file.';
$lang['import_error_move'] = 'The file could not be moved to the import queue directory. This is likely a permissions problem with the import directory. Please alert the calendar administrator.';
$lang['import_success'] = '<b>Success:</b> The file has been successfully uploaded and placed in the import queue.';

$FormSubmitted = isset($_POST['formsubmitted']);
$FormErrors = array();

// Defaults
$Form_Format = '';

if (!isset($_POST['format']) || !setVar($Form_Format,$_POST['format'],'importformat',$Form_Format)) $FormErrors['format'] = lang('import_format_error');
if (!isset($_FILES['uploadedfile'])) $FormErrors['file'] = lang('import_file_error_no_file');

if (isset($_FILES['uploadedfile']) && $_FILES['uploadedfile']['error'] != UPLOAD_ERR_OK) {
	switch($_FILES['uploadedfile']['error']) {
		case UPLOAD_ERR_INI_SIZE:
			$FormErrors['file'] = lang('import_file_error_ini_size');
			break;
		case UPLOAD_ERR_FORM_SIZE:
			$FormErrors['file'] = lang('import_file_error_form_size');
			break;
		case UPLOAD_ERR_PARTIAL:
			$FormErrors['file'] = lang('import_file_error_partial');
			break;
		case UPLOAD_ERR_NO_FILE:
			$FormErrors['file'] = lang('import_file_error_no_file');
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			$FormErrors['file'] = lang('import_file_error_no_tmp_dir');
			break;
		case UPLOAD_ERR_CANT_WRITE:
			$FormErrors['file'] = lang('import_file_error_cant_write');
			break;
		case UPLOAD_ERR_EXTENSION:
			$FormErrors['file'] = lang('import_file_error_extension');
			break;
		default:
			$FormErrors['file'] = lang('import_file_error_unknown');
			break;
	}
}

// If the form is complete, then submit the data.
if ($FormSubmitted && count($FormErrors) == 0) {

	// Move the uploaded file to the import directory.
	if (QUEUE_IMPORTS) {
		// Prefix the temp file name with the current day of the year.
		// This allows a daily script to delete any files older than X days.
		$importedFilePath = tempnam(IMPORT_DIR, sprintf('%03s', date('z')));
		
		// Verify the the file was uploaded via POST.
		if (is_uploaded_file($_FILES['uploadedfile']['tmp_name'])) {
			// Attempt to move the file.
			if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $importedFilePath)) {
				$query = "INSERT INTO ".TABLEPREFIX."vtcal_importqueue (calendarid, userid, filepath, filename, filesize, queued, format) VALUES "
					."('".sqlescape($_SESSION['CALENDAR_ID'])."', '".sqlescape($_SESSION['AUTH_USERID'])."', '".sqlescape($importedFilePath)."', '".sqlescape(basename($_FILES['uploadedfile']['name']))."', '".sqlescape($_FILES['uploadedfile']['size'])."', '".sqlescape(NOW_AS_TEXT)."', '".sqlescape($Form_Format)."')";
				$result =& DBQuery($query);
				if (is_string($result)) {
					$FormErrors['generic'] = lang('dberror_generic');
				}
				else {
					redirect2URL("importqueue.php?success=y");
				}
			}
			
			// The file could not be moved. Probably a permissions issue.
			else {
				$FormErrors['generic'] = lang('import_error_move');
			}
		}
		
		// The file stored in tmp_name is not the file that was uploaded via post.
		// This is unlikely to occur.
		else {
			$FormErrors['generic'] = lang('import_error_check');
		}
	}
	else {
		// TODO: Do the import right away.
	}
}

pageheader(lang('import_events'), "Update");
contentsection_begin(lang('import_events'));

if ($FormSubmitted && count($FormErrors) > 0) {
	?><p style="padding: 8px;"><img src="install/failed32.png" class="png" width="32" height="32" alt="" align="left"> <b><?php echo lang('export_errorsfound'); ?></b></p><?php
}

if (isset($SuccessMessage)) {
	?><p style="padding: 8px;"><img src="install/success.png" class="png" width="16" height="16" alt="" align="left">&nbsp;<?php echo $SuccessMessage; ?></p><?php
}
?>

<form enctype="multipart/form-data" action="import-new.php" method="POST">

<input type="hidden" name="MAX_FILE_SIZE" value="100000" />

	<p><b><?php echo lang('import_format'); ?>:</b></p>
	
	<blockquote>
		<?php if ($FormSubmitted && isset($FormErrors['format'])) echo '<p class="FormError"><img src="install/failed.png" class="png" width="16" height="16" alt="" align="left"> '.$FormErrors['format'].'</p>'; ?>
		<table border="0" cellpadding="2" cellspacing="0">
	    	<tr>
	    		<td><input name="format" type="radio" value="ical" id="format_ical" <?php if ($Form_Format == "ical") echo "CHECKED"; ?>></td>
	    		<td><label for="format_ical">iCalendar (ICS)</label></td>
	   		</tr>
	    	<tr>
	    		<td valign="top"><input name="format" type="radio" value="xml" id="format_xml" <?php if ($Form_Format == "xml") echo "CHECKED"; ?>></td>
	    		<td><label for="format_xml">VTCalendar (XML)</label><br/><?php echo lang('export_xml_description'); ?></td>
	   		</tr>
	    </table>
	</blockquote>

	<p><b><?php echo lang('import_file'); ?>:</b></p>
	<blockquote>
		<?php if ($FormSubmitted && isset($FormErrors['file'])) echo '<p class="FormError"><img src="install/failed.png" class="png" width="16" height="16" alt="" align="left"> '.$FormErrors['file'].'</p>'; ?>
		<p><?php echo lang('import_choose_file'); ?>: <input name="uploadedfile" type="file" /></p>
	</blockquote>
<br />

<input type="submit" name="formsubmitted" value="<?php echo (QUEUE_IMPORTS ? lang('import_queue_submit') : lang('import_submit')); ?>" />
</form>

<?php
contentsection_end();
pagefooter();
DBclose();
?>