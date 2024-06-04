<?php

namespace App\Http\Controllers\Owner;

use ErrorException;
use App\Models\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mpdf\Mpdf;
use Auth;
use Session;
use App\Models\{Transaction, kamar, payment, User};

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // $kamar = Owner::select('')->where;
            // $owner = $users = DB::table('users as T1')
            //         ->select('T1.*', DB::raw('(SELECT COUNT(id) FROM kamars WHERE user_id = T1.id) as jumlah_properti'))
            //         ->leftJoin('kamars as T2', 'T1.id', '=', 'T2.user_id')
            //         ->where('T1.role', 'Pemilik')
            //         ->get();

            $data = [
                'title' => 'Laporan'
            ];

            // dd($owner);
            return view('admin.owner.laporan', compact('data'));
        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function cetak(Request $request)
    {
        $dateRange = $request->tanggal;
        $jenis = $request->jenis;

        // Step 1: Explode the date range string
        $dates = explode(' - ', $dateRange);

        if (count($dates) === 2) {
            // Step 2: Parse the dates using Carbon
//            $startDate = Carbon::createFromFormat('m/d/Y', $dates[0]);
//            $endDate = Carbon::createFromFormat('m/d/Y', );
            $start_date = $dates[0];
            $end_date = $dates[1];

            $start_date_c = \DateTime::createFromFormat('m/d/Y', $start_date);
            $end_date_c = \DateTime::createFromFormat('m/d/Y', $end_date);

            $startDate = Carbon::createFromFormat('m/d/Y', $start_date)->formatLocalized('%e %B %Y');
            $endDate = Carbon::createFromFormat('m/d/Y', $end_date)->formatLocalized('%e %B %Y');

        } else {
            return response()->json(['error' => 'Invalid date range format.'], 400);
        }

        try {
            // Create an instance of Mpdf
            $mpdf = new Mpdf();
            $role = Auth::user()->role;

            if ($role != 'Admin') {
                $booking = Transaction::with('payment')->where('pemilik_id', Auth::id())->whereBetween('tgl_sewa', [$start_date_c->format('Y-m-d'), $end_date_c->format('Y-m-d')])->orderBy('created_at', 'DESC')->get();
            } else {
                $booking = Transaction::with('payment')->whereBetween('tgl_sewa', [$start_date_c->format('Y-m-d'), $end_date_c->format('Y-m-d')])->orderBy('created_at', 'DESC')->get();
            }

            $data = ['title' => 'Laporan',
                'booking' => $booking,
                'start_date' => $startDate,
                'end_date' => $endDate];
            $mpdf->AddPage('L');
            // Write HTML content to the PDF
            // Render the Blade view to HTML
            $html = view('admin.owner.download', compact('data'))->render();

            // Write HTML content to the PDF
            $mpdf->WriteHTML($html);

            // Output the PDF
            $mpdf->Output();
//            $date = \DateTime::createFromFormat('m/d/Y', $start_date);
//            return $date->format('Y-m-d');

        } catch
        (\Mpdf\MpdfException $e) {
            return response()->json(['error' => 'PDF generation error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Owner $owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $owner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        //
    }
}
