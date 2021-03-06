<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;

class LdapComponent extends Component
{
    /*
     * getInfo method
     *
     * First we connect to the LDAP server by providing the LDAP server name,
     * after which we bind to that connection made by providing the
     * LDAP username and password, after which we pass in the search queries
     * for the particular username, and if found we enter the information in the
     * $info array and return this array.
     *
     * @param String $user , username which has to be searched.
     * @return Array $info , info array which consists of First Name, Last Name,
     *  Email, department.
     *
     */
    public static function getInfo($user)
    {
        $Ldap=Configure::read('Ldap');
        $attributes = array('givenName','sn','mail','department','PittAffiliate');
        $filter = "(cn=$user)";
        $ldapUser = $Ldap['ldapUser'];
        $ldapPassword = $Ldap['ldapPassword'];
        $ldapServer = $Ldap['ldapServer'];
        $ldapPort = $Ldap['ldapPort'];
        $ldap = ldap_connect($ldapServer, $ldapPort);
        if ($ldap) {
            $baseDN = $Ldap['ldapBaseDN'];
            if (ldap_bind($ldap, $ldapUser, $ldapPassword)) {
                $result = ldap_search($ldap, $baseDN, $filter, $attributes);
                $array = ldap_get_entries($ldap, $result);
                $info = array();
                $info['username'] = $user;
                if ($array && $array['count'] != 0) {
                    $info['first_name'] = $array[0]['givenname'][0];
                    $info['last_name'] = $array[0]['sn'][0];
                    $info['email'] = $array[0]['mail'][0];
                    $info['department'] = $array[0]['department'][0];
                    $info['status'] = '';
                    if (isset($array[0]['pittaffiliate']) && is_array($array[0]['pittaffiliate'])) {
                        foreach (array('faculty', 'student', 'staff') as $s) {
                            if (in_array($s, $array[0]['pittaffiliate']) !== FALSE) {
                                $info['status'] = $s;
                                break;
                            }
                        }
                    }
                } else {
                    $info['first_name'] = $info['last_name'] = $info['email'] =  $info['department'] = $info['status'] = '';
                }
                return $info;
            }
        }
        return array('username' => $user, 'first_name' => '' , 'last_name' => '', 'email' => '', 'department' => '', 'status' => '');
    }
}
