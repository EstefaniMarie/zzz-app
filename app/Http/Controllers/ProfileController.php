<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        $nombres = $user->persona->nombres;
        $cedula = $user->persona->cedula;
        $apellidos = $user->persona->apellidos;
        $nacimiento = $user->persona->fecha_nacimiento;
        $correo = $user->email;
        return view('profile.edit', [
            'user' => $user,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'nacimiento' => $nacimiento,
            'correo' => $correo,
            'cedula' => $cedula,
        ]);
    }

    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'current_password' => 'required|string',
                'password' => 'required|string|min:6|confirmed',
            ]);
            if (!Hash::check($request->current_password, Auth::user()->password)) {
                throw new \Exception('La contraseña actual no es correcta.');
            }
            Auth::user()->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('dashboard')->with('status', 'password-updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar la contraseña. Intente de nuevo.');
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
