# Moodle Personal Data Brocker
The Personal Data Brocker Moodle plugin externalizes the Standard log store table.

## Installation:
Install the endpoint before installing the Moodle plugin.

### Endpoint
This plugin needs an HTTP accessible endpoint to send Moodle data events and a MySQL table to save the events as logs. Follow the next two steps to successfully configure the endpoint:

1. The endpoint uses basic authentication by user and password. Upload the endpoint.php file to your PHP web server (HTTPS recommended), change its name for security purposes and configure it replacing these keywords settings:

  - PDB_AUTH_USER: Username for the basic authentication. This username will have to be configured in the settings Plugin's page.
  - PDB_AUTH_PASSWORD: Password for the basic authentication. This password will have to be configured in the settings Plugin's page.
  - PDB_MYSQL_HOST: Host of the MySQL server.
  - PDB_MYSQL_USER: Connection user of the MySQL server.
  - PDB_MYSQL_PASSWORD: Password of the connection user.
  - PDB_MYSQL_DATABASE: Database name of the MySQL server that will contain the log store table.

2. Use the endpoint_sql_log_table.sql file to create the standard log store table into the MySQL server.

### Moodle plugin
> Clone or download repository.
> Remove endpoint.php and endpoint_sql_log_table.sql files.
> Create zip from files and folders. Use it to install the plugin on Moodle.
> Configure the plugin with the URL of the endpoint and the username and password used to replace PDB_AUTH_USER and PDB_AUTH_PASSWORD.