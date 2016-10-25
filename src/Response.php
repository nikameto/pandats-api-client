<?php

namespace Panda;

use Panda\Exceptions\ForbiddenException;

class Response
{
    /**
     * @var \Panda\Payload
     */
    protected $payload = null;

    const FIELD_DATA ='data';

    const FIELD_ERROR_CODE = 'errorCode';

    const ERROR_FORBIDDEN = 'RV005';

    /**
     * Response constructor.
     *
     * @param Payload $payload
     */
    public function __construct(Payload $payload){
        $this->payload = $payload;
        $this->processKnownErrors($payload->getData());
    }

    /**
     * @return \Panda\Payload
     */
    public function getPayload()
    {
        return $this->payload;
    }

    protected function processKnownErrors($data)
    {
        if (isset($data[self::FIELD_DATA][self::FIELD_ERROR_CODE])) {
            $errorCode = strtoupper($data[self::FIELD_DATA][self::FIELD_ERROR_CODE]);
            switch ($errorCode) {
                case self::ERROR_FORBIDDEN: {
                    throw new ForbiddenException($this);
                }
                default: {
                    break;
                }
            }
        }
    }
}