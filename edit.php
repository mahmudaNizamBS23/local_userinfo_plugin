<?php
/**
 * Version information
 *
 * @package    local_userinfo
 * @copyright  2024 MahmudaNizamSubha *
 *  @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(__DIR__.'/../../config.php');
require_once('./lib.php');
require_once($CFG->dirroot.'/local/userinfo/classes/form/edit_form.php');

global $DB;

$userid = optional_param('userid', 0, PARAM_INT);
$PAGE->set_url(new moodle_url('/local/userinfo/edit.php', array('userid' => $userid)));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Edit User Information');
 

// Instantiate the myform form from within the plugin.
//local_userinfo_createuser();
$mform = local_userinfo_init_form($userid);
local_userinfo_edit_info($mform, $userid);
echo $OUTPUT->header();


$mform->display();
echo $OUTPUT->footer();