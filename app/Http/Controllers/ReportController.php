<?php

namespace App\Http\Controllers;
// use App\Models\Sale;
use Carbon\Carbon;
use App\Models\SalesItem;
// use Maatwebsite\Excel\Facades\Excel;

// use Barryvdh\DomPDF\Facade as PDF; // For PDF export
use Illuminate\Http\Request;
// use App\Models\Sale; // Your Sale model
use App\Exports\SalesExport; // Your SalesExport class
use Maatwebsite\Excel\Facades\Excel; // For Excel/CSV export
use Barryvdh\DomPDF\Facade\Pdf; // use App\Exports\SalesExport;

class ReportController extends Controller
{
    // Method to generate the daily report
    public function generateDailyReport(Request $request)
    {
        // Get today's sales data
        $sales = SalesItem::whereDate('created_at', today())->orderBy('created_at', 'asc')->get();
        $totalAmount = $sales->sum('total_price');

        return view('reports.daily', compact(['sales', 'totalAmount']));
    }

    // Method to generate the weekly report
    public function generateWeeklyReport(Request $request)
    {
        // Get sales data from the past week
        $sales = SalesItem::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->orderBy('created_at', 'asc')->get();

        $totalAmount = $sales->sum('total_price');

        return view('reports.weekly', compact(['sales', 'totalAmount']));
    }
    // Method to generate the weekly report
    public function generateMonthlyReport(Request $request)
    {
        // Get sales data from the past week
        $sales = SalesItem::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->orderBy('created_at', 'asc')->get();

        $totalAmount = $sales->sum('total_price');

        return view('reports.monthly', compact(['sales', 'totalAmount']));
    }

    public function generateAcademicReport(Request $request)
    {
        // $sales = SalesItem::where('academic_session', $request->academic_session);
        // Generate available sessions dynamically, e.g., from 2018/2019 to 2030/2031
        $currentYear = Carbon::now()->year;
        $startYear = 2020; // Example: start from 2018
        $endYear = $currentYear + 5; // Example: show sessions up to 5 years from now

        for ($year = $startYear; $year <= $endYear; $year++) {
            $nextYear = $year + 1;
            $availableSessions[] = "{$year}/{$nextYear}";
        }
        return view('reports.academic_year', compact(['availableSessions']));
    }

    public function downloadAcademic($type, Request $request){

        $request->validate([
            'academic_session_year' => 'required|string',
        ]);
        $sales = SalesItem::where('academic_session', $request->academic_session_year)->get();
        $reportOf = "Academic Year Session Report";

        $totalAmount = $sales->sum('total_price');
        if ($type === 'pdf') {
            $pdf = PDF::loadView('reports.download-pdf', compact(['sales', 'totalAmount', 'reportOf']));
            return $pdf->download(Carbon::now()->format('Y-m-d_h:i') . 'academic_session.pdf');
            // return redirect()->back()->with('message', 'Report is downloaded');
        }

        return redirect()->back()->with('error', 'Invalid download type');
    }
    public function downloadAcademicTerm($type, Request $request){

        $request->validate([
            'academic_session' => 'required|string',
            'term' => 'required|string'
        ]);

        $sales = SalesItem::where('academic_session', $request->academic_session)->where('term', $request->term)->get();
        $reportOf = "Academic Session and Terms Sales Report";

        $totalAmount = $sales->sum('total_price');
        if ($type === 'pdf') {
            $pdf = PDF::loadView('reports.download-pdf', compact(['sales', 'totalAmount', 'reportOf']));
            return $pdf->download(Carbon::now()->format('Y-m-d_h:i') . 'academic_session.pdf');
        } elseif ($type === 'excel') {
            return Excel::download(new SalesExport($sales), 'academic_session.xlsx');
        } elseif ($type === 'csv') {
            return Excel::download(new SalesExport($sales), 'academic_session.csv');
        }

        return redirect()->back()->with('error', 'Invalid download type');
    }

    // Method to download the report in various formats (PDF, CSV, Excel)
    public function download($type)
    {
        $sales = SalesItem::whereDate('created_at', today())->orderBy('created_at', 'asc')->get();
        $reportOf = "Daily Sales Report";

        $totalAmount = $sales->sum('total_price');
        if ($type === 'pdf') {
            $pdf = PDF::loadView('reports.download-pdf', compact(['sales', 'totalAmount', 'reportOf']));
            return $pdf->download(Carbon::now()->format('Y-m-d_h:i') . 'daily.pdf');
        } elseif ($type === 'excel') {
            return Excel::download(new SalesExport($sales), 'daily_report.xlsx');
        } elseif ($type === 'csv') {
            return Excel::download(new SalesExport($sales), 'daily_report.csv');
        }

        return redirect()->back()->with('error', 'Invalid download type');
    }
    public function downloadWeekly($type)
    {
        $sales = SalesItem::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->orderBy('created_at', 'asc')->get();
        $reportOf = "Weekly Sales Report";
        $totalAmount = $sales->sum('total_price');
        if ($type === 'pdf') {
            $pdf = PDF::loadView('reports.download-pdf', compact(['sales', 'totalAmount', 'reportOf']));
            return $pdf->download(Carbon::now()->format('Y-m-d_h:i') . 'weekly.pdf');
        }

        return redirect()->back()->with('error', 'Invalid download type');
    }
    public function downloadMonthly($type)
    {
        $sales = SalesItem::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->orderBy('created_at', 'asc')->get();
        $reportOf = "Monthly Sales Report";
        $totalAmount = $sales->sum('total_price');
        if ($type === 'pdf') {
            $pdf = PDF::loadView('reports.download-pdf', compact(['sales', 'totalAmount', 'reportOf']));
            return $pdf->download(Carbon::now()->format(format: 'Y-m-d_h:i') . 'monthly.pdf');
        }

        return redirect()->back()->with('error', 'Invalid download type');
    }
}
