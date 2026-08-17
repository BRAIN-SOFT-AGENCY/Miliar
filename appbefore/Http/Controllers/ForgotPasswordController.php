<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Translator;
class ForgotPasswordController extends Controller
{
    public function sendLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $translator = Translator::where('translatorEmail', $request->email)->first();

        if (!$translator) {
            return back()->with('error', 'البريد الإلكتروني غير موجود');
        }

        $token = Str::random(64);

        DB::table('translator_reset_tokens')->updateOrInsert(
            [
                'translatorEmail' => $request->email
            ],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        $link = route('translator.reset.password', $token) . '?email=' . urlencode($request->email);
        $emailData = [
            'name' => $translator->translatorfirstName . ' ' . $translator->translatorLastName,
            'link' => $link
        ];

        Mail::send('emails.reset_password', $emailData, function ($message) use ($translator) {

            $message->to($translator->translatorEmail)
                ->subject('إعادة تعيين كلمة المرور');

        });

        return back()->with('success', 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني.');
    }
    public function showResetForm(Request $request, $token)
    {

        $email = $request->email;


        $reset = DB::table('translator_reset_tokens')
            ->where('translatorEmail', $email)
            ->where('token', $token)
            ->first();


        if (!$reset) {
            return redirect()->route('login')
                ->with('error', 'الرابط غير صالح');
        }


        // Vérification expiration 60 minutes

        if (Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {

            DB::table('translator_reset_tokens')
                ->where('translatorEmail', $email)
                ->delete();


            return redirect()->route('login')
                ->with('error', 'انتهت صلاحية الرابط، يرجى طلب رابط جديد');

        }


        return view('web.pages.reset-password', compact('email', 'token'));

    }
    public function updatePassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);


        // Vérifier le token
        $reset = DB::table('translator_reset_tokens')
            ->where('translatorEmail', $request->email)
            ->where('token', $request->token)
            ->first();


        if (!$reset) {

            return back()->with(
                'error',
                'الرابط غير صالح'
            );

        }


        // Modifier le mot de passe du translator

        Translator::where('translatorEmail', $request->email)
            ->update([

                'translatorPWD' => Hash::make($request->password)

            ]);



        // Supprimer le token après utilisation

        DB::table('translator_reset_tokens')
            ->where('translatorEmail', $request->email)
            ->delete();



        return redirect()
            ->route('login')
            ->with(
                'success',
                'تم تغيير كلمة المرور بنجاح'
            );

    }


}
