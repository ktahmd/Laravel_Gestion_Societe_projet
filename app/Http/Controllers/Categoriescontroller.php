<?php

namespace App\Http\Controllers;
use App\models\categories;
use App\Exports\Exportcategories;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Excel;
use PDF;


class Categoriescontroller extends Controller
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
        $categories = categories::all();
        return view('categories.index');
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

        categories::create($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'categories Created'
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
        $categories = categories::where('id', $id)->first();

        return $categories;
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

        $categories = categories::findOrFail($id);
        $categories->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'categories Updated'
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
        categories::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'categories Delete'
        ]);
    }

    public function apicategories()
    {
        $categories = categories::all();

        return Datatables::of($categories)
            ->addColumn('action', function($categories){
                return '<a onclick="editForm('. $categories->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $categories->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['action'])->make(true);
    }



    public function exportcategoriesAll()
    {
        $categories = categories::all();
        $pdf = PDF::loadView('categories.categoriesAllPDF',compact('categories'));
        return $pdf->download('categories.pdf');
    }

    public function exportExcel()
    {
        return (new Exportcategories)->download('categories.xlsx'); 
    }
}


