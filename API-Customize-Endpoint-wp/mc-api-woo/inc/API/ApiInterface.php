<?php

namespace Diva\API;

interface ApiInterface {

    /**
     * init_api
     *
     * @return void
     */
    public function init_api();

    /**
     * callback
     *
     * @return void
     */
    public function callback();

    /**
     * prefix_callback
     *
     * @return void
     */
    public function prefix_callback();

    /**
     * Get the callback used to validate a request to the REST API endpoint.
     *
     * @return callable
     */
    public function get_permission_callback();

    /**
     * Get the HTTP methods that the REST API endpoint responds to.
     *
     * @return mixed
     */
    public function get_methods();
}
