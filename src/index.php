<?php
    // require __DIR__ . "/inc/bootstrap.php";
    require "inc/config.php";
    require "controller/Api/BaseController.php";
    require_once "model/UserModel.php";
    require_once "model/FlightModel.php";
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );
    if (isset($uri[3]))
    {
        if ($uri[3] == 'flight')
        {
            require "controller/Api/FlightController.php";
            $objFeedController = new FlightController();
            if (isset($uri[4]))
            {
                $strMethodName = $uri[4];
                $objFeedController->{$strMethodName}();
            }
            else
            {
                header("HTTP/1.1 404 Not Found");
                exit();
            }
        }
        elseif ($uri[3] == 'reserve')
        {
            echo 'reserve';
        }
        else
        {
            header("HTTP/1.1 404 Not Found");
            exit();
        }
    }
    else
    {
        header("HTTP/1.1 404 Not Found");
        exit();
    }
    
?>