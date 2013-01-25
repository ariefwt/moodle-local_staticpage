<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	 See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

global $CFG;

if ($hassiteconfig) {
	// New settings page
	$page = new admin_settingpage('staticpage', get_string('pluginname', 'local_staticpage'));


	// Document directory
	$page->add(new admin_setting_heading('local_staticpage/documentdirectoryheading', get_string('documentdirectory', 'local_staticpage'), ''));

	// Create document directory widget
	$page->add(new admin_setting_configdirectory('local_staticpage/documentdirectory', get_string('documentdirectory', 'local_staticpage'), get_string('documentdirectorydescription', 'local_staticpage'), $CFG->dataroot.'/staticpage'));


	// Apache rewrite
	$page->add(new admin_setting_heading('local_staticpage/apacherewriteheading', get_string('apacherewrite', 'local_staticpage'), ''));

	// Create apache rewrite control widget
	$page->add(new admin_setting_configcheckbox('local_staticpage/apacherewrite', get_string('apacherewrite', 'local_staticpage'), get_string('apacherewritedescription', 'local_staticpage'), 0));


	// Get previously configured plugin config
	$config = get_config('local_staticpage');
	

	// Show Document list - Do only when settings page is shown, otherwise local_staticpage would crawl the document directory at each and every Moodle page delivery
	if ($PAGE->bodyid == 'page-admin-setting-staticpage') {
		// Do only when document directory is configured and only when staticpage document directory exists
		if ($config->documentdirectory != '' && is_dir($config->documentdirectory)) {
			// Open directory
			if ($handle = @opendir($config->documentdirectory)) {
				// Get all enabled language packs
				$langs = get_string_manager()->get_list_of_translations();

				// Create array for collecting document files information
				$files = array();

				// Get all document files
				while (false !== ($filename = readdir($handle))) {
					// Is this a .html file?
					if (substr($filename, -5) == '.html' && $filename != '.' && $filename != '..') {
						// Is this a supported language based .html file?
						foreach ($langs as $key => $lang) {
							if (substr($filename, -7, 2) == $key) {
								// Remember document information
								$file = new stdClass();
								$file->filename = $filename;
								$file->pagename = substr($filename, 0, -8);
								$file->language = $lang;
								$files[] = $file;
								continue 2;
							}
						}
						// Or is this an unsupported language based .html file?
						if (substr($filename, -8, 1) == '.' && ctype_alpha(substr($filename, -7, 2))) {
							// Remember document information
							$file = new stdClass();
							$file->filename = $filename;
							$file->pagename = substr($filename, 0, -8);
							$file->language = 'unsupported';
							$files[] = $file;
							continue;
						}
						// Otherwise it's likely to be an international file
						// Remember document information
						$file = new stdClass();
						$file->filename = $filename;
						$file->pagename = substr($filename, 0, -5);
						$file->language = get_string('international', 'local_staticpage');
						$files[] = $file;
					}
				}
				closedir($handle);
			

				// Do only when there were files found
				if (count($files) > 0) {
					// Create heading
					$page->add(new admin_setting_heading('local_staticpage/documentlistheading', get_string('documentlist', 'local_staticpage'), get_string('documentlistinstruction', 'local_staticpage')));

					// Create document list
					$html = html_writer::start_tag('ul', array('class' => 'documentlist'));
					foreach ($files as $doc) {
						if ($doc->language == 'unsupported') {
							$html .= html_writer::start_tag('li');
							$html .= '<p>'.get_string('documentlistentryfilename', 'local_staticpage', $doc->filename).'</p>';
							$html .= '<p><span class="errormessage">'.get_string('documentlistentryunsupported', 'local_staticpage').'</span></p>';
							$html .= html_writer::end_tag('li');
						}
						else {
							$html .= html_writer::start_tag('li');
							$html .= '<p>'.get_string('documentlistentryfilename', 'local_staticpage', $doc->filename).'</p>';
							$html .= '<p>'.get_string('documentlistentrypagename', 'local_staticpage', $doc->pagename).'</p>';
							$url_plugin = rtrim($CFG->wwwroot, '/').'/local/staticpage/view.php?page='.$doc->pagename;
							$url_rewrite = rtrim($CFG->wwwroot, '/').'/static/'.$doc->pagename.'.html';
							$html .= '<p>'.get_string('documentlistentryreachable', 'local_staticpage', '<a href="'.$url_plugin.'">'.$url_plugin.'</a>').'</p>';
							$html .= '<p>'.get_string('documentlistentryrewrite', 'local_staticpage', '<a href="'.$url_rewrite.'">'.$url_rewrite.'</a>').'</p>';
							$html .= '<p>'.get_string('documentlistentrylanguage', 'local_staticpage', $doc->language).'</p>';
							$html .= html_writer::end_tag('li');
						}
					}
					$html .= html_writer::end_tag('ul');
					$page->add(new admin_setting_heading('local_staticpage/documentlist', '', $html));
				}
				else {
					$page->add(new admin_setting_heading('local_staticpage/documentlistheading', get_string('documentlist', 'local_staticpage'), get_string('documentlistdirectoryempty', 'local_staticpage')));
				}
			}
			else {
				$page->add(new admin_setting_heading('local_staticpage/documentlistheading', get_string('documentlist', 'local_staticpage'), get_string('documentlistdirectorynotreadable', 'local_staticpage')));
			}
		}
		else {
			$page->add(new admin_setting_heading('local_staticpage/documentlistheading', get_string('documentlist', 'local_staticpage'), get_string('documentlistnodirectory', 'local_staticpage')));
		}
	}


	// Add settings page to navigation tree
    $ADMIN->add('localplugins', $page);
}