<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyewaan_DetailModel;
use Illuminate\Support\Facades\Validator;

class Penyewaan_DetailController extends Controller
{
    protected $penyewaanDetailModel;

    public function __construct(Penyewaan_DetailModel $penyewaanDetailModel)
    {
        $this->penyewaanDetailModel = $penyewaanDetailModel;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $penyewaanDetails = $this->penyewaanDetailModel->all();

            if ($penyewaanDetails->isEmpty()) {
            {
                return response()->json([
                    'message' => 'Data Penyewaan Detail masih kosong',
                    'data' => $penyewaanDetails
                ], 200);
            }
        }
            return response()->json([
                'message' => 'Data Penyewaan Detail berhasil didapatkan',
                'data' => $penyewaanDetails
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada server'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
     {
         try {
             $validator = Validator::make($request->all(), [
                 'penyewaan_detail_penyewaan_id' => 'required|exists:penyewaan,penyewaan_id',
                 'penyewaan_detail_alat_id' => 'required|exists:alat,alat_id',
                 'penyewaan_detail_jumlah' => 'required|integer|min:1',
                 'penyewaan_detail_subharga' => 'required|integer|min:0',
             ]);

             if ($validator->fails()) {
                 return response()->json([
                     'message' => 'Validasi gagal',
                     'errors' => $validator->errors()
                 ], 422);
             } else {
                 $penyewaanDetail = $this->penyewaanDetailModel->create($validator->validated());

                 return response()->json([
                     'message' => 'Data penyewaan_detail berhasil dibuat',
                     'data' => $penyewaanDetail
                 ], 201);
             }
         } catch (\Exception $e) {
             return response()->json([
                 'message' => 'Terjadi kesalahan pada server'
             ], 500);
         }
     }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $penyewaanDetail = $this->penyewaanDetailModel->findOrFail($id);

            if (!$penyewaanDetail) {
                return response()->json([
                    'message' => 'Data Penyewaan Detail tidak ada'
                ], 404);
            }
            return response()->json([
                'message' => 'Data penyewaan_detail berhasil ditemukan',
                'data' => $penyewaanDetail
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data penyewaan_detail tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, $id)
     {
         try {
             $validator = Validator::make($request->all(), [
                 'penyewaan_detail_penyewaan_id' => 'required|exists:penyewaan,penyewaan_id',
                 'penyewaan_detail_alat_id' => 'required|exists:alat,alat_id',
                 'penyewaan_detail_jumlah' => 'required|integer|min:1',
                 'penyewaan_detail_subharga' => 'required|integer|min:0',
             ]);

             if ($validator->fails()) {
                 return response()->json([
                     'message' => 'Validasi gagal',
                     'errors' => $validator->errors()
                 ], 422);
             } else {
                 $penyewaanDetail = $this->penyewaanDetailModel->findOrFail($id);
                 $penyewaanDetail->update($validator->validated());

                 return response()->json([
                     'message' => 'Data penyewaan_detail berhasil diperbarui',
                     'data' => $penyewaanDetail
                 ], 200);
             }
         } catch (\Exception $e) {
             return response()->json([
                 'message' => 'Terjadi kesalahan pada server'
             ], 500);
         }
     }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id)
     {
         try {
             $penyewaanDetail = $this->penyewaanDetailModel->findOrFail($id);
             $penyewaanDetail->delete();

             return response()->json([
                 'message' => 'Data penyewaan_detail berhasil dihapus'
             ], 200);
         } catch (\Exception $e) {
             return response()->json([
                 'message' => 'Data penyewaan_detail tidak ditemukan'
             ], 404);
         }
     }
}
