<?php

namespace App\View\Helper;

use Cake\View\Helper;

class LdapHelper{
    /*public $ldap = null;
    public $ldapServer = 'REPLACED_LDAP_HOST';
    public $ldapPort = '389';
    public $suffix = '@pitt.edu';
    public $a='Hoshang';
 */
    
 
    public static function getInfo($user)
    {
        
        $username = $user; // Get the username from the code
        $attributes = array('givenName','sn','mail','department'); // 
        $filter = "(cn=$user)";
        $ldapUser = 'REPLACED_LDAP_USER'; // LDAP creds
        $ldappassword = 'REPLACED_LDAP_PASSWORD';
        $ldapServer = 'ldap://REPLACED_LDAP_HOST';
        $ldapPort = '389';
        $ldap = ldap_connect($ldapServer) //, $ldapPort
          or die("Could not connect to $ldapServer");
        $ldapbind=ldap_bind($ldap, $ldapUser, $ldappassword);
        $baseDN = 'REPLACED_LDAP_CONTEXT';
        if (ldap_bind($ldap, $ldapUser, $ldappassword))
              {
        $result = ldap_search($ldap, $baseDN, $filter,$attributes);
        $array = ldap_get_entries($ldap, $result);
        $info = array(); // Save the contents in the form of an array.
        $info['first_name'] = $array[0]['givenname'][0];
        $info['last_name'] = $array[0]['sn'][0];
     //   $info['name'] = $info['first_name'] .' '. $info['last_name'];
        $info['email'] = $array[0]['mail'][0];
        $info['department'] = $array[0]['department'][0];
      //  $info['user'] = $array[0]['samaccountname'][0];
      //  $info['groups'] = $this->groups($array[0]['memberof']);
        $test=$array["count"]." entries returned\n"; 
        return $info;
        }
        else
        {
           $error='error';
          //global $ldapServer;
           return $error; 
        }
    }
}
?>