<?php

namespace App\Http\Controllers\API;

use Exception;
use PhpParser\Node\Expr;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\JenisHewanResource;
use App\Http\Controllers\Response\ResponseController;

class JenisHewanAPIController extends ResponseController
{

    public function index()
    {
        try {
            $JenisHewan = JenisHewan::all();

            if (count($JenisHewan)>=1) {
                return $this->sendResponse(JenisHewanResource::collection($JenisHewan), 'Ada Jenis Hewan');
            } else {
                return $this->sendError('Data Kosong',[]);
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
        try {
            $validator = Validator::make($request->all(), [
                'nama_jenis'     => 'required|min:4',
            ]);
    
            //check if validation fails
            if ($validator->fails()) {
                return $this->sendError('Validasi Error', $validator->errors());
            }
    
    
            //create jenis hewan
            $JenisHewan = JenisHewan::create([
    
                'nama_jenis'   => $request->nama_jenis,
            ]);
    
            //return response
            return $this->sendResponse(new JenisHewanResource($JenisHewan), 'Jenis Hewan Baru Telah Ditambahkan');
        } catch (Exception $e)
        {
            return response()->json($validator->errors(), 'Error');

        }
    
    }


    public function show(JenisHewan $JenisHewanAPI)
    {
        try {
            return $this->sendResponse(new JenisHewanResource($JenisHewanAPI), 'Jenis Hewan Telah Ditemukan');

        } catch(Exception $e) {

            report($e);
            return false;
            // return response()->json([], 404,);
        }
    }


    public function edit(JenisHewan $JenisHewanAPI)
    {
        //
    }


    public function update(Request $request, JenisHewan $JenisHewanAPI)
    {


        $input = $request->all();
        try {
            $validator = Validator::make($input, [
                'nama_jenis' => 'required|min:4',
            ]);

            //check if validation fails
            if ($validator->fails()) {
                return $this->sendError('Validasi Error', $validator->errors());
            } else {
                $JenisHewanAPI->update([

                    'nama_jenis'   => $request->nama_jenis,
                ]);

                return $this->sendResponse(new JenisHewanResource($JenisHewanAPI), 'Jenis Hewan Telah Diperbarui');
            }

     
        } catch (Exception $e) {
            report($e);

            return true;
        }
    }


    public function destroy(JenisHewan $JenisHewanAPI)
    {
        try {

            $JenisHewanAPI->delete();

            return $this->sendResponse([], 'Jenis Hewan Telah dihapus.');
        } catch (Exception $e) {

            report($e);
            return false;
        }
    }


    public function search($JenisHewan)
    {

        try {
            $result = JenisHewan::where('nama_jenis', 'LIKE', '%' . $JenisHewan . '%')->get();

            $count = count($result);
            if (count($result)) {
                return $this->sendResponse(JenisHewanResource::collection($result), 'Terdapat ' . $count . ' hasil pencarian');
            } else {
                return response()->json(['Data Not Found' => 'Gimana Ya , Datanya ga ada.'], 404);
            }
        } catch (Exception $e) {

            report($e);

            return false;
        }
    }
}