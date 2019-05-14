<?php

/**
 * Version information for the Personal Data Broker logstore_pdb plugin.
 *
 * @package    logstore_pdb
 * @copyright  2018 Daniel Amo <danielamo@gmail.com>, Marc Alier <granludo@gmail.com>
 * @author     Amo Daniel, https://eduliticas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Personal Data Broker"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
} else {
    if ($_SERVER['PHP_AUTH_USER'] == 'PDB_AUTH_USER' && $_SERVER['PHP_AUTH_PW'] == 'PDB_AUTH_PASSWORD') {

		$mysqli = new mysqli("PDB_MYSQL_HOST", "PDB_MYSQL_USER", "PDB_MYSQL_PASSWORD", "PDB_MYSQL_DATABASE");
		if (!$mysqli->connect_errno) {

			/* FOR DEBUG PURPOSES */
			/* $file_handle = fopen('pdb_post.json', 'a+'); */

			$json_string = file_get_contents("php://input");
			$arr = json_decode($json_string,true);
			foreach ($arr as $key => $value) {

				/* FOR DEBUG PURPOSES */
				/* fwrite($file_handle, json_encode($value)."\n"); */

				$array=json_decode(str_replace("}", "]", str_replace("{", "[", json_encode($value))));
				$query = "INSERT INTO `mdl_logstore_standard_log` (`eventname`, `component`, `action`, `target`, `objecttable`, `objectid`, `crud`, `edulevel`, `contextid`, `contextlevel`, `contextinstanceid`, ".
						"`userid`, `courseid`, `relateduserid`, `anonymous`, `other`, `timecreated`, `origin`, `ip`, `realuserid`) VALUES".
						"(";
			    $query .= "'".$mysqli->real_escape_string($value["eventname"])."',";
			    $query .= "'".$mysqli->real_escape_string($value["component"])."',";
			    $query .= "'".$mysqli->real_escape_string($value["action"])."',";
			    $query .= "'".$mysqli->real_escape_string($value["target"])."',";
			    $query .= "'".$mysqli->real_escape_string($value["objecttable"])."',";
			    $query .= (is_null($value["objectid"]))?"NULL,":$value["objectid"].",";
			    $query .= "'".$mysqli->real_escape_string($value["crud"])."',";
			    $query .= (is_null($value["edulevel"]))?"NULL,":$value["edulevel"].",";
			    $query .= (is_null($value["contextid"]))?"NULL,":$value["contextid"].",";
			    $query .= (is_null($value["contextlevel"]))?"NULL,":$value["contextlevel"].",";
			    $query .= (is_null($value["contextinstanceid"]))?"NULL,":$value["contextinstanceid"].",";
			    $query .= (is_null($value["userid"]))?"NULL,":$value["userid"].",";
			    $query .= (is_null($value["courseid"]))?"NULL,":$value["courseid"].",";
			    $query .= (is_null($value["relateduserid"]))?"NULL,":$value["relateduserid"].",";
			    $query .= (is_null($value["anonymous"]))?"NULL,":$value["anonymous"].",";
			    $query .= "'".str_replace("\\","\\\\",$mysqli->real_escape_string($value["other"]))."',";
			    $query .= (is_null($value["timecreated"]))?"NULL,":$value["timecreated"].",";
			    $query .= "'".$mysqli->real_escape_string($value["origin"])."',";
			    $query .= "'".$mysqli->real_escape_string($value["ip"])."',";
			    $query .= (is_null($value["realuserid"]))?"NULL":$value["realuserid"];
			    $query .= ");";

				/* FOR DEBUG PURPOSES */
				/* fwrite($file_handle, $query."\n"); */

				if (!$mysqli->query($query)) {

					/* FOR DEBUG PURPOSES */
					/* fwrite($file_handle, "Error mysql: ".$mysqli->error."\n"); */

				}

			}

			/* FOR DEBUG PURPOSES */
			/* fclose($file_handle); */
		}
	} else {
    	header('WWW-Authenticate: Basic realm="Personal Data Broker"');
    	header('HTTP/1.0 401 Unauthorized');
    	exit;
	}
}