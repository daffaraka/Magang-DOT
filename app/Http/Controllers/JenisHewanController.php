<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\JenisHewanResource;
use Exception;
use App\Http\Controllers\Response\ResponseController;

class JenisHewanController extends ResponseController
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $JenisHewan = JenisHewan::latest()->paginate(5);

            return view('dashboard.jenis-hewan.jenis-hewan-index', compact('JenisHewan'));
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }


    public function create()
    {

        return view('dashboard.jenis-hewan.create-jenis-hewan');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jenis'     => 'required|min:4',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), $validator->errors());
        } else {
            JenisHewan::create([

                'nama_jenis'   => $request->nama_jenis,
            ]);

            return redirect()->route('JenisHewan.index');
        }
    }


    public function edit(JenisHewan $JenisHewan, $id)
    {
        $JenisHewan = JenisHewan::find($id);

        return view('dashboard.jenis-hewan.edit-jenis-hewan', compact('JenisHewan'));
    }


    public function update(Request $request, $id)
    {

        try {
            $validator = Validator::make($request->all(), [
                'nama_jenis' => 'required|min:4',
            ]);

            //check if validation fails
            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            } else {
                $JenisHewan = JenisHewan::find($id);
                $JenisHewan->update([

                    'nama_jenis'   => $request->nama_jenis,
                ]);

                return redirect()->route('JenisHewan.index')->with('success', 'Data Telah Diperbarui');
            }
        } catch (Throwable $e) {
            report($e);

            return true;
        }
    }


    public function destroy($id)
    {
        try {
            $JenisHewan = JenisHewan::find($id);
            $JenisHewan->delete();

            return redirect()->route('JenisHewan.index')->with('success', 'Data Telah Dihapus');
        } catch (Exception $e) {

            return redirect()->route('JenisHewan.index')->with('error', 'Data Gagal Dihapus');
        }
    }


    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $JenisHewan = JenisHewan::all();

        if ($keyword != '') {
            $JenisHewan = JenisHewan::where('nama_jenis', 'LIKE', '%' . $keyword . '%')->get();
           
        }
        return response()->json([
            'JenisHewan' => $JenisHewan
        ]);
    }
}
