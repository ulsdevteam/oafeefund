<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class SearchQueryComponent extends Component{

    public function getRequests($action,$parameter=null,$value=null){
            $this->Requests = TableRegistry::get('Requests');
            switch($action){
            case "index":
                $prev_action="index";
                $prev_value="All";
                $query_check="";
                break;
            case "pendingrequests":
                $prev_action="pendingrequests";
                 $prev_value="Pending";
                $query_check="Pending";
                break;
            case "approvedrequests":
                $prev_action="approvedgrequests";
                $prev_value="Approved";
                $query_check="Approved";
                break;
            case "paidrequests":
                $prev_action="paidrequests";
                $prev_value="Paid";
                $query_check="Paid";
                break;
            case "deniedrequests":
                $prev_action="deniedrequests";
                $prev_value="Denied";
                $query_check="Denied";
                break;
            default :
                return false;
        }
        if($parameter!= null && $value!=null){
        switch($parameter){
            case "username":
                $requests=$this->Requests->find('all')
                    ->where(["Requests.username LIKE" => "%$value%","Requests.funded LIKE"=>"$query_check"]);
                break;
            case "author_name":
                $requests=$this->Requests->find('all')
                    ->where(["Requests.author_name LIKE" => "%$value%","Requests.funded LIKE"=>"$query_check"]);
                break;
            case "publisher":
                $requests=$this->Requests->find('all')
                    ->where(["Requests.publisher LIKE" => "%$value%","Requests.funded LIKE"=>"$query_check"]); 
                break;
            default :
                $requests=$this->Requests->find('all'); // return false
                return false;
        }
        }
        else{
            $requests=$this->Requests->find('all')
                    ->where(["Requests.funded LIKE"=>"%$query_check%"]);
        }
        return $requests;
    }
}