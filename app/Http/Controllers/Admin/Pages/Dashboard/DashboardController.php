<?php

namespace App\Http\Controllers\admin\pages\dashboard;

use App\Models\admin\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\editor\Editor;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(){
        $totalUser = User::count();
        $totalEditor = Editor::count();
        $totalAdmin =  Admin::count();

    \Log::info('Total Users: ' . $totalUser);
    \Log::info('Total Editors: ' . $totalEditor);
    \Log::info('Total Admins: ' . $totalAdmin);
        return view ('admin.dashboard',[
            'totalUser' =>$totalUser,
            'totalEditor'=>$totalEditor,
            'totalAdmin'=>$totalAdmin,
        ]);
    }
}
