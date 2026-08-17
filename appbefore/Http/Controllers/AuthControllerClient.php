<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class AuthControllerClient extends Controller
{
    public function loginClient(Request $request)
    {
        //dd('HIIIIIIII');

        // validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // chercher client
        $client = Client::where('clientemail', $request->email)->first();

        // vérifier password
        if ($client && Hash::check($request->password, $client->clientPwd)) {

            session()->put('clientID', $client->clientID);
            session()->put('clientName', $client->clientFirstName);

            return redirect('/favoris');
        }

        return back()->with('error', 'Email ou mot de passe incorrect');
    }


    public function logoutClient()
    {
        session()->forget(['clientID', 'clientName']);

        return redirect('/inscription'); // ou page d'accueil
    }
    // REGISTER
    public function registerClient(Request $request)
    {
        // validation
        $request->validate([
            'clientFirstName' => 'required',
            'clientLastName' => 'required',
            'clientemail' => 'required|email|unique:client,clientemail',
            'clientPwd' => 'required|min:6|confirmed',
        ]);

        // insert client
        $client = Client::create([
            'clientFirstName' => $request->clientFirstName,
            'clientLastName' => $request->clientLastName,
            'clientemail' => $request->clientemail,
            'clientPwd' => Hash::make($request->clientPwd),
        ]);

        // session login auto
        session()->put('clientID', $client->clientID);
        session()->put('clientName', $client->clientFirstName);

        return redirect('/inscription')
            ->with('success', 'Compte créé avec succès');
    }

}