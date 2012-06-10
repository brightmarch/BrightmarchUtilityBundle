<?php

namespace Brightmarch\Bundle\UtilityBundle\Utility\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Slim wrapper on top of cURL. Makes use of the Symfony HttpFoundation
 * library's Request and Response objects.
 *
 * @author Vic Cherubini <vic@brightmarch.com>
 */
class HttpClient
{

    public $connection = null;
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
     * @param Request The Request object to send out.
     * @return boolean Returns true.
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
     * @return Response The hydrated Response object.
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



    /**
     * The Symfony HttpFoundation Request object stores headers
     * as array-arrays. cURL requires just a simple array.
     *
     * This method collapses the headers in the Request object
     * to a single array of string headers.
     *
     * @param Request The Request object with the headers.
     * @return array An array of headers to send.
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
