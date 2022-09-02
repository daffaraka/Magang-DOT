<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Response\ResponseController;
use Exception;
use Throwable;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use App\Http\Resources\RasHewanResource;
use Illuminate\Support\Facades\Validator;

class RasHewanController extends ResponseController
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        $JenisHewan = JenisHewan::all();
        $RasHewan = RasHewan::with('JenisHewan')->paginate(5);

        return view('dashboard.rashewan.ras-hewan-index', compact(['RasHewan', 'JenisHewan']));
    }




    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ras' => 'required|min:4',
            'asal_ras' => 'required|min:3',
            'id_jenis_hewan' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return redirect()->route('RasHewan.index')->with('errors', $validator->errors());
        } else {
            RasHewan::create([

                'nama_ras'   => $request->nama_ras,
                'asal_ras'   => $request->asal_ras,
                'id_jenis_hewan'   => $request->id_jenis_hewan,
            ]);

            return redirect()->route('RasHewan.index')->with('success', 'Data Ras Baru telah ditambahkan');
        }

    }


    public function show(RasHewan $RasHewan)
    {
        return $this->sendResponse(new RasHewanResource($RasHewan), 'Ras Hewan Telah Ditemukan');
    }


    public function edit($id)
    {
        $JenisHewan = JenisHewan::all();
        $RasHewan = RasHewan::find($id);

        return view('dashboard.rashewan.edit-ras-hewan', compact(['RasHewan', 'JenisHewan']));
    }


    public function update(Request $request, $id)
    {

        try {
            $RasHewan = RasHewan::find($id);
            $validator = Validator::make($request->all(), [
                'nama_ras' => 'required|min:4',
                'asal_ras' => 'required|min:3',
                'id_jenis_hewan' => 'required',
            ]);

            //check if validation fails
            if ($validator->fails()) {
                return redirect()->back()->with('Error.', $validator->errors());
            }

            //update
            $RasHewan->update([

                'nama_ras'   => $request->nama_ras,
                'asal_ras'   => $request->asal_ras,
                'id_jenis_hewan'   => $request->id_jenis_hewan,
            ]);
            return redirect()->route('RasHewan.index')->with('success', 'Ras Hewan Telah Diperbarui');
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }


    public function destroy($id)
    {
        try {

            $RasHewan = RasHewan::find($id);
            $RasHewan->delete();

            return redirect()->back()->with('success', 'Ras Hewan Telah dihapus.');
        } catch (Exception $e) {

            report($e);
            return false;
        }
    }

    public function search(Request $request)
    {


        try {
            $keyword = $request->keyword;
            $RasHewan = RasHewan::with('JenisHewan')->get();

            if ($keyword != '') {
                $RasHewan = RasHewan::with('JenisHewan')
                                    ->where('nama_ras', 'LIKE', '%' . $keyword . '%')
                                    ->orWhere('asal_ras','LIKE','%'.$keyword.'%')
                                    ->orWhereHas('JenisHewan', function ($query) use ($keyword) {
                                        $query->where('id_jenis_hewan', 'LIKE', '%' . $keyword . '%')
                                            ->orWhere('nama_jenis', 'LIKE', '%' . $keyword . '%');
                                    })
                                    ->get();
            }
            return response()->json([
                'RasHewan' => $RasHewan
            ]);
        } catch (Exception $e) {

            report($e);

            return false;
        }
    }
}
