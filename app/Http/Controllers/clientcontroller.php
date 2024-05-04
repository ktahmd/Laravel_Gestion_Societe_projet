<?php

namespace App\Http\Controllers;
use App\models\client;
use App\Exports\ExportClient;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use PDF;

class clientController extends Controller
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
        $client = client::all();
        return view('client.index');
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
            'nom'      => 'required',
            'adresse'    => 'required',
            'email'     => 'required|unique:client',
            'telephone'   => 'required',
        ]);

        client::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'client Created'
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
        $client = client::find($id);
        return $client;
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
            'nom'      => 'required|string|min:2',
            'adresse'    => 'required|string|min:2',
            'email'     => 'required|string|email|max:255|unique:client',
            'telephone'   => 'required|string|min:2',
        ]);

        $client = client::findOrFail($id);

        $client->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'client Updated'
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
        client::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'client Delete'
        ]);
    }

    public function apiclient()
    {
        $client = client::all();

        return Datatables::of($client)
            ->addColumn('action', function($client){
                return '<a onclick="editForm('. $client->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $client->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }



    public function exportclientAll()
    {
        $client = client::all();
        $pdf = PDF::loadView('client.clientAllPDF',compact('client'));
        return $pdf->download('client.pdf');
    }

    public function exportExcel()
    {
        return (new ExportClient)->download('client.xlsx');
    }
}

