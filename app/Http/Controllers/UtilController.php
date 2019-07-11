<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class UtilController extends Controller
{
    public function deploy(Request $request)
    {
        $root_path = base_path();
        $process = new Process('cd ' . $root_path . '; ./deploy.sh');
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });
    }
}
