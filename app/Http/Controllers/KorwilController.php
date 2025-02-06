<?php
namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Korwil;
use Illuminate\Http\Request;

class KorwilController extends Controller
{
    public function index()
    {
        $korwils = Korwil::whereIn('id', [1, 2, 3])->get();
        return view('pages.tingkatan-sekolah', compact('korwils'));
    }

    public function listSD()
    {
        $korwils = Korwil::whereNotIn('id', [1, 2, 3])->get();
        return view('pages.tingkatan-sekolah', compact('korwils'));
    }

    public function list(Korwil $korwil)
    {
        switch ($korwil->id) {
            case 3:
                $sekolahs = Sekolah::where('jenis', 'SMP')->paginate(10);
                $title = 'DAFTAR SMP';
                return view('pages.list-sekolah', compact('korwil', 'sekolahs', 'title'));
            
            case 2:
                return $this->listSD();
            
            default:
                return redirect()->route('korwil.list-sekolah', $korwil);
        }
    }
}