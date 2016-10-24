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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Local plugin "staticpage" - Language pack
 *
 * @package    local_staticpage
 * @copyright  2013 Alexander Bias, Ulm University <alexander.bias@uni-ulm.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Static Pages';
$string['apacherewrite'] = 'Force Apache mod_rewrite';
$string['apacherewrite_desc'] = 'Serve static pages only with a clean URL, rewritten by Apache mod_rewrite. See README file for details.';
$string['cleanhtml'] = 'Clean HTML code';
$string['cleanhtml_desc'] = 'Configure if the static page\'s HTML code should be cleaned (and thereby special tags like <iframe> being removed). See README for details.';
$string['cleanhtmlyes'] = 'Yes, clean HTML code';
$string['cleanhtmlno'] = 'No, don\'t clean HTML code';
$string['documents'] = 'Documents';
$string['documents_desc'] = 'The .html files with the static pages\' HTML code. See README file for details.';
$string['documentheadingsource'] = 'Data source of document heading';
$string['documentheadingsource_desc'] = 'The data source of the static page\'s document heading';
$string['documentnavbarsource'] = 'Data source of breadcrumb item title';
$string['documentnavbarsource_desc'] = 'The data source of the static page\'s breadcrumb item title (used in the Moodle "Navbar")';
$string['documenttitlesource'] = 'Data source of document title';
$string['documenttitlesource_desc'] = 'The data source of the static page\'s document title (used in the browser titlebar)';
$string['documenttitlesourceh1'] = 'First h1 tag in HTML code (usually located shortly after opening the body tag)';
$string['documenttitlesourcehead'] = 'First title tag in HTML code (usually located within the head tag)';
$string['forcelogin'] = 'Force login';
$string['forcelogin_desc'] = 'Serve static pages only to logged in users or also to non-logged in visitors. This behaviour can be set specifically for static pages or can be set to respect Moodle\'s global forcelogin setting. See README for details.';
$string['forceloginglobal'] = 'Respect the global setting $CFG->forcelogin';
$string['pagenotfound'] = 'Page not found';
$string['processcontent'] = 'Process content';
$string['processfilters'] = 'Process filters';
$string['processfilters_desc'] = 'Configure if Moodle filters (especially the multilanguage filter) should be processed when serving the static page\'s content. See README for details.';
$string['processfiltersyes'] = 'Yes, process filters';
$string['processfiltersno'] = 'No, don\'t process filters';
$string['upgrade_notice_2016020307'] = '<strong>UPGRADE NOTICE:</strong> The static page document files were moved to the new filearea within Moodle. You can delete the legacy documents directory {$a} now. For more upgrade instructions, especially if you have been using the multilanguage features of this plugin, see README file.';
