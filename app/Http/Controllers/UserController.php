<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['create', 'store']);
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'foto'     => 'nullable|image|max:2048',
            'role'     => 'required|in:admin,guest',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('user-photos', 'public');
        } else {
            $data['foto'] = null;
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()
            ->route('users.index')
            ->with('status', 'User baru berhasil ditambahkan.')
            ->with('status_type', 'success');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('status', 'User berhasil dihapus.')
            ->with('status_type', 'success');
    }


    // Register user baru
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['foto'] = null;
        $data['role'] = 'guest';

        $user = User::create($data);

        Auth::login($user);

        return redirect()
            ->route('home')
            ->with('status', 'Pendaftaran berhasil! Selamat datang di KKB.')
            ->with('status_type', 'success');
    }

    // Cek login user
    public function login(){
        return view('auth.login');
    }


    public function checkLogin(Request $request){
        if(!Auth::attempt(['email' => $request ->email,'password'=> $request ->password]))
            {
                return redirect()
                    ->route('login')
                    ->with('status','Login gagal! Periksa kembali email dan password anda.')
                    ->with('status_type', 'danger');
            }
            else{
                // Redirect berdasarkan role
                if (auth()->user()->isAdmin()) {
                    return redirect()->route('keyboards.index');
                } else {
                    return redirect()->route('home');
                }
            }

        }

    // Logout user
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('status','Anda telah logout.')->with('status_type','success');
    }

    /**
     * Update password user yang sedang login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => ['required'],
            'new_password'          => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->with('status', 'Password saat ini tidak sesuai.')
                ->with('status_type', 'danger');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()
            ->with('status', 'Password berhasil diperbarui.')
            ->with('status_type', 'success');
    }

    /**
     * Show the form for editing profile.
     *
     * @return \Illuminate\View\View
     */
    public function editProfile()
    {
        return view('profile.edit');
    }

    /**
     * Update user profile (name, address, phone, foto).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string|max:1000',
            'phone'   => 'nullable|string|max:20',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.required' => 'Nama harus diisi',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto if exists
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            $data['foto'] = $request->file('foto')->store('user-photos', 'public');
        }

        $user->update($data);

        return back()
            ->with('status', 'Profile berhasil diperbarui.')
            ->with('status_type', 'success');
    }

}
