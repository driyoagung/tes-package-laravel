<?php

namespace Driyoagung\TesPackageLaravel\Http\Controllers;

use Illuminate\Routing\Controller;

class LandingPageController extends Controller
{
    public function __invoke()
    {
        return view('tes-package::landing');
    }
}
