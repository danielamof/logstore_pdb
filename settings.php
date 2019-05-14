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
 * Defines the form for editing Personal Data Brocker settings.
 *
 * @package    logstore_pdb
 * @copyright  2018 Daniel Amo <danielamo@gmail.com>, Marc Alier <granludo@gmail.com>
 * @author     Amo Daniel, https://eduliticas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

//require_once(__DIR__ . '/src/autoload.php');

if ($hassiteconfig) {
    // Endpoint.
    $settings->add(new admin_setting_configtext('logstore_pdb/endpoint',
        get_string('endpoint', 'logstore_pdb'), '',
        'http://example.com/endpoint/location/', PARAM_URL));
    // Username.
    $settings->add(new admin_setting_configtext('logstore_pdb/username',
        get_string('username', 'logstore_pdb'), '', 'username', PARAM_TEXT));
    // Key or password.
    $settings->add(new admin_setting_configtext('logstore_pdb/password',
        get_string('password', 'logstore_pdb'), '', 'password', PARAM_TEXT));

}
