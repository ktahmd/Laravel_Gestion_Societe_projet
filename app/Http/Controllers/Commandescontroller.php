<?php

namespace App\Http\Controllers;
use App\models\Commandes;
use App\Exports\ExportCommandes;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse; 
use Excel;
use PDF;


class Commandescontroller extends Controller
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
        $Commandes = Commandes::all();
        return view('Commandes.index');
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
        ]);

        $commandes = new Commandes();
        $commandes->client_id = $request->input('client_id');
        $commandes->prix_total = 0;
        $commandes->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Commandes Created'
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
        //
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
        $Commandes = Commandes::where('id', $id)->first();

        return $Commandes;
    }


    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Commandes::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Commandes Delete'
        ]);
    }

    public function apiCommandes()
    {
        
        $Commandes = Commandes::with('client')->get(); 
    
    return Datatables::of($Commandes)
        ->addColumn('client_nom', function($Commandes) {
            return $Commandes->client->nom ; 
        })
            
            ->addColumn('action', function($Commandes){
                return '<a onclick="openview('. $Commandes->id .')" class="btn btn-primary btn-xs"><i class="glyphicon ""></i>detailles</a>
                <a onclick="deleteData('. $Commandes->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }




    // public function updateToto($id)
    // {
    // $commande = Commandes::findOrFail($id);
    // $totalPaye = request()->input('totalPaye'); // corrected request parameter
    // $commande->prix_total = $totalPaye;
    // $commande->save();

    // return response()->json(['success' => true]);
    // }

}




