<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\RasHewan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\ResponseController;
use App\Http\Resources\RasHewanResource;
use Illuminate\Support\Facades\Validator;

class RasHewanAPIController extends ResponseController
{
    public function index()
    {
        try {
            $RasHewan = RasHewan::with('JenisHewan')->get();
            if (count($RasHewan) >= 1) {
                return $this->sendResponse(RasHewanResource::collection($RasHewan), 'Ada Data Ras Hewan');

              
            } else {
                return $this->sendResponse([], 'Data Ras Hewan Kosong');
            }
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }


    public function create()
    {
        //
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
            return $this->sendError('Validasi Error.', $validator->errors());
        } else {
            $RasHewan = RasHewan::create([

                'nama_ras'   => $request->nama_ras,
                'asal_ras'   => $request->asal_ras,
                'id_jenis_hewan'   => $request->id_jenis_hewan,
            ]);
    
            //return response
            return $this->sendResponse(new RasHewanResource($RasHewan), 'Ras Hewan Baru Telah Ditambahkan');
        }
        
       
    }


    public function show(RasHewan $RasHewanAPI)
    {
        return $this->sendResponse(new RasHewanResource($RasHewanAPI), 'Ras Hewan Telah Ditemukan');
    }


    public function edit(RasHewan $RasHewan)
    {
        //
    }


    public function update(Request $request, RasHewan $RasHewanAPI)
    {


        $input = $request->all();
        try {
            $validator = Validator::make($input, [
                'nama_ras' => 'required|min:4',
                'asal_ras' => 'required|min:3',
                'id_jenis_hewan' => 'required',
            ]);

            //check if validation fails
            if ($validator->fails()) {
                return $this->sendError('Validasi Error.', $validator->errors());
            } else {
                $RasHewanAPI->update([

                    'nama_ras'   => $request->nama_ras,
                    'asal_ras'   => $request->asal_ras,
                    'id_jenis_hewan'   => $request->id_jenis_hewan,
                ]);
                return $this->sendResponse(new RasHewanResource($RasHewanAPI), 'Ras Hewan Telah Diperbarui');
            }

            //update
          
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }


    public function destroy(RasHewan $RasHewanAPI)
    {
        try {

            $RasHewanAPI->delete();

            return $this->sendResponse([], 'Ras Hewan Telah dihapus.');
        } catch (Exception $e) {

            report($e);
            return false;
        }
    }

    public function search($RasHewan)
    {


        try {
            $result = RasHewan::with(['JenisHewan'])
                ->where('nama_ras', 'LIKE', '%' . $RasHewan . '%')
                ->orWhere('asal_ras', 'LIKE', '%' . $RasHewan . '%')
                ->orWhereHas('Jenishewan',  function ($query) use ($RasHewan) {
                    $query->where('id_jenis_hewan', 'LIKE', '%' . $RasHewan . '%');
                })
                ->get();

            $count = count($result);
            if (count($result)) {
                return $this->sendResponse(RasHewanResource::collection($result), 'Terdapat ' . $count . ' hasil pencarian');
            } else {
                return response()->json(['Data Not Found' => 'Gimana Ya , Datanya ga ada.'], 404);
            }
        } catch (Exception $e) {

            report($e);

            return false;
        }
    }
}
