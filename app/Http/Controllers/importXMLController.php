<?php

namespace App\Http\Controllers;

use App\Models\ImpXML;
use Illuminate\Http\Request;

class importXMLController extends Controller
{

    protected $request;
    private $repository;

    public function __construct(Request $request, ImpXML $xml)
    {
        $this->request    = $request;
        $this->repository = $xml;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.xml.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $xml = $this->request->only('xml');
        $xml = response()->json($xml);
        
        dd($xml);

        
        
        // $xml1 = array(['curso' => $xml]);

        
        // $xml  = $this->request->all('xml');

        // $xmlfile = file_get_contents($xml);
		// $ob= simplexml_load_string($xmlfile);
		// $teste = json_encode($ob);
		// $configData = json_decode($teste, true);

        // dd($configData); 


        // $json = $this->repository->namespacedXMLToArray($xml1);

        dd($xml);    

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
