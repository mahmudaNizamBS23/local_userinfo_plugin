<?php
require_once(__DIR__.'/../../config.php');
require_login(); // Ensure user is logged in

$PAGE->set_url(new moodle_url('/local/userinfo/delete.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Delete Record');

global $DB;

// Retrieve the record ID from the POST request
$userid = required_param('userid', PARAM_INT); // Get the record ID from the form data

// Check permissions to delete
//require_capability('local/crud:delete', context_system::instance()); // Ensure the user has the right permissions

// Fetch the record to delete
$record = $DB->get_record('local_userinfo', array('userid' => $userid));

if (!$record) {
    echo('Record not found'); // Handle case where the record does not exist
}
else{
// Delete the record
$DB->delete_records('local_userinfo', array('userid' => $userid)); // Perform the deletion
}
// Redirect to a suitable page after deletion
redirect(new moodle_url('/local/userinfo/manage.php'));

echo $OUTPUT->footer(); // Render the footer