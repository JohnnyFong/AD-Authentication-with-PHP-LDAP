<?php
    
    header('Access-Control-Allow-Origin: *');

    $ldap_dn = "domain\\username"; //Domain and username
    $ldap_password = "Your_Password_Here"; //Password
    
    //Depending on the structure of your Active Directory, manipulate the query below to get the user that you want.
    $ldaptree    = "OU=Enter_OU_Here, OU=Enter_OU_Here, DC=Enter_Domain_Here, DC=com"; //You might need more OU or less OU depending on the structure 

    $ldap_con = ldap_connect("DOMAIN.COM");//connect to the domain (eg. example.com) or to public ip
    ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap_con, LDAP_OPT_REFERRALS, 0);
    
    if(ldap_bind($ldap_con, $ldap_dn, $ldap_password)){//bind username and password with AD
        echo "bind successful";

        //Here, insert the directory that you want to query out the user
        $result = ldap_search($ldap_con,$ldaptree, "(|(objectCategory=person))") or die ("Error in search query: ".ldap_error($ldap_con));
        //ldap_get_entries will return a list of arrays that contain the user information
        $data = ldap_get_entries($ldap_con, $result);

        // echo '</pre>';
        // var_dump($data);

        //Uncomment above 2 lines to see the output of the array.

        //loop through the array to get the user's information
        for ($x=0; $x<$data['count']; $x++){
           
            $LDAP_samaccountname = $data[$x]['samaccountname'][0];
            if ($LDAP_samaccountname == null){
                $LDAP_samaccountname = "";
            }
            $LDAP_DisplayName = $data[$x]['displayname'][0];
            if ($LDAP_DisplayName == null){
                $LDAP_DisplayName = "";
            }
            $LDAP_Email = $data[$x]['mail'][0];
            if ($LDAP_Email == null){
                $LDAP_Email = "";
            }
            $LDAP_Dept = $data[$x]['department'][0];
            if ($LDAP_Dept == null){
                $LDAP_Dept = "";
            }
            $LDAP_Phnum = $data[$x]['telephonenumber'][0];
            if ($LDAP_Phnum == null){
                $LDAP_Phnum = "";
            }
            
            echo "<br>";
            echo $LDAP_samaccountname;
            echo "<br>";
            echo $LDAP_DisplayName;
            echo "<br>";
            echo $LDAP_Email;
            echo "<br>";
            echo $LDAP_Dept;
            echo "<br>";
            echo $LDAP_Phnum;
        }    
    }
    else{
        echo "failed";//bind failed
    }
    ldap_unbind($ldap_con);//close the connection
?>