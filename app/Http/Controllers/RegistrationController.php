<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $registrations = Registration::all(); // Mengambil semua data registrasi
        return view('registration.index', compact('registrations')); // Mengirim data ke view
    }
}

?>
