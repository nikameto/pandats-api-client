<?php

namespace Panda\Tests;

use GuzzleHttp\Psr7\Response;
use Panda\Requests\RegistrationRequest;
use Panda\Responses\RegistrationResponse;

class RegistrationTest extends TestCase
{
    public function testSuccessfulAddResponse()
    {
        $apiResponse = new Response(200, [], $this->getStub('successfulRegistration.json'));
        $this->mockResponse($apiResponse);
        $response = $this->apiClient->registration(new RegistrationRequest());
        $this->assertTrue($response instanceof RegistrationResponse);
        $this->assertEquals(5811896, $response->getLogin());
    }

    /**
     * @expectedException \Panda\Exceptions\EmailAlreadyExistsException
     */
    public function testExistedEmailRegistration()
    {
        $apiResponse = new Response(200, [], $this->getStub('Error-BL001.json'));
        $this->mockResponse($apiResponse);
        $this->apiClient->registration(new RegistrationRequest());
    }
}
