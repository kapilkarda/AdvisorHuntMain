<?php

if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='sachin' || $_SERVER['HTTP_HOST']=='127.0.0.1' || $_SERVER['HTTP_HOST']=='64.118.110.198')
{
    define ('DB_USERNAME', 'root');
    define ('DB_PASSWORD', '');
    define ('DATABASE_NAME', 'adhunter');
    define ('ADMIN_EMAIL', 'sachin.chavan@cityit.in');
    define ('DB_HOST', 'localhost');
}


elseif($_SERVER['HTTP_HOST'] == '52.200.18.86')
{
    define ('DB_USERNAME','root');
    define ('DB_PASSWORD','');
    define ('DATABASE_NAME','adhunter');
    define ('ADMIN_EMAIL', 'sachin.chavan@cityit.in');
    define ('DB_HOST', 'localhost');

}
elseif($_SERVER['HTTP_HOST'] == '52.20.134.132')
{
	define ('DB_USERNAME','adhunter');
	define ('DB_PASSWORD','Advisorhunter');
	define ('DATABASE_NAME','adhunter');
	define ('ADMIN_EMAIL', 'sachin.chavan@cityit.in');
	define ('DB_HOST', 'db-adhunter-1.cmmls7kdudcv.us-east-1.rds.amazonaws.com');

}
else
{
    define ('DB_USERNAME','root');
    define ('DB_PASSWORD','');
    define ('DATABASE_NAME','adhunter');
    define ('ADMIN_EMAIL', '');
    define ('DB_HOST', 'localhost');
    define ('ADMIN_EMAIL', 'sachin.chavan@cityit.in');
    
}
?>
