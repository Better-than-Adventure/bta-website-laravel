<?php

namespace App\Http\Controllers;

use App\DataTables\PostTypesDataTable;
use App\Models\Post;
use App\Models\PostType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NavigationController extends Controller
{

    public function index()
    {

        return view('admin.navigation');
    }
}
