<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use QCod\AppSettings\Setting\AppSettings;
use Illuminate\Support\Facades\DB;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'tâches complémentaires';
        if($request->ajax()){
            $taches = Tache::get();
            return DataTables::of($taches)
                ->addIndexColumn()
                ->addColumn('date',function($tache){
                    return $tache->date;
                })

                ->addColumn('type',function($tache){
                    return $tache->type;
                })

                ->addColumn('fournisseur',function($tache){
                    return $tache->fournisseur;
                })

                ->addColumn('user', function($tache) {
                    if (is_array($tache->user)) {
                        return implode(', ', $tache->user);
                    }
                    return $tache->user;
                })

                ->addColumn('commentaire',function($tache){
                    return $tache->commentaire;
                })

                ->addColumn('action', function ($row) {
                    $editbtn = '<a href="'.route("taches.edit", $row->id).'" class="editbtn"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                    $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('taches.destroy', $row->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';

                    if ($row->trashed()) {
                        $deletebtn = ''; // Or you can show a restore button
                    }
                    if (!auth()->user()->hasPermissionTo('edit-tache')) {
                        $editbtn = '';
                    }
                    if (!auth()->user()->hasPermissionTo('destroy-tache')) {
                        $deletebtn = '';
                    }
                    $btn = $editbtn.' '.$deletebtn;
                    return $btn;
                })
                ->rawColumns(['date','action'])
                ->make(true);
        }

        return view('admin.taches.index',compact(
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
        $title = 'ajouter tache';
        $users = User::whereIn('role', ['technicien', 'ingenieur','administrateur'])->get();
        return view('admin.taches.create',compact(
            'title','users'
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
        $this->validate($request,[
            'date'=>'required',

        ]);
        Tache::create([
            'date'=>$request->date,
            'type'=>$request->type,
            'fournisseur'=>$request->fournisseur,
            'commentaire'=>$request->commentaire,
            'user'=>$request->user,
        ]);

        $notification = notify("tache ajoutée avec succès");
        return redirect()->route('taches.index')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Models\Tache $tache
     * @return \Illuminate\Http\Response
     */
    public function edit(Tache $tach)
    {
        $title = 'edit tache';
        $users = User::whereIn('role', ['technicien', 'ingenieur','administrateur'])->get();
        return view('admin.taches.edit',compact(
            'title','tach','users'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\Models\Tache $tach
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Tache $tach)
    {
        $this->validate($request,[
            'date'=>'required'

        ]);

        $tach->update([
            'date'=>$request->date,
            'type'=>$request->type,
            'fournisseur'=>$request->fournisseur,
            'commentaire'=>$request->commentaire,
            'user'=>$request->user,

        ]);
        $notification = notify("tache modifié avec succès");
        return redirect()->route('taches.index')->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return Tache::findOrFail($request->id)->delete();
    }

}

