<?php
/**
 * Request.php
 *
 * Created by Chongyi
 * Date & Time 2015/11/10 23:55
 */

namespace Ancell\Framework\Server\Http;

use Ancell\Framework\Foundation\Application;
use Illuminate\Http\Request as IlluminateRequest;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends IlluminateRequest
{
    protected static $requestInstance;

    public static function capture(Application $app)
    {
        static::enableHttpMethodParameterOverride();

        if (static::$requestInstance instanceof SymfonyRequest) {
            return static::createFromBase(static::$requestInstance);
        }

        $request = $app->make('swoole.http.request');

        static::$requestInstance =
            new SymfonyRequest($request->get, $request->post, [], $request->cookie, $request->files, $request->server);

        return static::createFromBase(static::$requestInstance);
    }
}