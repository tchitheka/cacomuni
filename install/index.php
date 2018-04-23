<?php
/*
 +-------------------------------------------------------------------------+
 | Copyright (C) 2004-2018 The Cacti Group                                 |
 |                                                                         |
 | This program is free software; you can redistribute it and/or           |
 | modify it under the terms of the GNU General Public License             |
 | as published by the Free Software Foundation; either version 2          |
 | of the License, or (at your option) any later version.                  |
 |                                                                         |
 | This program is distributed in the hope that it will be useful,         |
 | but WITHOUT ANY WARRANTY; without even the implied warranty of          |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           |
 | GNU General Public License for more details.                            |
 +-------------------------------------------------------------------------+
 | Cacti: The Complete RRDtool-based Graphing Solution                     |
 +-------------------------------------------------------------------------+
 | This code is designed, written, and maintained by the Cacti Group. See  |
 | about.php and/or the AUTHORS file for specific developer information.   |
 +-------------------------------------------------------------------------+
 | http://www.cacti.net/                                                   |
 +-------------------------------------------------------------------------+
*/
error_reporting(E_ALL);

define('IN_CACTI_INSTALL', 1);

include_once('../include/auth.php');
include_once('../lib/api_data_source.php');
include_once('../lib/api_device.php');
include_once('../lib/utility.php');
include_once('../lib/import.php');
include_once('./functions.php');

set_default_action();

// database test
if (get_nfilter_request_var('action') == 'testdb') {
	if (get_nfilter_request_var('location') == 'local') {
		install_test_local_database_connection();
	} else {
		install_test_remote_database_connection();
	}

	exit;
}

include_once('../lib/installer.php');

/* allow the upgrade script to run for as long as it needs to */
$installer = new Installer();
if ($installer->shouldRedirectToHome()) {
	header($url_path);
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php print html_common_header(__('Cacti Server v%s - Install/Version Change',CACTI_VERSION), 'modern');?>
	<?php print get_md5_include_js('install/install.js'); ?>
	<?php print get_md5_include_css('install/install.css'); ?>
</head>
<body>
	<div class='cactiInstallTable'>
		<div class='cactiInstallTableTitleRow'>
			<div class='textHeaderDark'><strong><?php print __('Cacti Server v%s - Installation Wizard',CACTI_VERSION); ?></strong></div>
		</div>
		<div class='cactiInstallArea'>
			<div class='cactiInstallAreaContent' id='installContent'>
<?php
				print $installer->outputSectionTitle(__('Initializing'));
				print $installer->outputsection(__('Please wait whilst the installation system for Cacti Version %s initialises.  You must have javascript enabled for this to work.', CACTI_VERSION));
?>
			</div>
		</div>
		<div class='cactiInstallButtonArea'>
			<!--
				print __x('Dialog: previous', 'Previous');
				print __x('Dialog: complete', 'Finish');
				print __x('Dialog: go to the next page', $installer->default_install_button);
				print __('Test remote database connection')
				print __x('Dialog: test connection', 'Test Connection');
			-->
			<input class='installButton' id='buttonPrevious' type='button' value='Previous'>
			<input class='installButton' id='buttonNext' type='button' value='Next'>
			<input class='installButton' id='buttonTest' type='button' value='Test'>
			<input id='installData' type='hidden'>
		</div>
		<div id="installDebug"></div>
		<div class='cactiInstallCopyrightArea'>Copyright &copy; 2018 Cacti Group</div>
	</div>
<?php
include_once('../include/global_session.php');
?>
</body>
</html>
