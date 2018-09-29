<?php
    
    header('Access-Control-Allow-Origin: *');

    $ldap_dn = "Your_Domain_Here\\Your_Username_Here"; //(eg. domain\\username)
    $ldap_password = "Your_Password_Here"; //Password
    
    $ldap_con = ldap_connect("DOMAIN.COM");//connect to the domain (eg. example.com) or to public ip
    ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap_con, LDAP_OPT_REFERRALS, 0);
    
    if(ldap_bind($ldap_con, $ldap_dn, $ldap_password)){//bind username and password with AD
        echo "bind successful";//bind successful 
    }
    else{
        echo "user not exist in AD";//bind failed
    }
    ldap_unbind($ldap_con);//close the connection
?>