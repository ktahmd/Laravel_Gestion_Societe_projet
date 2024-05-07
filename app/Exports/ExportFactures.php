<?php

namespace App\Exports;

use App\models\factures;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;


class Exportfactures implements FromView
{
    /**
     * melakukan format dokumen menggunakan html, maka package ini juga menyediakan fungsi lainnya agar dapat me-load data tersebut dari file html / blade di Laravel
     */
    use Exportable;

    public function view(): View
    {
        // TODO: Implement view() method.
        $commandes = Commandes::findOrFail($CM_ID);
        $client = $commandes->client->nom;
        $factures = Factures::where('commandes_id', $CM_ID)->get();
        $IDD=$CM_ID;
        $date=$commandes->created_at;
        return view('factures.facturesAllExcel',[
            'factures' => factures::all()
        ]);
    }
}
