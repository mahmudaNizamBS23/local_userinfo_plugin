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
 * Version information
 *
 * @package    local_userinfo
 * @copyright  2024 MahmudaNizamSubha *
 *  @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 require_once(__DIR__.'/../../config.php');
 require_once('./lib.php');
 
 try {
     require_login();
 } catch (Exception $exception) {
     print_r($exception);
 }
 
 $PAGE->set_url(new moodle_url('/local/userinfo/manage.php'));
 $PAGE->set_context(\context_system::instance());
 $PAGE->set_title('Manage User Information');
 

 echo $OUTPUT->header();
 
 local_userinfo_displayinfo();
 
 
 echo $OUTPUT->footer();