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
    //Origin-City flight/api3?token=123&city=tehran&fprice=100&tprice=200
    public function api3()
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
                $fromPrice = (isset($arrQueryStringParams['fprice']))?$arrQueryStringParams['fprice']:-1;
                $toPrice = (isset($arrQueryStringParams['tprice']))?$arrQueryStringParams['tprice']:-1;
                $token = (isset($arrQueryStringParams['token']))?$arrQueryStringParams['token']:-1;
                $arrUsers = $flightModel->getFlightsByPriceOrigin($token,$fromPrice,$toPrice,$city);
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
    //Destination-City flight/api4?token=123&city=tehran&fprice=100&tprice=200
    public function api4()
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
                $fromPrice = (isset($arrQueryStringParams['fprice']))?$arrQueryStringParams['fprice']:-1;
                $toPrice = (isset($arrQueryStringParams['tprice']))?$arrQueryStringParams['tprice']:-1;
                $token = (isset($arrQueryStringParams['token']))?$arrQueryStringParams['token']:-1;
                $arrUsers = $flightModel->getFlightsByPriceDest($token,$fromPrice,$toPrice,$city);
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
    //By Info flight/api5?token=123&fDate=2020-01-01&tDate=2020-01-04&fprice=100&tprice=400&carrier=Emirates
    public function api5()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') 
        {
            try {
                $flightModel = new FlightModel();
                $airport = -1;
                $carrier = (isset($arrQueryStringParams['carrier']))?$arrQueryStringParams['carrier']:-1;
                $fromPrice = (isset($arrQueryStringParams['fprice']))?$arrQueryStringParams['fprice']:-1;
                $toPrice = (isset($arrQueryStringParams['tprice']))?$arrQueryStringParams['tprice']:-1;
                $fromDate = (isset($arrQueryStringParams['fDate']))?$arrQueryStringParams['fDate']:-1;
                $toDate = (isset($arrQueryStringParams['tDate']))?$arrQueryStringParams['tDate']:-1;
                $token = (isset($arrQueryStringParams['token']))?$arrQueryStringParams['token']:-1;
                $arrUsers = $flightModel->getFlightsByInfo($token,$fromDate,$toDate,$fromPrice,$toPrice,$carrier);
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
    //Palne By Carrier flight/api6?token=123&carrier=Emirates
    public function api6()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') 
        {
            try {
                $flightModel = new FlightModel();
                $airport = -1;
                $carrier = (isset($arrQueryStringParams['carrier']))?$arrQueryStringParams['carrier']:-1;
                $token = (isset($arrQueryStringParams['token']))?$arrQueryStringParams['token']:-1;
                $arrUsers = $flightModel->getPlaneByCarrier($token,$carrier);
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
    //Reserve Flight flight/api7?token=123&originCity=Tehran&originAirport=THRA&destCity=Stokholms&destAirport=STOC&flightDate=2021-10-29_19:00&class=A
    public function api7()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') 
        {
            try {
                $flightModel = new FlightModel();
                $airport = -1;
                $originCity = (isset($arrQueryStringParams['originCity']))?$arrQueryStringParams['originCity']:-1;
                $originAirport = (isset($arrQueryStringParams['originAirport']))?$arrQueryStringParams['originAirport']:-1;
                $destCity = (isset($arrQueryStringParams['destCity']))?$arrQueryStringParams['destCity']:-1;
                $destAirport = (isset($arrQueryStringParams['destAirport']))?$arrQueryStringParams['destAirport']:-1;
                $flightDate = (isset($arrQueryStringParams['flightDate']))?$arrQueryStringParams['flightDate']:-1;
                $class = (isset($arrQueryStringParams['class']))?$arrQueryStringParams['class']:-1;
                $token = (isset($arrQueryStringParams['token']))?$arrQueryStringParams['token']:-1;
                $arrUsers = $flightModel->reserveFlight($token,$originCity,$originAirport,$destCity,$destAirport,$flightDate,$class);
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
    //Show User Flight flight/api8?token=123&stat=showreserve
    public function api8()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') 
        {
            try {
                $flightModel = new FlightModel();
                $stat = (isset($arrQueryStringParams['stat']))?$arrQueryStringParams['stat']:-1;
                $token = (isset($arrQueryStringParams['token']))?$arrQueryStringParams['token']:-1;
                $arrUsers = $flightModel->showUserReserve($token,$stat);
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
    //Delete User Flight flight/api9?token=123&id=2
    public function api9()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') 
        {
            try {
                $flightModel = new FlightModel();
                $id = (isset($arrQueryStringParams['id']))?$arrQueryStringParams['id']:-1;
                $token = (isset($arrQueryStringParams['token']))?$arrQueryStringParams['token']:-1;
                $arrUsers = $flightModel->deleteUserReserve($token,$id);
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
    //signin User flight/api10?username=habibi
    public function api10()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') 
        {
            try {
                $flightModel = new FlightModel();
                $username = (isset($arrQueryStringParams['username']))?$arrQueryStringParams['username']:-1;
                $arrUsers = $flightModel->signinUser($username);
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