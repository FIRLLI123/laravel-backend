<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::select('id','name','email')->get();
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6', // Password wajib diisi minimal 6 karakter
        ]);
    
        // Simpan user dengan password yang sudah di-hash
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_by' => auth()->id(), // User yang sedang login
        ]);
    
        return response()->json($user, 201);
        //
    }


    public function storeMultiple(Request $request)
{
    $request->validate([
        '*.name' => 'required|string|max:255',
        '*.email' => 'required|email|unique:users',
        '*.password' => 'required|min:6',
    ]);

    $users = [];

    foreach ($request->all() as $userData) {
        $users[] = [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    User::insert($users); // Insert multiple users sekaligus

    return response()->json(['message' => 'Users added successfully'], 201);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::findOrFail($id));
        //
    }
    
    public function searchByName(Request $request)
    {
        $name = $request->query('name');
        $email = $request->query('email');// Ambil parameter `name`
        $users = User::where('name', 'LIKE', "%{$name}%")
        ->where('email',$email)
        ->get();

        if ($users->isEmpty()) {
            return response()->json([], 200); // Jika tidak ada hasil, kirim array kosong
        }

        return response()->json($users, 200);
    }
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'updated_by' => auth()->id(), // User yang mengupdate
    ]);

    return response()->json($user);
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id); // Hapus user berdasarkan ID
        return response()->json(null, 204); // Response kosong dengan status 204 (No Content)
        //
    }



    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Email atau password salah!'], 401);
    }

    // Buat token untuk user
    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json([
        'message' => 'Login berhasil!',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ],
        'token' => $token // Tambahkan token ke respons
    ]);
}

}
