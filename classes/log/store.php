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
 * Personal Data Broker log store plugin
 *
 * @package    logstore_pdb
 * @copyright  2018 Daniel Amo <danielamo@gmail.com>, Marc Alier <granludo@gmail.com>
 * @author     Amo Daniel, https://eduliticas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace logstore_pdb\log;
defined('MOODLE_INTERNAL') || die();

use \tool_log\log\writer as log_writer;
use \tool_log\log\manager as log_manager;
use \tool_log\helper\store as helper_store;
use \tool_log\helper\reader as helper_reader;
use \tool_log\helper\buffered_writer as helper_writer;
use \core\event\base as event_base;

/**
 * This class processes events and enables them to be sent to a logstore.
 *
 */
class store implements log_writer {
    use helper_store;
    use helper_reader;
    use helper_writer;

    /**
     * Constructor.
     * @param log_manager $manager
     */
    public function __construct(log_manager $manager) {
        $this->helper_setup($manager);
    }

    /**
     * Should the event be ignored (== not logged)? Overrides helper_writer.
     * @param event_base $event
     * @return bool
     *
     */
    protected function is_event_ignored(event_base $event) {
        if ((!CLI_SCRIPT || PHPUNIT_TEST)) {
            if (!isloggedin() || isguestuser()) {
                // Always log inside CLI scripts because we do not login there.
                return true;
            }
        }

        return false;
    }

    /**
     * Send events to Personal Data Broker
     * @param array $evententries raw event data
     */
    protected function insert_event_entries(array $evententries) {
        global $CFG;
        require(__DIR__ . '/../../version.php');
        require(__DIR__ . '/../sender/pdb.php');
        $config = [
            'endpoint' => $this->get_config('endpoint', ''),
            'username' => $this->get_config('username', ''),
            'password' => $this->get_config('password', ''),
        ];
        \classes\sender\pdb\send($config, $evententries);
    }

    /**
     * Determines if a connection exists to the store.
     * @return boolean
     */
    public function is_logging() {
        return true;
    }
}
