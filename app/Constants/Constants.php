<?php

define('ROUTE_PREFIX', 'dashboard.');
define('URL_PREFIX', str_replace('.', '', ROUTE_PREFIX));
define('SUPERADMIN_ROLES', ['Super Admin']);
define('BASIC_ROLES', ['Normal']);
define('PERMISSION_GUARDS', 'web,api');
