<?php

namespace App\Http\Controllers\API;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Validator;
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
            'gambar' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $beritas = Berita::create($input);
        return $this->sendResponse(new BeritaResource($beritas), 'Berita berhasil dibuat.');
    }

    public function show($id): JsonResponse
    {
        $beritas = Berita::find($id);
      
        if (is_null($beritas)) {
            return $this->sendError('Berita tidak ditemukan.');
        }
       
        return $this->sendResponse(new BeritaResource($beritas), 'Berita berhasil di ambil.');
    }

    public function update(Request $request, $id): JsonResponse
    {
        $beritas = Berita::find($id);
        if (is_null($beritas)) {
            return response()->json(['message' => 'Berita tidak di temukan'], 404);
        }
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'required'
        ]);
        $beritas->update($request->all());
        return $this->sendResponse(new BeritaResource($beritas), 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $beritas = Berita::find($id);

        if (is_null($beritas)) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }
        $beritas->delete();
        return $this->sendResponse(new BeritaResource($beritas), 'Berita berhasil dihapus');
    }

}
