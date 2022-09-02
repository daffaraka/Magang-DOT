<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\PostAdopsi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\ResponseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostAdopsiResource;

class PostAdopsiAPIController extends ResponseController
{
    public function index()
    {
        try {
            $PostAdopsi = PostAdopsi::with('RasHewan.JenisHewan')->get();

            if (count($PostAdopsi) >= 1) {
                return $this->sendResponse(PostAdopsiResource::collection($PostAdopsi), 'Data Adopsi Tersedia');

               
            } else {
                return $this->sendError([], 'Data Post Adopsi Kosong');
            }
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }



    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_post'     => 'required|min:4',
                'lokasi'     => 'required|min:5',
                'syarat_adopsi'     => 'required|min:6',
                'id_ras_hewan'     => 'required',
            ]);

            //check if validation fails
            if ($validator->fails()) {
                return $this->sendError('Validasi Error', $validator->errors());
            }

            $PostAdopsi = PostAdopsi::create([

                'nama_post'   => $request->nama_post,
                'lokasi'   => $request->lokasi,
                'syarat_adopsi'   => $request->syarat_adopsi,
                'id_ras_hewan'   => $request->id_ras_hewan,
            ]);

            //return response
            return $this->sendResponse(new PostAdopsiResource($PostAdopsi), 'Postingan Adopsi baru telah ditambahkan');
        } catch (Exception $e) {


            return $this->sendError([], 'Something Error with your input', 404);
        }
    }


    public function show($id)
    {
        $PostAdopsi = PostAdopsi::with('RasHewan.JenisHewan')->find($id);
        return $this->sendResponse(new  PostAdopsiResource($PostAdopsi), 'Post Ditemukan');
    }



    public function update(Request $request,PostAdopsi $PostAdopsiAPI)
    {

        try {
            

            $validator = Validator::make($request->all(), [
                'nama_post'     => 'required|min:4',
                'lokasi'     => 'required|min:5',
                'syarat_adopsi'     => 'required|min:6',
                'id_ras_hewan'     => 'required',
            ]);

            //check if validation fails
            if ($validator->fails()) {
                return $this->sendError('Validasi Error', $validator->errors());
            } else {
                $PostAdopsiAPI->update([

                    'nama_post'   => $request->nama_post,
                    'lokasi'   => $request->lokasi,
                    'syarat_adopsi'   => $request->syarat_adopsi,
                    'id_ras_hewan'   => $request->id_ras_hewan,
                    
                ]);

                return $this->sendResponse(new PostAdopsiResource($PostAdopsiAPI), 'Post Telah Diperbarui');
    
            }

         

         
        } catch (Exception $e) {
            return response()->json($validator->errors(), $validator->errors());
        }
    }


    public function destroy(PostAdopsi $PostAdopsiAPI)
    {
        try {

            $PostAdopsiAPI->delete();

            return $this->sendResponse([], 'Jenis Hewan Telah dihapus.');
        } catch (Exception $e) {

            report($e);
            return false;
        }
    }

    public function search($PostAdopsi)
    {
        try {
            $result = PostAdopsi::with('RasHewan.JenisHewan')
                ->where('nama_post', 'LIKE', '%' . $PostAdopsi . '%')
                ->orWhere('lokasi', 'LIKE', '%' . $PostAdopsi . '%')
                ->orWhere('syarat_adopsi', 'LIKE', '%' . $PostAdopsi . '%')
                ->orWhereHas('RasHewan',  function ($query) use ($PostAdopsi) {
                    $query->where('nama_ras', 'LIKE', '%' . $PostAdopsi . '%')
                        ->orWhere('asal_ras', 'LIKE', '%' . $PostAdopsi . '%')
                        ->orWhereHas('JenisHewan', function ($query) use ($PostAdopsi) {
                            $query->where('nama_jenis', 'LIKE', '%' . $PostAdopsi . '%');
                        });
                })
                ->get();

            $count = count($result);
            if (count($result)) {
                return $this->sendResponse(PostAdopsiResource::collection($result), 'Terdapat ' . $count . ' hasil pencarian');
            } else {
                return response()->json(['Data Not Found' => 'Gimana Ya , Datanya ga ada.'], 404);
            }
        } catch (Exception $e) {

            report($e);

            return false;
        }
    }
}
