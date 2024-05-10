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
function local_userinfo_displayinfo(){
    global $DB,$OUTPUT;
    $userinfo = $DB->get_records('local_userinfo');
    
     $templatecontext = (object)[
    'userinfo' => array_values($userinfo),
    'editurl' => new moodle_url('/local/userinfo/edit.php'),
    'deleteurl' => new moodle_url('/local/userinfo/delete.php'),
     ];
    echo $OUTPUT->render_from_template('local_userinfo/manage',$templatecontext);

}
function local_userinfo_init_form(int $userid = null): edit {
    global $DB,$CFG;
    

    $actionurl = new moodle_url('/local/userinfo/edit.php');

    if ($userid) {
        $info = $DB->get_record('local_userinfo', array('userid' => $userid));
        $mform = new edit($actionurl, $info);
    } else {
        $mform = new edit($actionurl);
    }
    return $mform;
}
function local_userinfo_edit_info(edit $mform, int $userid = null) {
    global $DB;
    if ($mform->is_cancelled()) {
        //Back to manage.php
        redirect(new moodle_url('/local/userinfo/manage.php'));
    } else if ($fromform = $mform->get_data()) {
        // Handing the form data.
        $recordtoinsert = new stdClass();
        $recordtoinsert->name =$fromform->name;
        $recordtoinsert->email= $fromform->email;
        $recordtoinsert->phoneno = $fromform->phonenumber;
    
        if (!empty($fromform->userid)) {
            // Update the record.
            echo $fromform->userid;
            $recordtoinsert->userid = $fromform->userid;
            echo $recordtoinsert->userid;
            var_dump($recordtoinsert);
            $DB->update_record('local_userinfo', $recordtoinsert);
            
            redirect(new moodle_url('/local/userinfo/manage.php'), get_string('updatethanks', 'local_userinfo'));

        } else {
            // Insert the record.
            $DB->insert_record('local_userinfo', $recordtoinsert);
            // Go back to manage page.
            redirect(new moodle_url('/local/userinfo/manage.php'), get_string('insertthanks', 'local_userinfo'));
        }
    }
}

/*function local_userinfo_createuser(){
    global $DB,$CFG;
    $mform = new edit();
  

// Form processing and displaying is done here.
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot.'/local/userinfo/manage.php','You did not create a new entry.');
} else if ($fromform = $mform->get_data()) {
 
    $recordtoinsert = new stdClass();
    $recordtoinsert->name =$fromform->name;
    $recordtoinsert->email= $fromform->email;
    $recordtoinsert->phoneno = $fromform->phonenumber;
    
    $DB->insert_record('local_userinfo',$recordtoinsert);
    redirect($CFG->wwwroot.'/local/userinfo/manage.php','A new entry was created.');

} 
}*/