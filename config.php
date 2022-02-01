<?php
$settings['ldap_host']        = 'ldaps://server:636';
$settings['ldap_username']    = 'user';
$settings['ldap_password']    = 'password';
$settings['ldap_domain']      = 'domain'; //netbios domain
$settings['ldap_studentou']   = 'OU=Students,DC=domain,DC=sa,DC=edu,DC=au';
$settings['ldap_staffou']     = 'OU=Staff,DC=domain,DC=sa,DC=edu,DC=au';
//not used plans though
$settings['ldap_studentsg']   = 'CN=Students,OU=Students,DC=domain,DC=sa,DC=edu,DC=au';
//security group staff with reset permissions are in
$settings['ldap_resetsg']     = 'CN=Classroom Teachers,OU=Students,DC=domain,DC=sa,DC=edu,DC=au';