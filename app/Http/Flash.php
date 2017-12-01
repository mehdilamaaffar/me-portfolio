<?php

namespace App\Http;

/**
 * Flash a message to the client
 */
class Flash
{
    /**
     * return new instance of the current class
     *
     * @return Object
     */
    public static function make()
    {
        return new static;
    }

    public function message($message, $level)
    {
        session()->flash('flash_message_level', $level);
        session()->flash('flash_message', $message);
    }

    public static function success($message)
    {
        static::make()->message($message, 'success');

        return static::make();
    }

    public static function error($message)
    {
        static::make()->message($message, 'danger');

        return static::make();
    }

    /**
     * merge Redirect object with the current
     * for the fluent class API
     *
     * @param  string    $method      the method name
     * @param  string    $parameters  the method parameters
     * @return \Illuminate\Routing\Redirector
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array([app('redirect'), $method], $parameters);
    }
}
