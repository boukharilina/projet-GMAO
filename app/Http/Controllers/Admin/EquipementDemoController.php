<?php

namespace App\Http\Controllers\Admin;

use App\Models\equipementdemo;
use App\Models\Client;
use App\Models\Modalite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use QCod\AppSettings\Setting\AppSettings;
use Illuminate\Support\Facades\Cache; 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EquipementDemoExport;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\File;


class EquipementDemoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'equipements de Démo';
        /*
        // Vérifier si les données sont en cache
        if (Cache::has('equipementdemos_data')) {
            $equipementdemos = Cache::get('equipementdemos_data');
        } else {
            // Si les données ne sont pas en cache, les récupérer normalement
            $equipementdemos = EquipementDemo::get();

            // Mettre en cache les données pour une durée spécifiée (par exemple, 60 minutes)
            Cache::put('equipementdemos_data', $equipementdemos, 60);
        }*/
        if($request->ajax()){
            $equipementdemos = EquipementDemo::get();
            return DataTables::of($equipementdemos)
                ->addColumn('designation',function($equipementdemo){
                    return $equipementdemo->designation;
                })
                ->addColumn('modele',function($equipementdemo){
                    return '<a href="'.route("equipementdemos.show", $equipementdemo->id).'">'. $equipementdemo->modele .'</a>';
                })
                ->addColumn('numserie',function($equipementdemo){
                    return $equipementdemo->numserie;
                })
                ->addColumn('modalite',function($equipementdemo){
                    return $equipementdemo->modalite->name;
                })
                ->addColumn('date_entree',function($equipementdemo){
                    return $equipementdemo->date_entree;
                })
                ->addColumn('garantie',function($equipementdemo){
                    return $equipementdemo->garantie;
                })

                ->addColumn('action', function ($row) {
                    $editbtn = '<a href="'.route("equipementdemos.edit", $row->id).'" class="editbtn"><button class="btn btn-primary" title="Modifier"><i class="fas fa-edit"></i></button></a>';
                    $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('equipementdemos.destroy', $row->id).'" href="javascript:void(0)" id="deletebtn" title="Supprimer"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                    $viewbtn = '<a href="'.route("equipementdemos.show", $row->id).'" class="viewbtn"><button class="btn btn-success" title="Voir"><i class="fas fa-eye"></i></button></a>';
                    if ($row->trashed()) {
                        $deletebtn = ''; // Or you can show a restore button
                    }
                    if (!auth()->user()->hasPermissionTo('edit-equipementdemo')) {
                        $editbtn = '';
                    }
                    if (!auth()->user()->hasPermissionTo('destroy-equipementdemo')) {
                        $deletebtn = '';
                    }
                    if (!auth()->user()->hasPermissionTo('view-equipementdemo')) {
                        $viewbtn = '';
                    }

                    $btn = $editbtn.' '.$deletebtn.' '.$viewbtn;
                    return $btn;
                })
                ->rawColumns(['modele','action'])
                ->make(true);
        }
        return view('admin.equipementdemos.index',compact(
            'title'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'ajouter equipement de démo';
        $modalites = Modalite::get();
        return view('admin.equipementdemos.create',compact(
            'title','modalites'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $documentName = null;
        if($request->hasFile('fiche_technique')){
            $documentName = time().'.'.$request->document->extension();
            $request->document->move(public_path('storage/equipementdemos'), $documentName);
        }
        EquipementDemo::create([
            'code'=>$request->code,
            'modele'=>$request->modele,
            'marque'=>$request->marque,
            'designation'=>$request->designation,
            'numserie'=>$request->numserie,
            'modalite_id'=>$request->modalite_id,
            'date_entree'=>$request->date_entree,
            'garantie'=>$request->garantie,
            'fiche_technique'=>$documentName,
        ]);
        $notifications = notify("equipement de démo ajouté avec succès");
        return redirect()->route('equipementdemos.index')->with($notifications);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Models\EquipementDemo $equipementdemo
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipementDemo $equipementdemo)
    {
        $title = 'modifier equipement demo';
        $modalites = Modalite::get();
        return view('admin.equipementdemos.edit',compact(
            'title','equipementdemo','modalites'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\Models\EquipementDemo $equipementdemo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipementDemo $equipementdemo)
    {
        
        $documentName = $equipementdemo->document;
        if($request->hasFile('fiche_technique')){
            $documentName = time().'.'.$request->document->extension();
            $request->document->move(public_path('storage/equipementdemos'), $documentName);
        }
        $equipementdemo->update([
            'code'=>$request->code,
            'modele'=>$request->modele,
            'marque'=>$request->marque,
            'designation'=>$request->designation,
            'numserie'=>$request->numserie,
            'modalite_id'=>$request->modalite_id,
            'date_entree'=>$request->date_entree,
            'garantie'=>$request->garantie,
            'fiche_technique'=>$documentName,
        ]);
        $notifications = notify("equipement de démo modifié avec succès");
        return redirect()->route('equipementdemos.index')->with($notifications);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return equipementdemo::findOrFail($request->id)->delete();
    }

    public function show($id){
        $title = 'equipementdemo';
        $equipementdemo = EquipementDemo::findOrFail($id);
        $modalites = Modalite::get();
        return view('admin.equipementdemos.show',compact(
            'title','modalites','equipementdemo'
        ));
    }
    public function generatePdf()
    {
        $equipementdemos = EquipementDemo::all();
        $pdf = PDF::loadView('admin.equipementdemos.pdf', compact('equipementdemos'));
        return $pdf->download('equipementdemos.pdf');
    }
    
    public function generateExcel()
    {
        return Excel::download(new EquipementDemoExport, 'equipementdemos.xlsx');
    }


    
   
}
