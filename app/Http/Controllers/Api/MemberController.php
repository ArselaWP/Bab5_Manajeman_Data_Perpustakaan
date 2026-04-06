<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member; // Import Model
use App\Http\Resources\MemberResource; // Import Resource
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    // 1. Menampilkan Semua Member
    public function index()
    {
        $members = Member::all();
        return MemberResource::collection($members)->additional([
            'success' => true,
            'message' => 'Daftar data member berhasil diambil'
        ]);
    }

    // 2. Menambah Member Baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|max:150',
            'member_code'   => 'required|unique:members,member_code',
            'email'         => 'required|email|unique:members,email',
            'status'        => 'required|in:active,inactive,suspended'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        $member = Member::create($request->all());

        return (new MemberResource($member))->additional([
            'success' => true,
            'message' => 'Member berhasil didaftarkan'
        ])->response()->setStatusCode(201);
    }

    // 3. Detail Member
    public function show($id)
    {
        $member = Member::find($id);
        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Member tidak ditemukan'
            ], 404);
        }

        return (new MemberResource($member))->additional([
            'success' => true,
            'message' => 'Detail member ditemukan'
        ]);
    }

    // 4. Update Member
    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Member tidak ditemukan'
            ], 404);
        }

        $member->update($request->all());

        return (new MemberResource($member))->additional([
            'success' => true,
            'message' => 'Data member berhasil diperbarui'
        ]);
    }

    // 5. Hapus Member (Tugas Khusus Logic)
    public function destroy(string $id)
{
    $member = Member::find($id);

    if (!$member) {
        return response()->json([
            'success' => false,
            'message' => 'Member tidak ditemukan.'
        ], 404);
    }

    // LOGIKA TUGAS: Cek status active
    // Gunakan === untuk pengecekan yang presisi
    if (trim(strtolower($member->status)) === 'active') {
        return response()->json([
            'success' => false,
            'message' => "Gagal menghapus! Member '{$member->name}' masih berstatus Active."
        ], 422);
    }

    $member->delete();

    return response()->json([
        'success' => true,
        'message' => "Member '{$member->name}' berhasil dihapus."
    ], 200);
}
}
