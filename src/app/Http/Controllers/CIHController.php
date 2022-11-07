<?php

namespace CIH\Core\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CIH\Core\App\Models\Ministry;

class MinistriesController extends Controller
{
  function index()
  {
    return view(resolve('folder'));
  }

  function store(Request $request)
  {
    $exists = Ministry::all();
    dd(count($exists));
  }
}
