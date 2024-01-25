<?php

namespace App\Http\Controllers;

use App\Models\ReportType;
use App\Models\SendReport;
use App\Models\SendReportBy;
use App\Models\SendReportTo;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SendReportController extends Controller
{
    //

    public function sendReport(Request $request)
    {

        $userLists = User::orderBy('id', 'DESC')->get();
        $user_id = auth()->user()->id;
        $reportType = ReportType::orderBy('id', 'DESC')->get();
        $sendReports = SendReport::with(["sendReportTo.user", "sendReportBy.user"])
            ->whereHas('sendReportBy.user', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })->orderBy('id', 'DESC')->get();
        return  Inertia::render('Supervisor/Pages/SendReport', [
            'userLists' => $userLists,
            'reportTypes' => $reportType,
            'sendReports' => $sendReports
        ]);
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'report_title' => ['required'],
            'report_detail' => ['required'],
            'send_to' => ['required'],
            'date' => ['required'],

        ]);

        try {
            $user_id = auth()->user()->id;

            $sendReportBy = SendReportBy::create([
                'user_id' => $user_id,
            ]);

            $sendReportTo = SendReportTo::create([
                'user_id' => $attr['send_to'],
            ]);

            $sendReport = SendReport::create([
                'report_title' => $attr['report_title'],
                'report_detail' => $attr['report_detail'],
                'date' => $attr['date'],
                'send_report_by_id' => $sendReportBy->id,
                'send_report_to_id' => $sendReportTo->id

            ]);
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }

    public function incomingReport(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $sendReport = SendReport::with(['sendReportBy.user', 'sendReportTo.user'])
                ->whereHas('sendReportTo', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->orderBy('id', "DESC")->get();

            return Inertia::render(
                'Supervisor/Components/SendReport/IncomingReport',
                [
                    'sendReports' => $sendReport
                ]
            );
        } catch (Exception $e) {
            dd($e->getMessage());
            Log::channel('error')->error(' IP ' . $request->ip . ' Message: ' . $e->getMessage());
            return redirect('/404');
        }
    }
}
