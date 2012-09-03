<?php

namespace Brightmarch\Bundle\UtilityBundle\Utility\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpClient
{

    /** @var cURL connection */
    public $connection = null;

    /** @var integer */
    public $timeout = 5;

    public function __construct($timeout=0)
    {
        $this->connection = curl_init();

        if ($timeout > 0) {
            $this->setTimeout($timeout);
        }
    }

    /**
     * Injects a Request object to be sent. The Request object
     * needs to be already hydrated.
     *
     * @param Request $request
     * @return boolean
     */ 
    public function addRequest(Request $request)
    {
        $headers = $this->collapseHeaders($request);

        $options = array(
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $request->getUri(),
            CURLOPT_CUSTOMREQUEST => $request->server->get('REQUEST_METHOD'),
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_USERAGENT => $request->server->get('HTTP_USER_AGENT'),
            CURLOPT_POSTFIELDS => http_build_query($request->request->all()),
            CURLOPT_TIMEOUT => $this->timeout
        );

        curl_setopt_array($this->connection, $options);

        return(true);
    }

    /**
     * Sends out the request to the server.
     *
     * @return Response
     */
    public function sendRequest()
    {
        $payload = curl_exec($this->connection);
        $statusCode = (int)curl_getinfo($this->connection, CURLINFO_HTTP_CODE);

        $response = new Response($payload, $statusCode);

        return($response);
    }

    public function close()
    {
        curl_close($this->connection);
        $this->connection = null;

        return(true);
    }

    public function setTimeout($timeout)
    {
        $this->timeout = (int)abs($timeout);

        return($this);
    }

    public function setOption($option, $value)
    {
        curl_setopt($this->connection, $option, value);

        return($this);
    }



    /**
     * The Symfony HttpFoundation Request object stores headers
     * as array-arrays. cURL requires just a simple array.
     *
     * This method collapses the headers in the Request object
     * to a single array of string headers.
     *
     * @param Request $request
     * @return array
     */
    private function collapseHeaders(Request $request)
    {
        $headers = array();
        foreach ($request->headers->all() as $header => $value) {
            $headers[] = sprintf("%s: %s", $header, $value[0]);
        }

        return($headers);
    }

}
