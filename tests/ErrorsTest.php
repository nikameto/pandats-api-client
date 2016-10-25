<?php

namespace Panda\Tests;

use GuzzleHttp\Psr7\Response;
use Panda\Requests\RegistrationRequest;

class ErrorsTest extends TestCase
{
    /**
     * @expectedException \Panda\Exceptions\ForbiddenException
     */
    public function testForbiddenException()
    {
        $apiResponse = new Response(200, [], $this->getStub('Error-RV005.json'));
        $this->mockResponse($apiResponse);

        $this->apiClient->registration(new RegistrationRequest());
    }
}
