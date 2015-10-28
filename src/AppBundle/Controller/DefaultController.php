<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
        $json=file_get_contents('https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%3D479616%20AND%20u%3D%22c%22&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=');
        // Convert JSON to PHP object
        $phpObj =  json_decode($json);
        return new Response('<html><body>Current temperature in Vilnius: '.$phpObj->query->results->channel->item->condition->temp.' C</body></html>');
    }
}
