<?php

namespace App\Http\Controllers;
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
                'description' => 'nullable|string|max:50', // 'description' peut être nullable
                'prix' => 'required|numeric|max:50|unique:produit,prix,' . $request->id,
                'categorie_id' => 'required|string|max:20',
                'quantite_stock' => 'required|integer|max:20'
            
            
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
        $Produit = Produit::all();
    
        return Datatables::of($Produit)
            ->addColumn('action', function($Produit){
                return '<a onclick="editForm('. $Produit->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $Produit->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
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