<?php

/**
 * Created by PhpStorm.
 * User: chidow
 * Date: 2016/07/04
 * Time: 11:54 PM
 */
 class wpAPIObjects
{

    private $wpapi_objects = [];

    #TODO: Consider removing the method completely...add object directly
    public static function GetInstance()
    {

        wp_cache_add('wpAPIObjects', new wpAPIObjects());
        return wp_cache_get('wpAPIObjects');
    }

    public function AddObject($key, $object)
    {
        //TODO: check if key already exists

        $this->wpapi_objects[$key] = $object;
        wp_cache_set('wpAPIObjects', $this);
    }

    public function GetObject($key)
    {
        return $this->wpapi_objects[$key];
    }

    public function RemoveObject($key)
    {

    }

}