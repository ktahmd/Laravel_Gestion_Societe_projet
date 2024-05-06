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

        Commandes::create($request->all());

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
            'client_id'    => 'required|string|max:50',
            'date commande' => 'required|string|max:20',
        ]);

        $Commandes = Commandes::findOrFail($id);
        $Commandes->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Commandes Updated'
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
        Commandes::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Commandes Delete'
        ]);
    }

    public function apiCommandes()
    {
        $Commandes = Commandes::all();

        return Datatables::of($Commandes)
            ->addColumn('action', function($Commandes){
                return '<a onclick="editForm('. $Commandes->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $Commandes->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }



    public function exportCommandesAll()
    {
        $Commandes = Commandes::all();
        $pdf = PDF::loadView('Commandes.CommandesAllPDF',compact('Commandes'));
        return $pdf->download('Commandes.pdf');
    }

    public function exportExcel()
    {
        return (new ExportCommandes)->download('Commandes.xlsx'); 
    }
}


