# EVENTOS 

Currently EVENTOS APP is an implementation of PHP 7 project with support for PHP/APACHE/HTML5/JQUERY as front end


## Background
The next stack has been used into JAX-RS service 

- MEDOO
- JQUERY 3.1
- HTML 5
- PHP 7
- MARIA DB/ MYSQL
- APACHE

## Notes for development
Its recommended  use the next work directories

-  app
    - application
        -  /config to add change CONSTANTS and important CONFIG
        -  /controller to add interactivity between routes and controllers
        -  /core  to maintenance the principal configuration of project
        -  /libs  to add more libraries or php files into core
        -  /repository to add services bus that would be used by controllers
        -  /view to add files html
    -  public
           /assets to add javascript and css libraries    

## Config Database Conection
Its recommended to use the next file `application/config/config.php` and set the next constants

- DB_HOST = your host/server
- DB_NAME = your database name
- DB_USER = your database user
- DB_PASS  = your database password
```php
define('DB_HOST', 'host');
define('DB_NAME', 'name');
define('DB_USER', 'user');
define('DB_PASS', 'password');
````

## Currently this project supports

- TEMPLATING
- BOOSTRAP 4
- PHP 7.1
- APACHE 2 
- ACE-ADMIN

## BUILD
you can use buldAndRun.sh to  download/build/run changes from git repository 

## RUN
Use docker compose.yml  to RUN Service ,   use this image for RUN Service      image: hub.mypeopleapps.com/sgp-monitor:${beta}  or ${latest}
```yaml
version: '3'
services:
  sgp-monitor:
    image: hub.yourhub.com/eventos:${beta}
    container_name: eventos_docker
    environment:
      LOG_STDERR: "false"
      LOG_LEVEL: ""
      SGP_API_LINK: "write your hub here"
    ports:
      - "8080:80"
    volumes:
      - "./var/log/httpd:/var/log/httpd" 
```