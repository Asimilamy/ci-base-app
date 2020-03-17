<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Jenssegers\Blade\Blade;

/**
 * Render view in blade format
 * @param String $view
 * @param Mixed $data
 * @return Blade $blade
 */
if (!function_exists('view')) {
    function view(String $view, $data = [])
    {
        $view_path = APPPATH . 'views';
        $cache_path = APPPATH . 'cache';
        $blade = new Blade($view_path, $cache_path);

        return $blade->make($view, $data)->render();
    }
}


/* End of file view_helper.php */
