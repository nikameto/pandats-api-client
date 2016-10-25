<?php

namespace Panda;

use GuzzleHttp;
use Panda\Responses\RegistrationResponse;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Panda\Requests\RegistrationRequest;

class ApiClient implements LoggerAwareInterface
{

    /**
     * @var string
     */
    protected $parnterId = '';

    /**
     * @var string
     */
    protected $secretKey = '';

    /**
     * @var string
     */
    protected $url = '';

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $httpClient;


    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __construct($url, $partnerId, $secretKey, $options = [])
    {
        $this->url = $url;
        $this->parnterId = $partnerId;
        $this->secretKey = $secretKey;

        if (isset($options['httpClient']) && $options['httpClient'] instanceof GuzzleHttp\ClientInterface) {
            $this->httpClient = $options['httpClient'];
        }
    }

    public function registration(RegistrationRequest $request)
    {
        $data = [
            'email'       => $request->getEmail(),
            'password'    => $request->getPassword(),
            'ip'          => $request->getIpAddress(),
            'newsletter'  => $request->getNewsletter(),
            'source'      => $request->getSource(),
            'country'     => $request->getCountry(),
            'firstName'   => $request->getFirstName(),
            'lastName'    => $request->getLastName(),
        ];

        $payload = new Payload($this->request('/api/v1/Registration', $data));

        return new RegistrationResponse($payload);
    }

    protected function sign(&$data)
    {
        $data['partnerId'] = $this->parnterId;
        $data['time'] = time();
        $values = array_values($data);
        sort($values, SORT_STRING);
        $string = join('', $values);
        $data['transactionKey'] = sha1($string . $this->secretKey);
    }

    /**
     * Sends request to Solaris API endpoint.
     *
     * @param string $uri
     * @param array  $data
     *
     * @return string
     */
    protected function request($uri, $data = [])
    {
        $this->sign($data);

        $url = $this->url . $uri;
        $url .= '?' . http_build_query($data);

        try {

            return (string) $this->getHttpClient()->get($url, [
                GuzzleHttp\RequestOptions::HEADERS => [
                    'User-Agent' => 'ResNext / PandaTS API Client',
                ]
            ])->getBody();
        } catch (GuzzleHttp\Exception\ConnectException $e) {

            return new ClientException($e->getMessage());
        } catch (GuzzleHttp\Exception\ClientException $e) {

            return (string) $e->getResponse()->getBody();
        } catch (GuzzleHttp\Exception\ServerException $e) {

            return (string) $e->getResponse()->getBody();
        }
    }

    /**
     * This method should be used instead direct access to property $httpClient
     *
     * @return \GuzzleHttp\ClientInterface|GuzzleHttp\Client
     */
    protected function getHttpClient()
    {
        if (!is_null($this->httpClient)) {

            return $this->httpClient;
        }
        $stack = GuzzleHttp\HandlerStack::create();
        if ($this->logger instanceof LoggerInterface) {
            $stack->push(GuzzleHttp\Middleware::log(
                $this->logger,
                new GuzzleHttp\MessageFormatter(GuzzleHttp\MessageFormatter::DEBUG)
            ));
        }
        $this->httpClient = new GuzzleHttp\Client([
            'handler' => $stack,
        ]);

        return $this->httpClient;
    }
}
