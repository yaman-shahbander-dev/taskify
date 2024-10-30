<?php

namespace App\Support\Bases;

use App\Http\Controllers\Controller;
use App\Support\Traits\GeneratesUuidTrait;
use App\Support\Traits\ResponseTrait;

class BaseController extends Controller
{
    use ResponseTrait;
    use GeneratesUuidTrait;
}
