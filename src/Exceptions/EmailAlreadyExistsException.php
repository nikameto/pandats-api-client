<?php

namespace Panda\Exceptions;

use Panda\ServerException;

/**
 * This exception thrown when request successfully sent and response successfully received and parsed but from
 * server received message about something is wrong.
 *
 * Class EmailAlreadyExistsException
 * @package Panda\Exceptions
 */
class EmailAlreadyExistsException extends ServerException
{

}
