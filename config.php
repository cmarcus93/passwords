<?php
$settings['ldap_host']        = 'ldaps://10.70.152.41:636';
$settings['ldap_username']    = 'password';
$settings['ldap_password']    = 'U7Epdy57QCF$';
$settings['ldap_domain']      = 'millicenths'; //netbios domain
$settings['ldap_studentou']   = 'OU=Students,OU=Curriculum,DC=millicenths,DC=local';
$settings['ldap_staffou']     = 'OU=Staff,OU=Curriculum,DC=millicenths,DC=local';
//not used plans though
$settings['ldap_studentsg']   = 'CN=SG-Students,OU=Groups,OU=Curriculum,DC=millicenths,DC=local';
//security group staff with reset permissions are in
$settings['ldap_resetsg']     = 'CN=Password Reset,OU=Groups,OU=Curriculum,DC=millicenths,DC=local';
