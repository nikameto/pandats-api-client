<?php

namespace Panda;

/**
 * This exception thrown when request successfully sent and response successfully received but something went wrong.
 *
 * Class Exception
 * @package Panda
 */
class ServerException extends \Exception
{
    /**
     * @var \Panda\Response
     */
    private $response = null;

    public function __construct(Response $response = null, $message = '', $code = 0, \Exception $previous = null)
    {
        $exception = parent::__construct($message, $code, $previous);
        $this->response = $response;

        return $exception;
    }

    /**
     * @return \Panda\Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}