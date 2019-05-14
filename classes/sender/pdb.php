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
 * Sender implementation for logstore_pdb.
 *
 * @package    logstore_pdb
 * @copyright  2018 Daniel Amo <danielamo@gmail.com>, Marc Alier <granludo@gmail.com>
 * @author     Amo Daniel, https://eduliticas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace classes\sender\pdb;

defined('MOODLE_INTERNAL') || die();

function send(array $config, array $evententries) {

    $endpoint = $config['endpoint'];
    $username = $config['username'];
    $password = $config['password'];

    $auth = base64_encode($username.':'.$password);
    $postdata = json_encode($evententries);

    $request = curl_init();
    curl_setopt($request, CURLOPT_URL, $endpoint);
    curl_setopt($request, CURLOPT_POSTFIELDS,  $postdata);
    curl_setopt($request, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($request, CURLOPT_HTTPHEADER, [
        'Authorization: Basic '.$auth,
        'Content-Type: application/json',
    ]);

    $responsetext = curl_exec($request);
    $responsecode = curl_getinfo($request, CURLINFO_RESPONSE_CODE);
    curl_close($request);

    if ($responsecode !== 200) {
        throw new \Exception($responsetext);
    }
    return $evententries;
}