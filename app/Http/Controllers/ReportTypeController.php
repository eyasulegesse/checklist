<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\ReportType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ReportTypeController extends Controller
{
    //
    public function index(Request $request)
    {
        $reporttype = ReportType::with(['department'])->orderBy('id', 'DESC')->get();
        $department = Department::orderBy('id', 'DESC')->get();
        return Inertia::render(
            'Admin/Pages/ReportType',
            [
                'reporttypes' => $reporttype,
                'departments' => $department
            ]
        );
    }
    public function store(Request $request)
    {

        $attr = $request->validate(
            [
                'name' => ['required'],
                'department_id' => ['required']
            ]
        );

        try {
            ReportType::create($attr);
            return redirect()->route('report.type.index');
        } catch (Exception $e) {
            dd($e);
            Log::channel('success')->error('IP: ' . $request->ip() . 'Message: ' . $e->getMessage());

            return redirect('/404');
        }
    }
}
