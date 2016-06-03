<?php

namespace FindBrok\TradeoffAnalytics;

/**
 * Class AbstractEngine
 *
 * @package FindBrok\TradeoffAnalytics
 */
abstract class AbstractEngine
{
    /**
     * Credentials name to use for connection.
     *
     * @var string
     */
    protected $credentialName = 'default';

    /**
     * Auth method to use
     *
     * @var string
     */
    protected $authMethod;

    /**
     * Http headers to send to Watson.
     *
     * @var array
     */
    protected $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ];

    /**
     * Results from API call
     *
     * @var string
     */
    protected $results = null;

    /**
     * Create a new instance of AbstractEngine.
     */
    public function __construct()
    {
        //Set Auth method
        $this->useAuthMethod(config('tradeoff-analytics.auth_method'));
    }

    /**
     * Create a new WatsonApi Bridge.
     *
     * @return \FindBrok\WatsonBridge\Bridge
     */
    public function makeBridge()
    {
        return app()->make('TradeoffAnalyticsBridge', $this->getCredentials())
                    ->useAuthMethodAs($this->getAuthMethod())
                    ->appendHeaders($this->getHeaders());
    }

    /**
     * Get Http Headers to send.
     *
     * @return array
     */
    public function getHeaders()
    {
        //Append X-Watson-Learning-Opt-Out
        $this->appendHeaders([
            'X-Watson-Learning-Opt-Out' => config('tradeoff-analytics.x_watson_learning_opt_out')
        ]);
        //Return headers
        return $this->headers;
    }

    /**
     * Append Http Headers to send.
     *
     * @param array $headers
     * @return self
     */
    public function appendHeaders($headers = [])
    {
        //Append headers in class
        $this->headers = collect($this->headers)->merge($headers)->all();
        //Return calling object
        return $this;
    }

    /**
     * Specify which credentials name to use.
     *
     * @param string $name
     * @return self
     */
    public function usingCredentials($name = 'default')
    {
        //Override credential name
        $this->credentialName = $name;
        //Return calling object
        return $this;
    }

    /**
     * Get the credentials name to use.
     *
     * @return string
     */
    public function getCredentialName()
    {
        return $this->credentialName;
    }

    /**
     * Return User credentials to make connection to Watson.
     *
     * @return array
     */
    public function getCredentials()
    {
        return [
            'username' => config('tradeoff-analytics.credentials.'.$this->getCredentialName().'.username'),
            'password' => config('tradeoff-analytics.credentials.'.$this->getCredentialName().'.password'),
            'url' => config('tradeoff-analytics.credentials.'.$this->getCredentialName().'.url')
        ];
    }

    /**
     * Set auth method to use when making request
     *
     * @param string $authMethod
     * @return self
     */
    public function useAuthMethod($authMethod)
    {
        //Set method
        $this->authMethod = $authMethod;
        //Return object
        return $this;
    }

    /**
     * Return AuthMethod to use
     *
     * @return string
     */
    public function getAuthMethod()
    {
        return $this->authMethod;
    }
}
