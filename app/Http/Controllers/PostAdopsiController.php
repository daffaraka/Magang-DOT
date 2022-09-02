<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Response\ResponseController;
use App\Http\Resources\PostAdopsiResource;
use App\Http\Resources\RasHewanResource;
use App\Models\JenisHewan;
use App\Models\PostAdopsi;
use App\Models\RasHewan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr;

class PostAdopsiController extends ResponseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        try {
            $PostAdopsi = PostAdopsi::with('RasHewan.JenisHewan')->paginate(5);
            return view('dashboard.adopsi.adopsi-index', compact('PostAdopsi'));
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }


    public function create()
    {
        $JenisHewan = JenisHewan::all();
        return view('dashboard.adopsi.adopsi-create', compact('JenisHewan'));
    }

    public function getRasHewan(Request $request)
    {
        $data['findRasHewan'] = RasHewan::select('nama_ras', 'id_ras_hewan')->where('id_jenis_hewan', $request->id_jenis_hewan)
            ->orderBy('nama_ras', 'ASC')->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'nama_post'     => 'required|min:4',
                'lokasi'     => 'required|min:5',
                'syarat_adopsi'     => 'required|min:6',
                'id_ras_hewan'     => 'required',
            ]);

            //check if validation fails
            if ($validator->fails()) {
                return redirect()->back()->with('errors', $validator->errors());
            } else {
                PostAdopsi::create([

                    'nama_post'   => $request->nama_post,
                    'lokasi'   => $request->lokasi,
                    'syarat_adopsi'   => $request->syarat_adopsi,
                    'id_ras_hewan'   => $request->id_ras_hewan,
                ]);
                return redirect()->route('PostAdopsi.index')->with('success', 'Postingan Adopsi baru telah ditambahkan');
            }

            //return response
        } catch (Exception $e) {


            return $this->sendError([], 'Something Error with your input', 404);
        }
    }


    public function show($id)
    {
        $PostAdopsi = PostAdopsi::with('RasHewan.JenisHewan')->find($id);
        return $this->sendResponse(new  PostAdopsiResource($PostAdopsi), 'Post Ditemukan');
    }


    public function edit($id)
    {
        $JenisHewan = JenisHewan::all();
        $PostAdopsi = PostAdopsi::with('RasHewan.JenisHewan')->find($id);

        return view('dashboard.adopsi.adopsi-edit', compact(['PostAdopsi', 'JenisHewan']));
    }


    public function update($id, Request $request)
    {

        try {
            $PostAdopsi = PostAdopsi::with('RasHewan.JenisHewan')->find($id);

            $validator = Validator::make($request->all(), [
                'nama_post'     => 'required|min:4',
                'lokasi'     => 'required|min:5',
                'syarat_adopsi'     => 'required|min:6',
                'id_ras_hewan'     => 'required',
            ]);

            //check if validation fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), $validator->errors());
            }

            $PostAdopsi->update([

                'nama_post'   => $request->nama_post,
                'lokasi'   => $request->lokasi,
                'syarat_adopsi'   => $request->syarat_adopsi,
                'id_ras_hewan'   => $request->id_ras_hewan,
            ]);


            return redirect()->route('PostAdopsi.index')->with('success', 'Post Telah Diperbarui');
        } catch (Exception $e) {
            return response()->json($validator->errors(), $validator->errors());
        }
    }


    public function destroy($id)
    {
        try {

            $PostAdopsi = PostAdopsi::find($id);
            $PostAdopsi->delete();

            return redirect()->route('PostAdopsi.index')->with('success', 'Jenis Hewan Telah dihapus.');
        } catch (Exception $e) {

            report($e);
            return false;
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $PostAdopsi = PostAdopsi::with('RasHewan.JenisHewan')->get();

        if ($keyword != '') {
            $PostAdopsi = PostAdopsi::with('RasHewan.JenisHewan')
                ->where('nama_post', 'LIKE', '%' . $keyword . '%')
                ->orWhere('lokasi', 'LIKE', '%' . $keyword . '%')
                ->orWhere('syarat_adopsi', 'LIKE', '%' . $keyword . '%')
                ->orWhereHas('RasHewan',  function ($query) use ($keyword) {
                    $query->where('nama_ras', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('asal_ras', 'LIKE', '%' . $keyword . '%')
                        ->orWhereHas('JenisHewan', function ($query) use ($keyword) {
                            $query->where('id_jenis_hewan', 'LIKE', '%' . $keyword . '%')
                                ->orWhere('nama_jenis', 'LIKE', '%' . $keyword . '%');
                        });
                })
                ->get();
        }
        return response()->json([
            'PostAdopsi' => $PostAdopsi
        ]);
    }
}
