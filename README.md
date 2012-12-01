Overview
------------

A ready-to-go symfony 1.4, propel 1.6 project loaded up with the sfAltumoPlugin. 


Licensing
------------

   - Symfony, Propel, Altumo and sfAltumoPlugin are all under the MIT license.
   - Google Closule Library is under the Apache License Version 2.0


Dependencies
------------

   - PHP 5.3.4
     - Extensions:
       - CURL
	   - mongodb client & mongo (only required by PivotalTracker client).
   - Git 1.7+
   - MySQL 5.1+

Installation
------------

   - git clone -o blank_altumo git://github.com/altumo/blank_altumo.git my-new-project-name
   - cd my-new-project-name
   - git submodule update --init --recursive
   - cd htdocs/project
   - Run the install:
     - usage: symfony altumo:install database-host database-user database-password database domain environment
     - eg. ./symfony altumo:install localhost my_db_user my_db_password my_database my.dev.domain.com dev_ssperandeo
     - Follow the instructions from the install script

Testing
------------

   - ./symfony altumo:test
   

Sample Usage
------------

   - ./symfony altumo:update
    
    
