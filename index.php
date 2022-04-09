<?php
    require __DIR__ . "/inc/bootstrap.php";
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = explode( '/', $uri );
    if (isset($uri[3]))
    {
        if ($uri[3] == 'flight')
        {
            require PROJECT_ROOT_PATH . "/Controller/Api/FlightController.php";
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
// require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
// $objFeedController = new UserController();
// $strMethodName = $uri[4] . 'Action';
// $objFeedController->{$strMethodName}();
    // if ($uri[3] == 'flight')
    // {
        // require PROJECT_ROOT_PATH . "/Controller/Api/FlightController.php";
        // $objFeedController = new FlightController();
        // if (isset($uri[4]))
        // {
        //     $strMethodName = $uri[4];
        //     $objFeedController->{$strMethodName}();
        // }
    //     else
    //     {
    //         header("HTTP/1.1 404 Not Found");
    //         exit();
    //     }
        
    // }
    
?>