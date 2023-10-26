<?php

namespace App\Http\Controllers;

use App\Models\{
    Volair,
    User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Carbon\Carbon;
use Yajra\DataTables\Contracts\DataTable;

class VolairController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $role = Auth::user()->role_id;
        if ($role == 1) {

        }else{
            $user = Auth::user()->id;
            if ($request->ajax()) {
                $data = Volair::select('id','id_user','volume_air','debit','waktu')
                ->orderBy('id','DESC')
                ->where('id_user','=',$user)
                ->get();
                return DataTables::of($data)->addIndexColumn()
                ->addColumn('id_user', function($data){
                    return $data->user->name;
                })
                ->addcolumn('volume_air', function($data){
                    return $data->volume_air ;
                })
                ->addcolumn('debit', function($data){
                    return $data->debit ;
                })
                ->removeColumn('id')
                ->make(true);
            }
            return view('volumeAir.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Volair $volair)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Volair $volair)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Volair $volair)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Volair $volair)
    {
        //
    }
    public function volume()
    {
        $user = Auth::user()->id;
                $volume = Volair::where('id_user','=' ,$user)
                ->whereDate('waktu', date('Y-m-d'))
                ->sum('volume_air');
                $debit = Volair::where('id_user','=' ,$user)
                ->whereDate('waktu', date('Y-m-d'))
                ->sum('debit');

            $respons = ['status' => 'success',
            'volume' => $volume,
            'debit' => $debit,
    ];
        return response()->json($respons,200);
    }

    public function rekapData()
    {
        $now = Carbon::now();
        $today = Carbon::today();

        $morning =  Carbon::today()->addHour(9) ; //recapped at 6 - 9 am
        $afternoon = Carbon::today()->addHour(12);
        $evening = Carbon::today()->addHour(21);

        if($now < $morning)
            $morning = $morning->subDay(1);
        if($now < $afternoon)
            $afternoon = $afternoon->subDay(1);
        if($now < $evening)
            $evening = $evening->subDay(1);

        return [
            'morning'   => $morning,
            'afternoon' => $afternoon,
            'evening'   => $evening,
            'now'       => $now,
            'today'     => $today
        ];

    }
}
