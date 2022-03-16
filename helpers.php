<?php

if (!function_exists('to_array')) {

    /**
     * Convert given array.
     *
     * @param $object
     * @return mixed
     */
    function to_array($object)
    {
        return json_decode(json_encode($object), true);
    }
}

if (!function_exists('to_object')) {
    /**
     * Convert given array.
     *
     * @param $array
     * @return mixed
     */
    function to_object($array)
    {
        return json_decode(json_encode($array));
    }
}

if (!function_exists('is_prod')) {
    /**
     * Проверка на если прод
     *
     * @return string
     * @throws Exception
     */
    function is_prod()
    {
        return env('APP_ENV') === 'production';
    }
}
