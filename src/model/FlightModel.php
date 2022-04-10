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
    public function getFlightsByPriceOrigin($token,$fromPrice,$toPrice,$city)
    {
        $userInfo = array();
        $tmp = array();
        $userInfo = $this->select("select * from `users` where `user_token` = '$token' ",$tmp,2);
        if (count($userInfo) > 0)
        {
            return $this->select("select * from `flight` where `origin_city` = '$city' and `price` BETWEEN '$fromPrice' AND '$toPrice' ",$tmp,1);
        }
        else
        {
            return $userInfo;
        }
    }
    public function getFlightsByPriceDest($token,$fromPrice,$toPrice,$city)
    {
        $userInfo = array();
        $tmp = array();
        $userInfo = $this->select("select * from `users` where `user_token` = '$token' ",$tmp,2);
        if (count($userInfo) > 0)
        {
            return $this->select("select * from `flight` where `dest_city` = '$city' and `price` BETWEEN '$fromPrice' AND '$toPrice' ",$tmp,1);
        }
        else
        {
            return $userInfo;
        }
    }
    public function getFlightsByInfo($token,$fromDate,$toDate,$fromPrice,$toPrice,$carrier)
    {
        $userInfo = array();
        $tmp = array();
        $userInfo = $this->select("select * from `users` where `user_token` = '$token' ",$tmp,2);
        if (count($userInfo) > 0)
        {
            return $this->select("select * from `flight` where `carrier` = '$carrier' and `price` BETWEEN '$fromPrice' AND '$toPrice' and `datetime` BETWEEN '$fromDate' AND '$toDate' ",$tmp,1);
        }
        else
        {
            return $userInfo;
        }
    }
    public function getPlaneByCarrier($token,$inp)
    {
        $userInfo = array();
        $tmp = array();
        $userInfo = $this->select("select * from `users` where `user_token` = '$token' ",$tmp,2);
        if (count($userInfo) > 0)
        {
            return $this->select("select `plane_type` from `flight` where `carrier` = '$inp' GROUP BY `plane_type` ",$tmp,1);
        }
        else
        {
            return $userInfo;
        }
    }
    public function reserveFlight($token,$originCity,$originAirport,$destCity,$destAirport,$flightDate,$class)
    {
        $userInfo = array();
        $tmp = array();
        $msg = 'Error';
        $userInfo = $this->select("select * from `users` where `user_token` = '$token' ",$tmp,2);
        if (count($userInfo) > 0)
        {
            $flightStat = $this->select("select `id`,`plane_type` from `flight` where `origin_city` LIKE '$originCity' AND `origin_airport` LIKE '$originAirport' 
            AND `dest_city` LIKE '$destCity' AND `dest_airport` LIKE '$destAirport' AND `datetime` = '$flightDate' AND `class` LIKE '$class' ",$tmp,1);
            if (count($flightStat) > 0)
            {
                $flightId = $flightStat[0]['id'];
                $plane_type = $flightStat[0]['plane_type'];
                $flightRes = $this->select("select count(`id`) as `cid` from `reserve` where `flight_id` = '$flightId'",$tmp,1);
                $reserved = $flightRes[0]['cid']+1;
                $flightCap = $this->select("select `capecity` from `plane` where `plane_name` = '$plane_type'",$tmp,1);
                $capecity = $flightCap[0]['capecity'];
                if ($reserved < $capecity)
                {
                    $capecity--;
                    $msg = 'ok';
                    $reserve = $this->executeStatement("insert into `reserve`(`user_token`, `flight_id`) VALUES ('$token','$flightId')",$tmp,1);
                    $reserve = $this->executeStatement("update `plane` SET `capecity`='$capecity' WHERE `plane_name` = '$plane_type' ",$tmp,1);
                    return $msg;
                }
            }
            else
            {
                echo 'nok';
            }
        }
        else
        {
            return $userInfo;
        }
    }
    public function showUserReserve($token,$stat)
    {
        $userInfo = array();
        $tmp = array();
        $userInfo = $this->select("select * from `users` where `user_token` = '$token' ",$tmp,2);
        if ((count($userInfo) > 0) && ($stat == 'showreserve'))
        {
            return $this->select("select * from `reserve` LEFT JOIN flight on `flight_id` = flight.id WHERE `user_token` = '$token' ",$tmp,1);
        }
        else
        {
            return $userInfo;
        }
    }
    public function deleteUserReserve($token,$id)
    {
        $userInfo = array();
        $tmp = array();
        $msg = 'Error';
        $userInfo = $this->select("select * from `users` where `user_token` = '$token' ",$tmp,2);
        if (count($userInfo) > 0)
        {
            $msg = 'ok';
            $this->executeStatement("delete from `reserve` WHERE `flight_id` = '$id' and `user_token` = '$token' ",$tmp,1);
            $flightInfo = $this->select("select `plane_type` from `flight` where `id`='$id' ",$tmp,1);
            $plane_type = $flightInfo[0]['plane_type'];
            if (count($flightInfo) > 0)
                $reserve = $this->executeStatement("update `plane` SET `capecity`=capecity+1 WHERE `plane_name` = '$plane_type' ",$tmp,1);
            return $msg;
        }
        else
        {
            return $userInfo;
        }
    }
    public function signinUser($userName)
    {
        $userInfo = array();
        $tmp = array();
        $msg = 'User Exist';
        $userInfo = $this->select("select * from `users` where `user_name` = '$userName' ",$tmp,2);
        if (count($userInfo) <= 0)
        {
            $msg = 'ok';
            $rnd = rand()*245;
            $token = $userName.$rnd;
            $this->executeStatement("insert into `users`(`user_name`, `user_email`, `user_token`) VALUES ('$userName','$userName','$token') ",$tmp,2);
            return $token;
        }
        else
        {
            return $msg;
        }
    }
    public function compareEnterTrafic($token,$city1,$city2,$fdate,$tdate)
    {
        $userInfo = array();
        $tmp = array();
        $userInfo = $this->select("select * from `users` where `user_token` = '$token' ",$tmp,2);
        if (count($userInfo) > 0)
        {
            $city1 = $this->select("select COUNT(`id`) as `cid` from `flight` where `dest_city` = '$city1' and `datetime` BETWEEN '$fdate' AND '$tdate'",$tmp,1);
            $city1Trafic = $city1[0]['cid'];
            $city2 = $this->select("select COUNT(`id`) as `cid` from `flight` where `dest_city` = '$city2' and `datetime` BETWEEN '$fdate' AND '$tdate'",$tmp,1);
            $city2Trafic = $city2[0]['cid'];
            $userInfo = [$city1Trafic,$city2Trafic];
            return $userInfo;
        }
        else
        {
            return $userInfo;
        }
    }
    public function compareEncome($token,$carrier1,$carrier2,$fdate,$tdate)
    {
        $userInfo = array();
        $tmp = array();
        $userInfo = $this->select("select * from `users` where `user_token` = '$token' ",$tmp,2);
        if (count($userInfo) > 0)
        {
            $priceCnt1 = 0;
            $flightLists = $this->select("select `id`,`price` from `flight` where `carrier` = '$carrier1' and `datetime` BETWEEN '$fdate' AND '$tdate'",$tmp,1);
            for($i=0;$i<(count($flightLists));$i++)
            {
                $id = $flightLists[$i]['id'];
                $price = $flightLists[$i]['price'];
                $flightRes = $this->select("select `id` from `reserve` where `flight_id` = '$id'",$tmp,1);
                for($j=0;$j<(count($flightRes));$j++)
                {
                    $priceCnt1 +=$price;
                }
            }
            $priceCnt2 = 0;
            $flightLists = $this->select("select `id`,`price` from `flight` where `carrier` = '$carrier2' and `datetime` BETWEEN '$fdate' AND '$tdate'",$tmp,1);
            for($i=0;$i<(count($flightLists));$i++)
            {
                $id = $flightLists[$i]['id'];
                $price = $flightLists[$i]['price'];
                $flightRes = $this->select("select `id` from `reserve` where `flight_id` = '$id'",$tmp,1);
                for($j=0;$j<(count($flightRes));$j++)
                {
                    $priceCnt2 +=$price;
                }
            }
            $userInfo = [$priceCnt1,$priceCnt2];
            return $userInfo;
        }
        else
        {
            return $userInfo;
        }
    }
    public function comparePlan($token,$planTyp,$fdate,$tdate)
    {
        $userInfo = array();
        $tmp = array();
        $userInfo = $this->select("select * from `users` where `user_token` = '$token' ",$tmp,2);
        if (count($userInfo) > 0)
        {
            $priceCnt1 = 0;
            return $this->select("select count(`id`) as `cid` from `flight` where `plane_type` = '$planTyp' and `datetime` BETWEEN '$fdate' AND '$tdate'",$tmp,1);
        }
        else
        {
            return $userInfo;
        }
    }
}