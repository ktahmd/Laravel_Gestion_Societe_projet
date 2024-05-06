<?php

namespace App\Http\Controllers;
use App\models\factures;
use App\Exports\Exportfactures;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Excel;
use PDF;

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
        $factures = factures::all();
        return view('factures.index');
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

        factures::create($request->all());

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
        $factures = factures::all();

        return Datatables::of($factures)
            ->addColumn('action', function($factures){
                return '<a onclick="editForm('. $factures->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $factures->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }



    public function exportfacturesAll()
    {
        $factures = factures::all();
        $pdf = PDF::loadView('factures.facturesAllPDF',compact('factures'));
        return $pdf->download('factures.pdf');
    }

    public function exportExcel()
    {
        return (new Exportfactures)->download('factures.xlsx'); 
    }
}

