# AD-Authentication-with-PHP-LDAP
Authenticate user with existing Active Directory and how to get users information

LDAP is not enabled on default, to use LDAP functions:
1) Locate php.ini file (Same location where php is installed (eg. C:/xampp/php/php.ini))
2) Edit php.ini file, make sure "extension=php_ldap.dll" is uncommented by removing ";"
3) Save and close the file
4) Make sure libeay32.dll and ssleay32.dll is in the same locaiton (if missing, download it form the internet)
5) Restart server
