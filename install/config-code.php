<?php
if (!defined("ALLOWINCLUDES")) exit;

// Default Form Values
$Form_TITLEPREFIX = '';
$Form_TITLESUFFIX = '';
$Form_LANGUAGE = 'en';
$Form_ALLOWED_YEARS_AHEAD = '3';
$Form_DATABASE = '';
$Form_SCHEMANAME = '';
$Form_SQLLOGFILE = '';
$Form_REGEXVALIDUSERID = '/^[A-Za-z][\\._A-Za-z0-9\\-\\\\]{1,49}$/';
$Form_AUTH_DB = true;
$Form_AUTH_DB_USER_PREFIX = '';
$Form_AUTH_DB_NOTICE = '';
$Form_AUTH_LDAP = false;
$Form_LDAP_CHECK = true;
$Form_LDAP_HOST = '';
$Form_LDAP_PORT = '389';
$Form_LDAP_USERFIELD = '';
$Form_LDAP_BASE_DN = '';
$Form_LDAP_SEARCH_FILTER = '';
$Form_LDAP_BIND = false;
$Form_LDAP_BIND_USER = '';
$Form_LDAP_BIND_PASSWORD = '';
$Form_AUTH_HTTP = false;
$Form_AUTH_HTTP_URL = '';
$Form_BASEPATH = '';
$Form_BASEDOMAIN = '';
$Form_BASEURL = '';
$Form_SECUREBASEURL = '';
$Form_TIMEZONE = '';
$Form_WEEK_STARTING_DAY = '0';
$Form_USE_AMPM = true;
$Form_COLUMNSIDE = 'RIGHT';
$Form_SHOW_UPCOMING_TAB = true;
$Form_MAX_UPCOMING_EVENTS = '75';
$Form_SHOW_MONTH_OVERLAP = true;
$Form_COMBINED_JUMPTO = true;
$Form_CUSTOM_LOGIN_HTML = false;
$Form_INCLUDE_STATIC_PRE_HEADER = false;
$Form_INCLUDE_STATIC_POST_HEADER = false;
$Form_INCLUDE_STATIC_PRE_FOOTER = false;
$Form_INCLUDE_STATIC_POST_FOOTER = false;
$Form_MAX_CACHESIZE_CATEGORYNAME = '100';
$Form_CACHE_SUBSCRIBE_LINKS = false;
$Form_CACHE_SUBSCRIBE_LINKS_PATH = 'cache/subscribe/';
$Form_CACHE_SUBSCRIBE_LINKS_OUTPUTDIR = '';
$Form_EXPORT_PATH = 'export/export.php';
$Form_MAX_EXPORT_EVENTS = '100';
$Form_EXPORT_CACHE_MINUTES = '5';
$Form_PUBLIC_EXPORT_VTCALXML = false;
$Form_EMAIL_USEPEAR = false;
$Form_EMAIL_SMTP_HOST = 'localhost';
$Form_EMAIL_SMTP_PORT = '25';
$Form_EMAIL_SMTP_AUTH = false;
$Form_EMAIL_SMTP_USERNAME = '';
$Form_EMAIL_SMTP_PASSWORD = '';
$Form_EMAIL_SMTP_HELO = 'localhost';
$Form_EMAIL_SMTP_TIMEOUT = '0';

// Load Submitted Form Values
if (isset($_POST['SaveConfig'])) {
	setVar($Form_TITLEPREFIX,$_POST['TITLEPREFIX']);
	setVar($Form_TITLESUFFIX,$_POST['TITLESUFFIX']);
	setVar($Form_LANGUAGE,$_POST['LANGUAGE']);
	setVar($Form_ALLOWED_YEARS_AHEAD,$_POST['ALLOWED_YEARS_AHEAD']);
	setVar($Form_DATABASE,$_POST['DATABASE']);
	setVar($Form_SCHEMANAME,$_POST['SCHEMANAME']);
	setVar($Form_SQLLOGFILE,$_POST['SQLLOGFILE']);
	setVar($Form_REGEXVALIDUSERID,$_POST['REGEXVALIDUSERID']);
	$Form_AUTH_DB = isset($_POST['AUTH_DB']);
	if ($Form_AUTH_DB) {
		setVar($Form_AUTH_DB_USER_PREFIX,$_POST['AUTH_DB_USER_PREFIX']);
		setVar($Form_AUTH_DB_NOTICE,$_POST['AUTH_DB_NOTICE']);
	}
	$Form_AUTH_LDAP = isset($_POST['AUTH_LDAP']);
	if ($Form_AUTH_LDAP) {
		$Form_LDAP_CHECK = isset($_POST['LDAP_CHECK']);
		setVar($Form_LDAP_HOST,$_POST['LDAP_HOST']);
		setVar($Form_LDAP_PORT,$_POST['LDAP_PORT']);
		setVar($Form_LDAP_USERFIELD,$_POST['LDAP_USERFIELD']);
		setVar($Form_LDAP_BASE_DN,$_POST['LDAP_BASE_DN']);
		setVar($Form_LDAP_SEARCH_FILTER,$_POST['LDAP_SEARCH_FILTER']);
		$Form_LDAP_BIND = isset($_POST['LDAP_BIND']);
		if ($Form_LDAP_BIND) {
			setVar($Form_LDAP_BIND_USER,$_POST['LDAP_BIND_USER']);
			setVar($Form_LDAP_BIND_PASSWORD,$_POST['LDAP_BIND_PASSWORD']);
		}
	}
	$Form_AUTH_HTTP = isset($_POST['AUTH_HTTP']);
	if ($Form_AUTH_HTTP) {
		setVar($Form_AUTH_HTTP_URL,$_POST['AUTH_HTTP_URL']);
	}
	setVar($Form_BASEPATH,$_POST['BASEPATH']);
	setVar($Form_BASEDOMAIN,$_POST['BASEDOMAIN']);
	setVar($Form_BASEURL,$_POST['BASEURL']);
	setVar($Form_SECUREBASEURL,$_POST['SECUREBASEURL']);
	setVar($Form_TIMEZONE,$_POST['TIMEZONE']);
	setVar($Form_WEEK_STARTING_DAY,$_POST['WEEK_STARTING_DAY']);
	$Form_USE_AMPM = isset($_POST['USE_AMPM']);
	setVar($Form_COLUMNSIDE,$_POST['COLUMNSIDE']);
	$Form_SHOW_UPCOMING_TAB = isset($_POST['SHOW_UPCOMING_TAB']);
	if ($Form_SHOW_UPCOMING_TAB) {
		setVar($Form_MAX_UPCOMING_EVENTS,$_POST['MAX_UPCOMING_EVENTS']);
	}
	$Form_SHOW_MONTH_OVERLAP = isset($_POST['SHOW_MONTH_OVERLAP']);
	$Form_COMBINED_JUMPTO = isset($_POST['COMBINED_JUMPTO']);
	$Form_CUSTOM_LOGIN_HTML = isset($_POST['CUSTOM_LOGIN_HTML']);
	$Form_INCLUDE_STATIC_PRE_HEADER = isset($_POST['INCLUDE_STATIC_PRE_HEADER']);
	$Form_INCLUDE_STATIC_POST_HEADER = isset($_POST['INCLUDE_STATIC_POST_HEADER']);
	$Form_INCLUDE_STATIC_PRE_FOOTER = isset($_POST['INCLUDE_STATIC_PRE_FOOTER']);
	$Form_INCLUDE_STATIC_POST_FOOTER = isset($_POST['INCLUDE_STATIC_POST_FOOTER']);
	setVar($Form_MAX_CACHESIZE_CATEGORYNAME,$_POST['MAX_CACHESIZE_CATEGORYNAME']);
	$Form_CACHE_SUBSCRIBE_LINKS = isset($_POST['CACHE_SUBSCRIBE_LINKS']);
	if ($Form_CACHE_SUBSCRIBE_LINKS) {
		setVar($Form_CACHE_SUBSCRIBE_LINKS_PATH,$_POST['CACHE_SUBSCRIBE_LINKS_PATH']);
		setVar($Form_CACHE_SUBSCRIBE_LINKS_OUTPUTDIR,$_POST['CACHE_SUBSCRIBE_LINKS_OUTPUTDIR']);
	}
	setVar($Form_EXPORT_PATH,$_POST['EXPORT_PATH']);
	setVar($Form_MAX_EXPORT_EVENTS,$_POST['MAX_EXPORT_EVENTS']);
	setVar($Form_EXPORT_CACHE_MINUTES,$_POST['EXPORT_CACHE_MINUTES']);
	$Form_PUBLIC_EXPORT_VTCALXML = isset($_POST['PUBLIC_EXPORT_VTCALXML']);
	$Form_EMAIL_USEPEAR = isset($_POST['EMAIL_USEPEAR']);
	if ($Form_EMAIL_USEPEAR) {
		setVar($Form_EMAIL_SMTP_HOST,$_POST['EMAIL_SMTP_HOST']);
		setVar($Form_EMAIL_SMTP_PORT,$_POST['EMAIL_SMTP_PORT']);
		$Form_EMAIL_SMTP_AUTH = isset($_POST['EMAIL_SMTP_AUTH']);
		if ($Form_EMAIL_SMTP_AUTH) {
			setVar($Form_EMAIL_SMTP_USERNAME,$_POST['EMAIL_SMTP_USERNAME']);
			setVar($Form_EMAIL_SMTP_PASSWORD,$_POST['EMAIL_SMTP_PASSWORD']);
		}
		setVar($Form_EMAIL_SMTP_HELO,$_POST['EMAIL_SMTP_HELO']);
		setVar($Form_EMAIL_SMTP_TIMEOUT,$_POST['EMAIL_SMTP_TIMEOUT']);
	}
}

// Build Code for config.inc.php
function BuildOutput(&$ConfigOutput) {
	// Output Title Prefix
	$ConfigOutput .= '// Config: Title Prefix'."\n";
	$ConfigOutput .= '// OPTIONAL. Added at the beginning of the <title> tag.'."\n";
	$ConfigOutput .= 'define("TITLEPREFIX", \''. escapephpstring($GLOBALS['Form_TITLEPREFIX']) .'\');'."\n\n";

	// Output Title Suffix
	$ConfigOutput .= '// Config: Title Suffix'."\n";
	$ConfigOutput .= '// Example: " - My University"'."\n";
	$ConfigOutput .= '// OPTIONAL. Added at the end of the <title> tag.'."\n";
	$ConfigOutput .= 'define("TITLESUFFIX", \''. escapephpstring($GLOBALS['Form_TITLESUFFIX']) .'\');'."\n\n";

	// Output Language
	$ConfigOutput .= '// Config: Language'."\n";
	$ConfigOutput .= '// Example: en (English), de (German), sv (Swedish)'."\n";
	$ConfigOutput .= '// Default: en'."\n";
	$ConfigOutput .= '// Language used (refers to language file in directory /languages)'."\n";
	$ConfigOutput .= 'define("LANGUAGE", \''. escapephpstring($GLOBALS['Form_LANGUAGE']) .'\');'."\n\n";

	// Output Max Year Ahead for New Events
	$ConfigOutput .= '// Config: Max Year Ahead for New Events'."\n";
	$ConfigOutput .= '// Default: 3'."\n";
	$ConfigOutput .= '// The number of years into the future that the calendar will allow users to create events for.'."\n";
	$ConfigOutput .= '// For example, if the current year is 2000 then a value of \'3\' will allow users to create events up to 2003.'."\n";
	$ConfigOutput .= 'define("ALLOWED_YEARS_AHEAD", \''. escapephpstring($GLOBALS['Form_ALLOWED_YEARS_AHEAD']) .'\');'."\n\n";

	// Output Database Connection String
	$ConfigOutput .= '// Config: Database Connection String'."\n";
	$ConfigOutput .= '// Example: mysql://vtcal:abc123@localhost/vtcalendar'."\n";
	$ConfigOutput .= '// This is the database connection string used by the PEAR library.'."\n";
	$ConfigOutput .= '// It has the format: "mysql://user:password@host/databasename" or "pgsql://user:password@host/databasename"'."\n";
	$ConfigOutput .= 'define("DATABASE", \''. escapephpstring($GLOBALS['Form_DATABASE']) .'\');'."\n\n";

	// Output Schema Name
	$ConfigOutput .= '// Config: Schema Name'."\n";
	$ConfigOutput .= '// Example: public'."\n";
	$ConfigOutput .= '// In some databases (such as PostgreSQL) you may have multiple sets of VTCalendar tables within the same database, but in different schemas.'."\n";
	$ConfigOutput .= '// If this is the case for you, enter the name of the schema here.'."\n";
	$ConfigOutput .= '// It will be prefixed to the table name like so: SCHEMANAME.vtcal_calendars.'."\n";
	$ConfigOutput .= '// If necessary quote the schema name using a backtick (`) for MySQL or double quotes (") for PostgreSQL.'."\n";
	$ConfigOutput .= '// Note: If specified, the table prefix MUST end with a period.'."\n";
	$ConfigOutput .= 'define("SCHEMANAME", \''. escapephpstring($GLOBALS['Form_SCHEMANAME']) .'\');'."\n\n";

	// Output SQL Log File
	$ConfigOutput .= '// Config: SQL Log File'."\n";
	$ConfigOutput .= '// Example: /var/log/vtcalendarsql.log'."\n";
	$ConfigOutput .= '// OPTIONAL. Put a name of a (folder and) file where the calendar logs every SQL query to the database.'."\n";
	$ConfigOutput .= '// This is good for debugging but make sure you write into a file that\'s not readable by the webserver or else you may expose private information.'."\n";
	$ConfigOutput .= '// If left blank ("") no log will be kept. That\'s the default.'."\n";
	$ConfigOutput .= 'define("SQLLOGFILE", \''. escapephpstring($GLOBALS['Form_SQLLOGFILE']) .'\');'."\n\n";

	// Output User ID Regular Expression
	$ConfigOutput .= '// Config: User ID Regular Expression'."\n";
	$ConfigOutput .= '// Default: /^[A-Za-z][\\._A-Za-z0-9\\-\\\\]{1,49}$/'."\n";
	$ConfigOutput .= '// This regular expression defines what is considered a valid user-ID.'."\n";
	$ConfigOutput .= 'define("REGEXVALIDUSERID", \''. escapephpstring($GLOBALS['Form_REGEXVALIDUSERID']) .'\');'."\n\n";

	// Output Database Authentication
	$ConfigOutput .= '// Config: Database Authentication'."\n";
	$ConfigOutput .= '// Default: true'."\n";
	$ConfigOutput .= '// Authenticate users against the database.'."\n";
	$ConfigOutput .= '// If enabled, this is always performed before any other authentication.'."\n";
	$ConfigOutput .= 'define("AUTH_DB", ' . ($GLOBALS['Form_AUTH_DB'] ? 'true' : 'false') .');'."\n\n";

	// Output Prefix for Database Usernames
	$ConfigOutput .= '// Config: Prefix for Database Usernames'."\n";
	$ConfigOutput .= '// Example: db_'."\n";
	$ConfigOutput .= '// OPTIONAL. This prefix is used when creating/editing a local user-ID (in the DB "user" table), e.g. "calendar."'."\n";
	$ConfigOutput .= '// If you only use auth_db just leave it an empty string.'."\n";
	$ConfigOutput .= '// Its purpose is to avoid name-space conflicts with the users authenticated via LDAP or HTTP.'."\n";
	$ConfigOutput .= 'define("AUTH_DB_USER_PREFIX", \''. escapephpstring($GLOBALS['Form_AUTH_DB_USER_PREFIX']) .'\');'."\n\n";

	// Output Database Authentication Notice
	$ConfigOutput .= '// Config: Database Authentication Notice'."\n";
	$ConfigOutput .= '// OPTIONAL. This displays a text (or nothing) on the Update tab behind the user user management options.'."\n";
	$ConfigOutput .= '// It could be used if you employ both, AUTH_DB and AUTH_LDAP at the same time to let users know that they should create local users only if they are not in the LDAP.'."\n";
	$ConfigOutput .= 'define("AUTH_DB_NOTICE", \''. escapephpstring($GLOBALS['Form_AUTH_DB_NOTICE']) .'\');'."\n\n";

	// Output LDAP Authentication
	$ConfigOutput .= '// Config: LDAP Authentication'."\n";
	$ConfigOutput .= '// Default: false'."\n";
	$ConfigOutput .= '// Authenticate users against a LDAP server.'."\n";
	$ConfigOutput .= '// If enabled, HTTP authenticate will be ignored.'."\n";
	$ConfigOutput .= 'define("AUTH_LDAP", ' . ($GLOBALS['Form_AUTH_LDAP'] ? 'true' : 'false') .');'."\n\n";

	// Output LDAP Host Name
	$ConfigOutput .= '// Config: LDAP Host Name'."\n";
	$ConfigOutput .= '// Example: directory.myuniversity.edu or ldap://directory.myuniversity.edu/ or ldaps://secure-directory.myuniversity.edu/'."\n";
	$ConfigOutput .= '// If you are using OpenLDAP 2.x.x you can specify a URL (\'ldap://host/\') instead of the hostname (\'host\').'."\n";
	$ConfigOutput .= 'define("LDAP_HOST", \''. escapephpstring($GLOBALS['Form_LDAP_HOST']) .'\');'."\n\n";

	// Output LDAP Port
	$ConfigOutput .= '// Config: LDAP Port'."\n";
	$ConfigOutput .= '// Default: 389'."\n";
	$ConfigOutput .= '// The port to connect to. Ignored if LDAP Host Name is a URL.'."\n";
	$ConfigOutput .= 'define("LDAP_PORT", \''. escapephpstring($GLOBALS['Form_LDAP_PORT']) .'\');'."\n\n";

	// Output LDAP Username Attribute
	$ConfigOutput .= '// Config: LDAP Username Attribute'."\n";
	$ConfigOutput .= '// Example: sAMAccountName'."\n";
	$ConfigOutput .= '// The attribute which contains the username.'."\n";
	$ConfigOutput .= 'define("LDAP_USERFIELD", \''. escapephpstring($GLOBALS['Form_LDAP_USERFIELD']) .'\');'."\n\n";

	// Output LDAP Base DN
	$ConfigOutput .= '// Config: LDAP Base DN'."\n";
	$ConfigOutput .= '// Example: DC=myuniversity,DC=edu'."\n";
	$ConfigOutput .= 'define("LDAP_BASE_DN", \''. escapephpstring($GLOBALS['Form_LDAP_BASE_DN']) .'\');'."\n\n";

	// Output Additional LDAP Search Filter
	$ConfigOutput .= '// Config: Additional LDAP Search Filter'."\n";
	$ConfigOutput .= '// Example: (objectClass=person)'."\n";
	$ConfigOutput .= '// OPTIONAL. A filter to add to the LDAP search.'."\n";
	$ConfigOutput .= 'define("LDAP_SEARCH_FILTER", \''. escapephpstring($GLOBALS['Form_LDAP_SEARCH_FILTER']) .'\');'."\n\n";

	// Output LDAP Username
	$ConfigOutput .= '// Config: LDAP Username'."\n";
	$ConfigOutput .= '// Before authenticating the user, we first check if the username exists.'."\n";
	$ConfigOutput .= '// If your LDAP server does not allow anonymous connections, specific a username here.'."\n";
	$ConfigOutput .= '// Leave this blank to connect anonymously.'."\n";
	$ConfigOutput .= 'define("LDAP_BIND_USER", \''. escapephpstring($GLOBALS['Form_LDAP_BIND_USER']) .'\');'."\n\n";

	// Output LDAP Password
	$ConfigOutput .= '// Config: LDAP Password'."\n";
	$ConfigOutput .= '// If you specified LDAP_BIND_USER you must also enter a password here.'."\n";
	$ConfigOutput .= 'define("LDAP_BIND_PASSWORD", \''. escapephpstring($GLOBALS['Form_LDAP_BIND_PASSWORD']) .'\');'."\n\n";

	// Output HTTP Authentication
	$ConfigOutput .= '// Config: HTTP Authentication'."\n";
	$ConfigOutput .= '// Default: false'."\n";
	$ConfigOutput .= '// Authenticate users by sending an HTTP request to a server.'."\n";
	$ConfigOutput .= '// A HTTP status code of 200 will authorize the user. Otherwise, they will not be authorized.'."\n";
	$ConfigOutput .= '// If LDAP authentication is enabled, this will be ignored.'."\n";
	$ConfigOutput .= 'define("AUTH_HTTP", ' . ($GLOBALS['Form_AUTH_HTTP'] ? 'true' : 'false') .');'."\n\n";

	// Output HTTP Authorizaton URL
	$ConfigOutput .= '// Config: HTTP Authorizaton URL'."\n";
	$ConfigOutput .= '// Example: http://localhost/customauth.php'."\n";
	$ConfigOutput .= '// The URL to use for the BASIC HTTP Authentication.'."\n";
	$ConfigOutput .= 'define("AUTH_HTTP_URL", \''. escapephpstring($GLOBALS['Form_AUTH_HTTP_URL']) .'\');'."\n\n";

	// Output Cookie Path
	$ConfigOutput .= '// Config: Cookie Path'."\n";
	$ConfigOutput .= '// Example: /calendar/'."\n";
	$ConfigOutput .= '// OPTIONAL. If you are hosting more than one VTCalendar on your server, you may want to set this to this calendar\'s path.'."\n";
	$ConfigOutput .= '// Otherwise, the cookie will be submitted with a default path.'."\n";
	$ConfigOutput .= '// This must start and end with a forward slash (/), unless the it is exactly "/".'."\n";
	$ConfigOutput .= 'define("BASEPATH", \''. escapephpstring($GLOBALS['Form_BASEPATH']) .'\');'."\n\n";

	// Output Cookie Host Name
	$ConfigOutput .= '// Config: Cookie Host Name'."\n";
	$ConfigOutput .= '// Example: localhost'."\n";
	$ConfigOutput .= '// OPTIONAL. If you are hosting more than one VTCalendar on your server, you may want to set this to your server\'s host name.'."\n";
	$ConfigOutput .= '// Otherwise, the cookie will be submitted with a default host name.'."\n";
	$ConfigOutput .= 'define("BASEDOMAIN", \''. escapephpstring($GLOBALS['Form_BASEDOMAIN']) .'\');'."\n\n";

	// Output Calendar Base URL
	$ConfigOutput .= '// Config: Calendar Base URL'."\n";
	$ConfigOutput .= '// Example: http://localhost/calendar/'."\n";
	$ConfigOutput .= '// This is the absolute URL where your calendar software is located.'."\n";
	$ConfigOutput .= '// This MUST end with a slash "/"'."\n";
	$ConfigOutput .= 'define("BASEURL", \''. escapephpstring($GLOBALS['Form_BASEURL']) .'\');'."\n\n";

	// Output Secure Calendar Base URL
	$ConfigOutput .= '// Config: Secure Calendar Base URL'."\n";
	$ConfigOutput .= '// Example: https://localhost/calendar/'."\n";
	$ConfigOutput .= '// Default: '."\n";
	$ConfigOutput .= '// This is the absolute path where the secure version of the calendar is located.'."\n";
	$ConfigOutput .= '// If you are not using URL, set this to the same address as BASEURL.'."\n";
	$ConfigOutput .= '// This MUST end with a slash "/"'."\n";
	$ConfigOutput .= 'define("SECUREBASEURL", \''. escapephpstring($GLOBALS['Form_SECUREBASEURL']) .'\');'."\n\n";

	// Output Timezone
	$ConfigOutput .= '// Config: Timezone'."\n";
	$ConfigOutput .= '// Example: America/New_York'."\n";
	$ConfigOutput .= '// Default: '."\n";
	$ConfigOutput .= '// The timezone in which the calendar will set the local time for. All new events, logs, etc will be affected by this setting.'."\n";
	$ConfigOutput .= '// For a list of supported timezone identifiers see http://us.php.net/manual/en/timezones.php'."\n";
	$ConfigOutput .= 'define("TIMEZONE", \''. escapephpstring($GLOBALS['Form_TIMEZONE']) .'\');'."\n\n";

	// Output Week Starting Day
	$ConfigOutput .= '// Config: Week Starting Day'."\n";
	$ConfigOutput .= '// Default: 0'."\n";
	$ConfigOutput .= '// Defines the week starting day'."\n";
	$ConfigOutput .= '// Allowable values - 0 for "Sunday" or 1 for "Monday"'."\n";
	$ConfigOutput .= 'define("WEEK_STARTING_DAY", \''. escapephpstring($GLOBALS['Form_WEEK_STARTING_DAY']) .'\');'."\n\n";

	// Output Use AM/PM
	$ConfigOutput .= '// Config: Use AM/PM'."\n";
	$ConfigOutput .= '// Default: true'."\n";
	$ConfigOutput .= '// Defines time format e.g. 1am-11pm (true) or 1:00-23:00 (false)'."\n";
	$ConfigOutput .= 'define("USE_AMPM", ' . ($GLOBALS['Form_USE_AMPM'] ? 'true' : 'false') .');'."\n\n";

	// Output Column Position
	$ConfigOutput .= '// Config: Column Position'."\n";
	$ConfigOutput .= '// Default: RIGHT'."\n";
	$ConfigOutput .= '// Which side the little calendar, \'jump to\', \'today is\', etc. will be on.'."\n";
	$ConfigOutput .= '// RIGHT is more user friendly for users with low resolutions.'."\n";
	$ConfigOutput .= '// Values must be LEFT or RIGHT.'."\n";
	$ConfigOutput .= 'define("COLUMNSIDE", \''. escapephpstring($GLOBALS['Form_COLUMNSIDE']) .'\');'."\n\n";

	// Output Show Upcoming Tab
	$ConfigOutput .= '// Config: Show Upcoming Tab'."\n";
	$ConfigOutput .= '// Default: true'."\n";
	$ConfigOutput .= '// Whether or not the upcoming tab will be shown.'."\n";
	$ConfigOutput .= 'define("SHOW_UPCOMING_TAB", ' . ($GLOBALS['Form_SHOW_UPCOMING_TAB'] ? 'true' : 'false') .');'."\n\n";

	// Output Max Upcoming Events
	$ConfigOutput .= '// Config: Max Upcoming Events'."\n";
	$ConfigOutput .= '// Default: 75'."\n";
	$ConfigOutput .= '// The maximum number of upcoming events displayed.'."\n";
	$ConfigOutput .= 'define("MAX_UPCOMING_EVENTS", \''. escapephpstring($GLOBALS['Form_MAX_UPCOMING_EVENTS']) .'\');'."\n\n";

	// Output Show Month Overlap
	$ConfigOutput .= '// Config: Show Month Overlap'."\n";
	$ConfigOutput .= '// Default: true'."\n";
	$ConfigOutput .= '// Whether or not events in month view on days that are not actually part of the current month should be shown.'."\n";
	$ConfigOutput .= '// For example, if the first day of the month starts on a Wednesday, then Sunday-Tuesday are from the previous month.'."\n";
	$ConfigOutput .= 'define("SHOW_MONTH_OVERLAP", ' . ($GLOBALS['Form_SHOW_MONTH_OVERLAP'] ? 'true' : 'false') .');'."\n\n";

	// Output Combined 'Jump To' Drop-Down
	$ConfigOutput .= '// Config: Combined \'Jump To\' Drop-Down'."\n";
	$ConfigOutput .= '// Default: true'."\n";
	$ConfigOutput .= '// Whether or not the \'jump to\' drop-down in the column will be combined into a single drop-down box or not.'."\n";
	$ConfigOutput .= '// When set to true, the list will contain all possible month/years combinations for the next X years (where X is ALLOWED_YEARS_AHEAD).'."\n";
	$ConfigOutput .= '// Only the last 3 months will be included in this list.'."\n";
	$ConfigOutput .= 'define("COMBINED_JUMPTO", ' . ($GLOBALS['Form_COMBINED_JUMPTO'] ? 'true' : 'false') .');'."\n\n";

	// Output Use Custom Login Page
	$ConfigOutput .= '// Config: Use Custom Login Page'."\n";
	$ConfigOutput .= '// Default: false'."\n";
	$ConfigOutput .= '// By default the login page includes the login form and a message about how to request a login to the calendar.'."\n";
	$ConfigOutput .= '// When set to true, a file at ./static-includes/loginform.txt will be used as a custom login page:'."\n";
	$ConfigOutput .= '// * It must include @@LOGIN_FORM@@ which will be replaced with the login form itself.'."\n";
	$ConfigOutput .= '// * You can also include @@LOGIN_HEADER@@ which will be replaced with the "Login" header text for the translation you specified.'."\n";
	$ConfigOutput .= '// * See the ./static-includes/loginform-EXAMPLE.txt file for an example.'."\n";
	$ConfigOutput .= 'define("CUSTOM_LOGIN_HTML", ' . ($GLOBALS['Form_CUSTOM_LOGIN_HTML'] ? 'true' : 'false') .');'."\n\n";

	// Output Include Static Pre-Header HTML
	$ConfigOutput .= '// Config: Include Static Pre-Header HTML'."\n";
	$ConfigOutput .= '// Default: false'."\n";
	$ConfigOutput .= '// Include the file located at ./static-includes/subcalendar-pre-header.txt before the calendar header HTML for all calendars.'."\n";
	$ConfigOutput .= '// This allows you to enforce a standard header for all calendars.'."\n";
	$ConfigOutput .= '// This does not affect the default calendar.'."\n";
	$ConfigOutput .= 'define("INCLUDE_STATIC_PRE_HEADER", ' . ($GLOBALS['Form_INCLUDE_STATIC_PRE_HEADER'] ? 'true' : 'false') .');'."\n\n";

	// Output Include Static Post-Header HTML
	$ConfigOutput .= '// Config: Include Static Post-Header HTML'."\n";
	$ConfigOutput .= '// Default: false'."\n";
	$ConfigOutput .= '// Include the file located at ./static-includes/subcalendar-post-header.txt after the calendar header HTML for all calendars.'."\n";
	$ConfigOutput .= '// This allows you to enforce a standard header for all calendars.'."\n";
	$ConfigOutput .= '// This does not affect the default calendar.'."\n";
	$ConfigOutput .= 'define("INCLUDE_STATIC_POST_HEADER", ' . ($GLOBALS['Form_INCLUDE_STATIC_POST_HEADER'] ? 'true' : 'false') .');'."\n\n";

	// Output Include Static Pre-Footer HTML
	$ConfigOutput .= '// Config: Include Static Pre-Footer HTML'."\n";
	$ConfigOutput .= '// Default: false'."\n";
	$ConfigOutput .= '// Include the file located at ./static-includes/subcalendar-pre-footer.txt before the calendar footer HTML for all calendars.'."\n";
	$ConfigOutput .= '// This allows you to enforce a standard footer for all calendars.'."\n";
	$ConfigOutput .= '// This does not affect the default calendar.'."\n";
	$ConfigOutput .= 'define("INCLUDE_STATIC_PRE_FOOTER", ' . ($GLOBALS['Form_INCLUDE_STATIC_PRE_FOOTER'] ? 'true' : 'false') .');'."\n\n";

	// Output Include Static Post-Footer HTML
	$ConfigOutput .= '// Config: Include Static Post-Footer HTML'."\n";
	$ConfigOutput .= '// Default: false'."\n";
	$ConfigOutput .= '// Include the file located at ./static-includes/subcalendar-post-footer.txt after the calendar footer HTML for all calendars.'."\n";
	$ConfigOutput .= '// This allows you to enforce a standard footer for all calendars.'."\n";
	$ConfigOutput .= '// This does not affect the default calendar.'."\n";
	$ConfigOutput .= 'define("INCLUDE_STATIC_POST_FOOTER", ' . ($GLOBALS['Form_INCLUDE_STATIC_POST_FOOTER'] ? 'true' : 'false') .');'."\n\n";

	// Output Max Category Name Cache Size
	$ConfigOutput .= '// Config: Max Category Name Cache Size'."\n";
	$ConfigOutput .= '// Default: 100'."\n";
	$ConfigOutput .= '// Cache the list of category names in memory if the calendar has less than or equal to this number.'."\n";
	$ConfigOutput .= 'define("MAX_CACHESIZE_CATEGORYNAME", \''. escapephpstring($GLOBALS['Form_MAX_CACHESIZE_CATEGORYNAME']) .'\');'."\n\n";

	// Output 'Subscribe & Download' Links to Static Files
	$ConfigOutput .= '// Config: \'Subscribe & Download\' Links to Static Files'."\n";
	$ConfigOutput .= '// Default: false'."\n";
	$ConfigOutput .= '// When a lot of users subscribe to your calendar via the \'Subscribe & Download\' page, this can put a heavy load on your server.'."\n";
	$ConfigOutput .= '// To avoid this you can enable this feature and either use a server or add-on that supports caching (i.e. Apache 2.2, squid-cache) or you can use a script to periodically retrieve and cache the files linked to from the \'Subscribe & Download\' page.'."\n";
	$ConfigOutput .= '// The \'Subscribe & Download\' page will then link to the static files rather than the export page.'."\n";
	$ConfigOutput .= '// * This also affects the RSS <link> in the HTML header.'."\n";
	$ConfigOutput .= '// * Enabling this feature does not stop users from accessing the export page.'."\n";
	$ConfigOutput .= '// * This has no effect on calendars that require users to login before viewing events.'."\n";
	$ConfigOutput .= '// For detailed instructions see http://vtcalendar.sourceforge.net/jump.php?name=cachesubscribe'."\n";
	$ConfigOutput .= 'define("CACHE_SUBSCRIBE_LINKS", ' . ($GLOBALS['Form_CACHE_SUBSCRIBE_LINKS'] ? 'true' : 'false') .');'."\n\n";

	// Output URL Extension to Static Files
	$ConfigOutput .= '// Config: URL Extension to Static Files'."\n";
	$ConfigOutput .= '// Default: cache/subscribe/'."\n";
	$ConfigOutput .= '// The path from the VTCalendar URL to the static \'Subscribe & Download\' files.'."\n";
	$ConfigOutput .= '// It will be appended to the BASEURL (e.g. http://localhost/vtcalendar/cache/subscribe/)'."\n";
	$ConfigOutput .= '// Must end with a slash.'."\n";
	$ConfigOutput .= 'define("CACHE_SUBSCRIBE_LINKS_PATH", \''. escapephpstring($GLOBALS['Form_CACHE_SUBSCRIBE_LINKS_PATH']) .'\');'."\n\n";

	// Output Static Files Output Directory
	$ConfigOutput .= '// Config: Static Files Output Directory'."\n";
	$ConfigOutput .= '// The directory path where the static \'Subscribe & Download\' files will be outputted by the ./cache/export script.'."\n";
	$ConfigOutput .= '// Must be an absolute path (e.g. /var/www/htdocs/vtcalendar/cache/subscribe/).'."\n";
	$ConfigOutput .= '// Must end with a slash.'."\n";
	$ConfigOutput .= 'define("CACHE_SUBSCRIBE_LINKS_OUTPUTDIR", \''. escapephpstring($GLOBALS['Form_CACHE_SUBSCRIBE_LINKS_OUTPUTDIR']) .'\');'."\n\n";

	// Output Export Path
	$ConfigOutput .= '// Config: Export Path'."\n";
	$ConfigOutput .= '// Default: export/export.php'."\n";
	$ConfigOutput .= '// The URL extension to the export script. Must NOT being with a slash (/).'."\n";
	$ConfigOutput .= 'define("EXPORT_PATH", \''. escapephpstring($GLOBALS['Form_EXPORT_PATH']) .'\');'."\n\n";

	// Output Maximum Exported Events
	$ConfigOutput .= '// Config: Maximum Exported Events'."\n";
	$ConfigOutput .= '// Default: 100'."\n";
	$ConfigOutput .= '// The maximum number of events that can be exported using the subscribe, download or export pages.'."\n";
	$ConfigOutput .= '// Calendar and main admins can export all data using the VTCalendar (XML) format.'."\n";
	$ConfigOutput .= 'define("MAX_EXPORT_EVENTS", \''. escapephpstring($GLOBALS['Form_MAX_EXPORT_EVENTS']) .'\');'."\n\n";

	// Output Export Data Lifetime (in minutes)
	$ConfigOutput .= '// Config: Export Data Lifetime (in minutes)'."\n";
	$ConfigOutput .= '// Default: 5'."\n";
	$ConfigOutput .= '// The number of minutes that a browser will be told to cache exported data.'."\n";
	$ConfigOutput .= 'define("EXPORT_CACHE_MINUTES", \''. escapephpstring($GLOBALS['Form_EXPORT_CACHE_MINUTES']) .'\');'."\n\n";

	// Output Allow Public to Export in VTCalendar (XML) Format
	$ConfigOutput .= '// Config: Allow Public to Export in VTCalendar (XML) Format'."\n";
	$ConfigOutput .= '// Default: false'."\n";
	$ConfigOutput .= '// The VTCalendar (XML) export format contains all information about an event, which you may not want to allow the public to view.'."\n";
	$ConfigOutput .= '// However, users that are part of the admin sponsor, or are main admins, can always export in this format.'."\n";
	$ConfigOutput .= 'define("PUBLIC_EXPORT_VTCALXML", ' . ($GLOBALS['Form_PUBLIC_EXPORT_VTCALXML'] ? 'true' : 'false') .');'."\n\n";

	// Output Send E-mail via Pear::Mail
	$ConfigOutput .= '// Config: Send E-mail via Pear::Mail'."\n";
	$ConfigOutput .= '// Default: false'."\n";
	$ConfigOutput .= '// Send e-mail using Pear::Mail rather than the built-in PHP Mail function.'."\n";
	$ConfigOutput .= '// This should be used if you are on Windows or do not have sendmail installed.'."\n";
	$ConfigOutput .= 'define("EMAIL_USEPEAR", ' . ($GLOBALS['Form_EMAIL_USEPEAR'] ? 'true' : 'false') .');'."\n\n";

	// Output SMTP Host
	$ConfigOutput .= '// Config: SMTP Host'."\n";
	$ConfigOutput .= '// Default: localhost'."\n";
	$ConfigOutput .= '// The SMTP host name to connect to.'."\n";
	$ConfigOutput .= 'define("EMAIL_SMTP_HOST", \''. escapephpstring($GLOBALS['Form_EMAIL_SMTP_HOST']) .'\');'."\n\n";

	// Output SMTP Port
	$ConfigOutput .= '// Config: SMTP Port'."\n";
	$ConfigOutput .= '// Default: 25'."\n";
	$ConfigOutput .= '// The SMTP port number to connect to.'."\n";
	$ConfigOutput .= 'define("EMAIL_SMTP_PORT", \''. escapephpstring($GLOBALS['Form_EMAIL_SMTP_PORT']) .'\');'."\n\n";

	// Output SMTP Authentication
	$ConfigOutput .= '// Config: SMTP Authentication'."\n";
	$ConfigOutput .= '// Default: false'."\n";
	$ConfigOutput .= '// Whether or not to use SMTP authentication.'."\n";
	$ConfigOutput .= 'define("EMAIL_SMTP_AUTH", ' . ($GLOBALS['Form_EMAIL_SMTP_AUTH'] ? 'true' : 'false') .');'."\n\n";

	// Output SMTP Username
	$ConfigOutput .= '// Config: SMTP Username'."\n";
	$ConfigOutput .= '// The username to use for SMTP authentication.'."\n";
	$ConfigOutput .= 'define("EMAIL_SMTP_USERNAME", \''. escapephpstring($GLOBALS['Form_EMAIL_SMTP_USERNAME']) .'\');'."\n\n";

	// Output SMTP Password
	$ConfigOutput .= '// Config: SMTP Password'."\n";
	$ConfigOutput .= '// The password to use for SMTP authentication.'."\n";
	$ConfigOutput .= 'define("EMAIL_SMTP_PASSWORD", \''. escapephpstring($GLOBALS['Form_EMAIL_SMTP_PASSWORD']) .'\');'."\n\n";

	// Output SMTP EHLO/HELO
	$ConfigOutput .= '// Config: SMTP EHLO/HELO'."\n";
	$ConfigOutput .= '// Default: localhost'."\n";
	$ConfigOutput .= '// The value to give when sending EHLO or HELO.'."\n";
	$ConfigOutput .= 'define("EMAIL_SMTP_HELO", \''. escapephpstring($GLOBALS['Form_EMAIL_SMTP_HELO']) .'\');'."\n\n";

	// Output SMTP Timeout
	$ConfigOutput .= '// Config: SMTP Timeout'."\n";
	$ConfigOutput .= '// Default: 0'."\n";
	$ConfigOutput .= '// The SMTP connection timeout.'."\n";
	$ConfigOutput .= '// Set the value to 0 to have no timeout.'."\n";
	$ConfigOutput .= 'define("EMAIL_SMTP_TIMEOUT", \''. escapephpstring($GLOBALS['Form_EMAIL_SMTP_TIMEOUT']) .'\');'."\n\n";

}
?>
