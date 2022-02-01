<?php
// some basic ldap functions
function ldapBind($username,$password) {
    global $settings;
    $ldapconn = ldap_connect($settings['ldap_host']);
    $ldapbind = ldap_bind($ldapconn, $settings['ldap_domain'] . "\\".$username, $password);
    ldap_close($ldapconn);
    return $ldapbind;
}

function modUser($dn, $values) {
    global $settings;
    $ldapconn = ldap_connect($settings['ldap_host']);
    $ldapbind = ldap_bind($ldapconn, $settings['ldap_domain'] . "\\" . $settings['ldap_username'], $settings['ldap_password']) or die("1");
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3) or die("2");
    foreach ($values as $key => $value) {
        $modifs[] = array(
            "attrib"  => $key,
            "modtype" => LDAP_MODIFY_BATCH_REPLACE,
            "values"  => [$value]				
        );
    }
    ldap_modify_batch($ldapconn, $dn, $modifs) or die(ldap_error($ldapconn));
    ldap_close($ldapconn);
    die("Success");
}

function getUser($username, $ou) {
    global $settings;
    $ldapconn = ldap_connect($settings['ldap_host']);
    $ldapbind = ldap_bind($ldapconn, $settings['ldap_domain'] . "\\" . $settings['ldap_username'], $settings['ldap_password']);
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
    $result = ldap_search($ldapconn, $ou, "(&(samaccountname=".ldap_escape($username, "", LDAP_ESCAPE_FILTER)."))");
    $entrys = ldap_get_entries($ldapconn,$result);
    @$user = array(
        "samaccountname"=>$entrys[0]["samaccountname"][0],
        "dn"=>$entrys[0]["dn"],
        "sn"=>$entrys[0]["sn"][0],
        "givenname"=>$entrys[0]["givenname"][0],
        "mail"=>$entrys[0]["mail"][0],
        "memberof"=>$entrys[0]["memberof"],
    );
    ldap_close($ldapconn);
    return $user;
} 
function getStudents() {
    global $settings;
    $ldapconn = ldap_connect($settings['ldap_host']);
    $ldapbind = ldap_bind($ldapconn, $settings['ldap_domain'] . "\\" . $settings['ldap_username'], $settings['ldap_password']);
    $result = ldap_search($ldapconn,$settings['ldap_studentou'], "(&(objectClass=user)(cn=*))");
    $students = ldap_get_entries($ldapconn, $result);
    ldap_close($ldapconn);
    $data = array();
    foreach ($students as $student) {
        if (isset($student['cn'][0])) {		
                @$data[] = array(
                    'samaccountname' => $student['samaccountname'][0],
                    'cn' => $student['cn'][0],
                    'sn' => iconv("ISO-8859-1", "UTF-8", $student['sn'][0]), 
                    'givenname' => iconv("ISO-8859-1", "UTF-8", $student['givenname'][0]), 
                    'physicaldeliveryofficename' => $student['physicaldeliveryofficename'][0], 
                    'distinguishedname' => $student['distinguishedname'][0],
                    'useraccountcontrol' => $student['useraccountcontrol'][0],
                    'memberof' => $student['memberof'],
                    'mail' => $student['mail'][0],
                );
        }
    }
    return $data;
}

// some other functions
function encodePass($pass) {
    $newPassword = "\"" . $pass . "\"";
    $newPass = mb_convert_encoding($newPassword, "UTF-16LE");
    return $newPass;
}

function pa($array) {
    //for debug
    echo "<pre>"; print_r($array); echo "</pre>";
}