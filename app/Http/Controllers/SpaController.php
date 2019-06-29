<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class SpaController extends Controller {
  public function __invoke() {
    return view('spa');
  }
}
