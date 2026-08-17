<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\TranslatorLogin;

class AuthController extends Controller
{
    // Affiche le formulaire login
    public function showLoginForm()
    {
        return view('login');
    }

    // Vérifie les informations et connecte l'utilisateur
    public function loginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:1,2,3', // 1=translator, 2=editor, 3=super_admin
        ]);

        $role = $request->role;

        // =========================
        // 1. editor =2 (table translator)
        // =========================
        if ($role == 1) {
            /* $translator = TranslatorLogin::where('translatorEmail', $request->email)
                 ->where('translatorStatus', 1)
                 ->first();

             if ($translator && Hash::check($request->password, $translator->translatorPWD)) {

                 Auth::guard('translator')->login($translator);

                 session([
                     'translatorID' => $translator->translatorID,
                     'translatorFirstName' => $translator->translatorFirstName,
                     'translatorLastName' => $translator->translatorLastName,
                 ]);

                 return redirect('/translator');
             }*/
            $translator = TranslatorLogin::where('translatorEmail', $request->email)->first();

            // Vérifier si l'email existe
            if (!$translator) {
                return back()->with('error', 'البريد الإلكتروني غير موجود.');
            }

            // Vérifier le mot de passe
            if (!Hash::check($request->password, $translator->translatorPWD)) {
                return back()->with('error', 'كلمة المرور غير صحيحة.');
            }

            // Vérifier si le compte est activé
            if ($translator->translatorStatus == 0) {
                return back()->with(
                    'error',
                    'حسابكم قيد المراجعة ولم تتم الموافقة عليه بعد. يرجى انتظار موافقة الإدارة، وسيصبح بإمكانكم تسجيل الدخول إلى حسابكم فور تفعيل الحساب.'
                );
            }

            // Connexion
            Auth::guard('translator')->login($translator);

            session([
                'translatorID' => $translator->translatorID,
                'translatorFirstName' => $translator->translatorFirstName,
                'translatorLastName' => $translator->translatorLastName,
            ]);

            return redirect('/translator');

            // return back()->with('error', 'Email ou mot de passe incorrect (translator).');
        }

        // =========================
        // 2. translator + ADMIN (table users)
        // =========================
        $user = User::where('email', $request->email)
            ->where('type', $role)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);

            switch ($user->type) {
                case 2:
                    return redirect('/editor');
                case 3:
                    return redirect('/admin');
                default:
                    Auth::logout();
                    return redirect()->route('login.form')
                        ->with('error', 'نوع الحساب غير صالح.');
            }
        }

        return back()->with('error', 'البريد الإلكتروني أو كلمة المرور غير صحيحة.');
    }

    // Déconnexion
    public function logout()
    {
        session()->forget('translatorID');
        session()->forget('translatorFirstName');
        session()->forget('translatorLastName');
        Auth::logout();
        return redirect()->route('login.form');
    }
}