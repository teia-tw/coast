
A Docker + fig environment for Drupal development using PHP-FPM and nginx.

Usages
------

        # Put your Drupal site under project root directory
        $ make dev
        # check http://localhost:8080/ or http://<boot2docker_ip>:8080/

Check the `Makefile` for MySQL settings.  For MySQL host, after the containers start up, do

        $ fig run db env | grep DB_PORT_3306_TCP_ADDR

You can connect to MySQL at `localhost:3306` or `<boot2docker_ip>:3306`.
