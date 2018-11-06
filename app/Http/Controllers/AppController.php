<?php
/**
 * Created by PhpStorm.
 * User: joaopaulo
 * Date: 06/11/18
 * Time: 11:38
 */

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
/**
 * Class AppController
 * @package App\Http\Controllers
 */
abstract class AppController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
