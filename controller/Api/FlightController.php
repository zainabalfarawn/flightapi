<?php
class FlightController extends BaseController
{
    //Origin-Airport Or Destination-Airport flight/api1?token=123&airport=THR
    public function api1()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') 
        {
            try {
                $flightModel = new FlightModel();
                $airport = -1;
                $airport = (isset($arrQueryStringParams['airport']))?$arrQueryStringParams['airport']:-1;
                $token = (isset($arrQueryStringParams['token']))?$arrQueryStringParams['token']:-1;
                $arrUsers = $flightModel->getFlightsByAirPortName($token,$airport);
                $responseData = json_encode($arrUsers);
            } 
            catch (Error $e) 
            {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } 
        else 
        {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) 
        {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } 
        else 
        {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
    //Origin-City Or Destination-City flight/api2?token=123&city=tehran
    public function api2()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') 
        {
            try {
                $flightModel = new FlightModel();
                $airport = -1;
                $city = (isset($arrQueryStringParams['city']))?$arrQueryStringParams['city']:-1;
                $token = (isset($arrQueryStringParams['token']))?$arrQueryStringParams['token']:-1;
                $arrUsers = $flightModel->getFlightsByCityName($token,$city);
                $responseData = json_encode($arrUsers);
            } 
            catch (Error $e) 
            {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } 
        else 
        {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
 
        // send output
        if (!$strErrorDesc) 
        {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } 
        else 
        {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}