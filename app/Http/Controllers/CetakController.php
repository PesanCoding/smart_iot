<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class CetakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Auth::user()->role_id;
            if ($role == 2) {
                    $user = Auth::user()->id;
                    $data = DB::table('sensors')
                    ->select(DB::raw("DATE_FORMAT(waktu, '%Y-%m-%d') as date"),
                        DB::raw('count(*) as jumlah'))
                    ->where('id_user','=',$user)
                    ->groupBy('date')
                    ->get();

                return view('pengguna.cetak.index',compact('data'));

            }elseif ($role == 1) {
                $user = Auth::user()->id;
                $data = DB::table('sensors')
                ->select(DB::raw("DATE_FORMAT(waktu, '%Y-%m-%d') as date"),
                    DB::raw('users.name'),
                    DB::raw('users.id'))
                ->join('users','users.id','=','sensors.id_user')
                ->orderBy('date','DESC')
                ->distinct()
                ->get();

                return view('cetak.index',compact('data'));
            }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function cetakPDF($tanggal)
    {

        $user = Auth::user()->id;
        $date = Carbon::now()->format('Y-m-d');
        $rata_suhu = DB::table('sensors')
        ->where('id_user','=',$user)
        ->whereDate('waktu','=',$tanggal)
        ->avg('suhu_udara');

        $rata_kel_udara = DB::table('sensors')
        ->where('id_user','=',$user)
        ->whereDate('waktu','=',$tanggal)
        ->avg('kel_udara');

        $rata_kel_tanah = DB::table('sensors')
        ->where('id_user','=',$user)
        ->whereDate('waktu','=',$tanggal)
        ->avg('kel_tanah');

        $data_control = DB::table('controls')
        ->where('id_user','=',$user)
        ->get();

        $data = DB::table('sensors')
        ->where('id_user','=',$user)
        ->whereDate('waktu','=',$tanggal)
        ->limit(50)
        ->get();
        // foreach ($data as $item) {
        //     $ph[] = $item->ph;
        //     $temp[] = $item->temp;
        // }

        $pdf = PDF::loadView('cetak.cetak_sensor',compact(
            'data',
            'rata_suhu',
            'rata_kel_udara',
            'rata_kel_tanah',
            'data_control',
            'tanggal'
        ));
        return $pdf->stream("data-sensor.pdf");

    }
    public function detaildata(Request $request)
    {
        $date = $request->date;
        $username = $request->name;
        $data = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->orderBy('id','DESC')
        ->get();

         $datacount = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->count();
        // rata rata
        $suhu_udara = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->avg('suhu_udara');

        $kel_udara = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->avg('kel_udara');

         $kel_tanah = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->avg('kel_tanah');
//      End Rata-rata
//      Max
        $suhu_udaraMax = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->max('suhu_udara');
        $kel_udaraMax = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->max('kel_udara');
        $kel_tanahMax = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->max('kel_tanah');
//      End Max
//      Min
        $suhu_udaraMin = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->min('suhu_udara');
        $kel_udaraMin = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->min('kel_udara');
        $kel_tanahMin = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->min('kel_tanah');
//      end Min
//      data_terakhir
        $dataterakhir = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->orderBy('id','DESC')
        ->limit(1)
        ->get();
//      end dataterakhir

        return view('cetak.detaildata',compact(
            'data',
            'date',
            'username',
            'suhu_udara',
            'kel_udara',
            'kel_tanah',
            'suhu_udaraMin',
            'kel_udaraMin',
            'kel_tanahMin',
            'suhu_udaraMax',
            'kel_udaraMax',
            'kel_tanahMax',
            'dataterakhir',
            'datacount'
        ));
    }
    public function cetakData(Request $request)
    {
        $date = $request->date;
        $username = $request->name;
        $data = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->orderBy('id','DESC')
        ->get();

         $datacount = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->count();
        // rata rata
        $suhu_udara = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->avg('suhu_udara');

        $kel_udara = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->avg('kel_udara');

         $kel_tanah = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->avg('kel_tanah');
//      End Rata-rata
//      Max
        $suhu_udaraMax = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->max('suhu_udara');
        $kel_udaraMax = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->max('kel_udara');
        $kel_tanahMax = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->max('kel_tanah');
//      End Max
//      Min
        $suhu_udaraMin = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->min('suhu_udara');
        $kel_udaraMin = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->min('kel_udara');
        $kel_tanahMin = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->min('kel_tanah');
//      end Min
//      data_terakhir
        $dataterakhir = DB::table('sensors')
        ->where('id_user','=',$request->id)
        ->whereDate('waktu','=',$request->date)
        ->orderBy('id','DESC')
        ->limit(1)
        ->get();
        $auth = Auth::user()->name;

        $pdf = PDF::loadView('cetak.cetakData',compact(
            'data',
            'date',
            'username',
            'suhu_udara',
            'kel_udara',
            'kel_tanah',
            'suhu_udaraMin',
            'kel_udaraMin',
            'kel_tanahMin',
            'suhu_udaraMax',
            'kel_udaraMax',
            'kel_tanahMax',
            'dataterakhir',
            'datacount',
            'auth'
        ));
        return $pdf->stream("data-sensor.pdf");
    }
}
