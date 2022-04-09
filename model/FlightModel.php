<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
 
class FlightModel extends Database
{
    public function getFlightsByAirPortName($token,$inp)
    {
        $userInfo = array();
        $tmp = array();
        $userInfo = $this->select("select * from `users` where `user_token` = '$token' ",$tmp,2);
        if (count($userInfo) > 0)
        {
            return $this->select("select * from `flight` where `origin_airport` = '$inp' OR `dest_airport` = '$inp' ",$tmp,1);
        }
        else
        {
            return $userInfo;
        }
    }
    public function getFlightsByCityName($token,$inp)
    {
        $userInfo = array();
        $tmp = array();
        $userInfo = $this->select("select * from `users` where `user_token` = '$token' ",$tmp,2);
        if (count($userInfo) > 0)
        {
            return $this->select("select * from `flight` where `origin_city` = '$inp' OR `dest_city` = '$inp' ",$tmp,1);
        }
        else
        {
            return $userInfo;
        }
    }
}