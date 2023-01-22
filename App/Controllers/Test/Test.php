<?php

namespace App\Controllers\Test;

use Illuminate\Http\Request;

class Test
{

    public function TestRoute(Request $request)
    {
        return 'Test page';
    }

}