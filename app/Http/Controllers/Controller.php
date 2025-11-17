<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Base controller for the application.
 *
 * @method \Illuminate\Routing\Controller middleware($middleware, array $options = [])
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
