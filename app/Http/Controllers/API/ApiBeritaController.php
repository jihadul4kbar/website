<?php

namespace App\Http\Controllers\API;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\BeritaResource;
use App\Http\Controllers\API\BaseController;



class ApiBeritaController extends BaseController
{
    public function index(): JsonResponse
    {
        $beritas = Berita::all();
        return $this->sendResponse(BeritaResource::collection($beritas), 'Berita berhasil di ambil.');
    }
    
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
       
        $validator = Validator::make($input, [
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'required'
        ]);
       
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
       
        $beritas = Berita::create($input);
       
        return $this->sendResponse(new BeritaResource($beritas), 'Berita berhasil dibuat.');
    }

}
