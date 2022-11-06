<?php

namespace CIH\Ministries\App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CIH\Ministries\App\Models\Ministry;

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
