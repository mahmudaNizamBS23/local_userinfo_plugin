<?php
/**
 * Version information
 *
 * @package    local_userinfo
 * @copyright  2024 MahmudaNizamSubha *
 *  @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
// moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class edit extends moodleform {
    protected $data;

    /**
     * Constructor.
     */
    public function __construct($actionurl, $data = null) {
        $this->data = $data;
        parent::__construct($actionurl);
    }

    //Add elements to form
    public function definition() {
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore!

        // Add elements to your form.
        $mform->addElement('hidden', 'userid', get_string('userid','local_userinfo'));
        $mform->setType('userid', PARAM_INT);
        $mform->setDefault('userid', $this->data->userid ?? "");

        $mform->addElement('text', 'name', get_string('name','local_userinfo'));
        $mform->setType('name', PARAM_TEXT);
        $mform->setDefault('name', $this->data->name ?? "");
         
         
        $mform->addElement('text', 'email', get_string('email','local_userinfo'));
        $mform->setType('email', PARAM_TEXT);
        $mform->setDefault('email', $this->data->email ?? "");

        $mform->addElement('text', 'phonenumber', get_string('phonenumber','local_userinfo'));
        $mform->setType('phonenumber', PARAM_INT);
        $mform->setDefault('phonenumber', $this->data->phoneno ?? "");

        $this->add_action_buttons();
    }

    // Custom validation should be added here.
    function validation($data, $files) {
        return [];
    }
}