<?php

namespace App\Http\Controllers;
use App\models\factures;
use App\models\commandes;
use App\models\produit;
use App\Exports\Exportfactures;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Collective\Html\FormFacade as Form;
use Excel;
use PDF;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use PHPExcel_Worksheet;

class facturesController extends Controller
{
    public function __construct()
    {
    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factures = Factures::all();
        return view('factures.index', compact('factures'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'qty' => 'required|integer',
            'prix_total' => 'required|numeric',
        ]);
         
        $factures = new factures();
        $factures->client_id = $request->input('client_id');
        $factures->commandes_id = $request->input('client_id');
        $factures->Produit_id = $request->input('client_id');
        $factures->save();

        return response()->json([
            'success'    => true,
            'message'    => 'factures Created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Use where method to query the database
        $factures = factures::where('id', $id)->first();

        return $factures;
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
        $this->validate($request, [
            'qty' => 'required|integer',
            'prix_total' => 'required|numeric',
        ]);

        $factures = factures::findOrFail($id);
        $factures->update($request->all());
        

        return response()->json([
            'success'    => true,
            'message'    => 'factures Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        factures::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'factures Delete'
        ]);
    }

    public function apifactures()
    {
        $factures = factures::with('produit')->get(); 
    
            return Datatables::of($factures)
            ->addColumn('produit_nom', function($factures) {
                return $factures->produit->nom ; 
            })
            ->addColumn('prix_u', function($factures) {
                return $factures->produit->prix ; 
            })
            ->addColumn('TOTO', function($factures) {
                $Q=$factures->qty;
                $P=$factures->Produit->prix;
                return $Q*$P ; 
            })
            ->addColumn('action', function($factures){
                return '<a onclick="editForm('. $factures->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $factures->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }



    public function exportfacturesAll($CM_ID)
{
    $commandes = Commandes::findOrFail($CM_ID);
    $client = $commandes->client->nom;
    $factures = Factures::where('commandes_id', $CM_ID)->get();
    $IDD=$CM_ID;
    $date=$commandes->created_at;
    
    $pdf = PDF::loadView('factures.facturesAllPDF',compact('factures','client','commandes'));
    return $pdf->download('factures.pdf');
}



public function exportExcel($CM_ID)
{
    // Récupérer la commande et les informations nécessaires
    $commande = Commandes::findOrFail($CM_ID);
    $client = $commande->client->nom;
    $factures = Factures::where('commandes_id', $CM_ID)->get();
    $date = $commande->created_at;

    // Générer et télécharger le fichier Excel
    return Excel::download(function () use ($factures, $client, $date) {
        // Retourner la vue factures.facturesAllExcel avec les données nécessaires
        return view('factures.facturesAllExcel', compact('factures', 'client', 'date'));
    }, 'factures.xlsx');
}


    public function detailsCommandes($id)
{
    $commandes = Commandes::findOrFail($id);
    $client = $commandes->client->nom;
    $factures = Factures::where('commandes_id', $id)->get();
    $CM_ID=$id;
    return view('factures.commander', compact('commandes','CM_ID', 'client', 'factures'));
}

    
}

