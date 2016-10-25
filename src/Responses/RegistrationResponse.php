<?php

namespace Panda\Responses;

use Panda\Exceptions\EmailAlreadyExistsException;
use Panda\Payload;
use Panda\Response;

class RegistrationResponse extends Response
{
    const FIELD_LOGIN = 'login';

    const ERROR_EMAIL_ALREADY_EXISTS = 'BL001';

    /**
     * @var string
     */
    protected $login = '';

    public function __construct(Payload $payload)
    {
        parent::__construct($payload);

        $this->processKnownErrors($payload->getData());

        $data = $payload->getData();

        $this->login = $data[self::FIELD_DATA][self::FIELD_LOGIN];
    }

    /**
     * Returns login for registered customer from PandaTS platform.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    protected function processKnownErrors($data)
    {
        parent::processKnownErrors($data);

        if (isset($data[self::FIELD_DATA][self::FIELD_ERROR_CODE])) {
            $errorCode = strtoupper($data[self::FIELD_DATA][self::FIELD_ERROR_CODE]);
            switch ($errorCode) {
                case self::ERROR_EMAIL_ALREADY_EXISTS: {
                    throw new EmailAlreadyExistsException($this);
                }
                default: {
                    break;
                }
            }
        }
    }
}
