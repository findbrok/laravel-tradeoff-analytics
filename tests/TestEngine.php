<?php

use Orchestra\Testbench\TestCase;

/**
 * Class TestEngine
 */
class TestEngine extends TestCase
{
    /**
     * Our config path
     *
     * @var string
     */
    protected $ourConfigPath;

    /**
     * Analytics engine
     *
     * @var \FindBrok\TradeoffAnalytics\Engine
     */
    protected $engine;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        //Setup our config path
        $this->ourConfigPath = __DIR__.'/../src/config/tradeoff-analytics.php';
        //Set up engine
        $this->engine = app('FindBrok\TradeoffAnalytics\Contracts\TradeoffAnalyticsInterface');
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->engine);
        unset($this->ourConfigPath);
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    public function getPackageProviders($app)
    {
        return ['FindBrok\TradeoffAnalytics\TradeoffAnalyticsServiceProvider'];
    }

    /**
     * Test to see if our service is bound correctly
     * in the IOC
     *
     * @return void
     */
    public function testServiceProviderBinding()
    {
        $this->assertInstanceOf(
            'FindBrok\TradeoffAnalytics\Engine',
            $this->app->make('FindBrok\TradeoffAnalytics\Contracts\TradeoffAnalyticsInterface')
        );
    }

    /**
     * Test to see if our config keys are working
     *
     * @return void
     */
    public function testConfigKeys()
    {
        $this->assertEquals('superSecretPassword', config('tradeoff-analytics.credentials.default.password'));
        $this->assertEquals('superSecretUsername', config('tradeoff-analytics.credentials.default.username'));
    }

    /**
     * Test to see if our config is being published correctly
     *
     * @return void
     */
    public function testPublicationOfConfig()
    {
        $this->artisan('vendor:publish', [
            '--provider' => 'FindBrok\TradeoffAnalytics\TradeoffAnalyticsServiceProvider',
            '--tag' => ['config']
        ]);
        $this->assertTrue(file_exists(config_path('tradeoff-analytics.php')));
        $this->assertEquals(file_get_contents($this->ourConfigPath), file_get_contents(config_path('tradeoff-analytics.php')));
        unlink(config_path('tradeoff-analytics.php'));
    }

    /**
     * Test to see if we get the default credentials
     *
     * @return void
     */
    public function testGetCredentialWithDefaultCredentials()
    {
        $this->assertEquals([
            'username' => 'superSecretUsername',
            'password' => 'superSecretPassword',
            'url' => 'https://gateway.watsonplatform.net/tradeoff-analytics/api/'
        ], $this->engine->getCredentials());
    }

    /**
     * Test the getCredentials method to see if changing the
     * credentials name to use we get correct credentials
     *
     * @return void
     */
    public function testGetCredentialsWithAnotherCredentialsName()
    {
        Config::set('tradeoff-analytics.credentials.foo.url', env('TRADEOFF_ANALYTICS_URL1'));
        Config::set('tradeoff-analytics.credentials.foo.username', env('TRADEOFF_ANALYTICS_USERNAME1'));
        Config::set('tradeoff-analytics.credentials.foo.password', env('TRADEOFF_ANALYTICS_PASSWORD1'));

        $this->engine->usingCredentials('foo');

        $this->assertEquals([
            'username' => 'superSecretUsername1',
            'password' => 'superSecretPassword1',
            'url' => 'superSecretUrl1'
        ],  $this->engine->getCredentials());
    }

    /**
     * Test append headers method
     *
     * @return void
     */
    public function testAppendHeadersMethod()
    {
        $this->engine->appendHeaders([
            'X-foo' => 'Bar'
        ]);
        $this->assertEquals([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-foo' => 'Bar',
            'X-Watson-Learning-Opt-Out' => false
        ], $this->engine->getHeaders());
    }

    /**
     * Test our make bridge method to see if we get our bridge
     * instance
     *
     * @return void
     */
    public function testMakeBridgeMethod()
    {
        $this->assertInstanceOf('FindBrok\WatsonBridge\Bridge', $this->engine->makeBridge());
    }
}
