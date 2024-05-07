<?php

namespace App\Http\Controllers;
use App\models\Produit;
use App\Exports\ExportProduit;;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Excel;
use PDF;

class Produitcontroller extends Controller
{
    //
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
        $Produit = Produit::all();
        return view('Produit.index');
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
            'nom' => 'required|string|min:2',
            'description' => 'required|string|max:50', 
            'prix' => 'required|numeric',
            'quantite_stock' => 'required|integer'
        ]);
    
        Produit::create($request->all());
    
        return response()->json([
            'success'    => true,
            'message'    => 'Produit Created'
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
        $produit = Produit::where('id', $id)->first();
    
        return $produit;
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
                'nom' => 'required|string|min:2',
                'description' => 'required|string|max:50', 
                'prix' => 'required|numeric',
                'quantite_stock' => 'required|integer'
            
            
        ]);
    
        $Produit = Produit::findOrFail($id);
        $Produit->update($request->all());
    
        return response()->json([
            'success'    => true,
            'message'    => 'Produit Updated'
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
        Produit::destroy($id);
    
        return response()->json([
            'success'    => true,
            'message'    => 'Produit Delete'
        ]);
    }
    


public function apiProduit()
{
    $Produit = Produit::with('categorie')->get(); 
    
    return Datatables::of($Produit)
        ->addColumn('categorie_nom', function($Produit) {
            return $Produit->categorie->nom ; 
        })
        
        ->addColumn('action', function($Produit) {
            return '<a onclick="editForm('. $Produit->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                '<a onclick="deleteData('. $Produit->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        })
        ->rawColumns(['action'])
        ->make(true);
}

    
    
    
    public function exportproduitAll()
    {
        $Produit = Produit::all();
        $pdf = PDF::loadView('Produit.ProduitAllPDF',compact('Produit'));
        return $pdf->download('Produit.pdf');
    }
    
    public function exportExcel()
    {
        return (new ExportProduit)->download('Produit.xlsx'); 
    }
    
    
}
