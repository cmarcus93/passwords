<?php
require("include.php");
$ldapconn = ldap_connect($settings['ldap_host']) or die("<br>" . "Cannot connect to " . $settings['ldap_host']);
echo  "<br>Connect: " . ldap_error($ldapconn);
$ldapbind = ldap_bind($ldapconn, $settings['ldap_domain'] . "\\" . $settings['ldap_username'], $settings['ldap_password']) or die("<br>" . "Cannot bind to " . $settings['ldap_host'] . " with " . $settings['ldap_domain'] . "\\" . $settings['ldap_username'] . " and supplied password");
echo "<br>Bind: " . ldap_error($ldapconn);
$result = ldap_search($ldapconn,$settings['ldap_studentou'], "(&(objectClass=user)(cn=*))") or die("<br>" . "could not search");
echo "<br>Search Students: " . ldap_error($ldapconn);
$students = ldap_get_entries($ldapconn, $result) or die("<br>" . "could not get entries");
echo "<br>Get Students: " . ldap_error($ldapconn);
echo "<br>found " . count($students) . " students";
$result = ldap_search($ldapconn,$settings['ldap_staffou'], "(&(objectClass=user)(cn=*))") or die("<br>" . "could not search");
echo "<br>Search Staff: " . ldap_error($ldapconn);
$students = ldap_get_entries($ldapconn, $result) or die("<br>" . "could not get entries");
echo "<br>Get Staff: " . ldap_error($ldapconn);
echo "<br>found " . count($students) . " staff";
foreach ($students as $student) {
    if (in_array($settings['ldap_resetsg'], $student['memberof'])) {
        $count++;
    }
}
echo "<br>found " . $count . " staff with reset ability";
ldap_close($ldapconn);