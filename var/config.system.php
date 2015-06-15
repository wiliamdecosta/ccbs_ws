<?php
error_reporting((E_ALL ^ E_DEPRECATED ^ E_WARNING) & ~E_NOTICE);
/*
    Theme Setting
*/
$sysConfig['Theme.siteTitle'] = 'PAYMENT CCBS';
$sysConfig['Theme.defaultTheme'] = 'default';
$sysConfig['Theme.defaultPage'] = 'default';

/* Database Setting */
$sysConfig['DB.user'] = 'paytv';
$sysConfig['DB.password'] = 'paytv';
$sysConfig['DB.tns'] = '(DESCRIPTION= (ADDRESS= (PROTOCOL=TCP) (HOST=192.168.1.101) (PORT=1521) ) (CONNECT_DATA= (SERVER=DEDICATED) (SID=ORCL) ) )';
$sysConfig['DB.type'] = 'oci8';

/*
    Module Setting
*/
$sysConfig['Module.defaultModule'] = 'paymentccbs';
$sysConfig['Module.defaultClass'] = 'paymentccbs';
$sysConfig['Module.defaultMethod'] = 'main';

/* Session Setting */
$sysConfig['Session.Duration'] = 7;
$sysConfig['Session.InactivityTimeout'] = 90;
