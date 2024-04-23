<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Piece;
use App\Models\Intervention;
use App\Models\User;
use App\Model\Equipement; 
use App\Model\Client;
use Yajra\DataTables\DataTables; 
use Illuminate\Support\Facades\DB;
use QCod\AppSettings\Setting\AppSettings;


class PieceController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Pièces remplacées';
        if($request->ajax()){
            $pieces = Piece::get();
            return DataTables::of($pieces)
                ->addIndexColumn()
                ->addColumn('designation',function($piece){
                    return $piece->designation;
                })
                ->addColumn('reference',function($piece){
                    return $piece->reference;
                })
                ->addColumn('numserie',function($piece){
                    return $piece->numserie;
                })
                ->addColumn('date_remplacement',function($piece){
                    return $piece->date_remplacement;
                })
                ->addColumn('qte',function($piece){
                    return $piece->qte;
                })
                ->addColumn('action', function ($row) {
                    $editbtn = '<a href="'.route("pieces.edit", $row->id).'" class="editbtn"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                    $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('pieces.destroy', $row->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                    if (!auth()->user()->hasPermissionTo('edit-piece')) {
                        $editbtn = '';
                    }
                    if (!auth()->user()->hasPermissionTo('destroy-piece')) {
                        $deletebtn = '';
                    }

                    $btn = $editbtn.' '.$deletebtn;
                    return $btn;
                }) 
                ->rawColumns(['designation','action'])
                ->make(true);
        }
        return view('admin.pieces.index',compact(
            'title'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($intervention_id)
    {
        $title = 'Ajouter pièce';
        $equipements= Equipement::get();
        $clients = Client::get();
        $sousequipements = Sousequipement::get();
        $intervention = Intervention::with('pieces')->findOrFail($intervention_id);
        return view('admin.interventions.show',compact(
            'title','intervention_id','intervention','users','equipements','clients','sousequipements '
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$intervention_id)
    {
        $this->validate($request,[
            'designation'=>'required',
            'date_remplacement'=>'required',
        ]);
        Piece::create([
            'designation'=>$request->designation,
            'reference'=>$request->reference,
            'numserie'=>$request->numserie,
            'date_remplacement'=>$request->date_remplacement,
            'qte'=>$request->qte,
            'intervention_id'=>$intervention_id,
            'client_id'=>$request->client,
            'equipement_id'=>$request->equipement,
            'sousequipement_id'=>$request->sousequipement,


        ]);
        $notifications = notify("Pièce ajoutée avec succès");
        return redirect()->route('interventions.show', ['intervention' => $intervention_id])->with($notifications);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Models\piece $piece
     * @return \Illuminate\Http\Response
     */
    public function edit(Piece $piece)
    {
        $title = 'modifier pièce';
        $piece = Piece::find($id);
        return view('admin.pieces.edit',compact(
            'title','piece','users'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\Models\Piece $piece
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Piece $piece)
    {
        $this->validate($request,[

            'designation'=>'required',
            'date_remplacement'=>'required',
        ]);
       
        $piece->update([
            'designation'=>$request->designation,
            'reference'=>$request->reference,
            'numserie'=>$request->numserie,
            'date_remplacement'=>$request->date_remplacement,
            'qte'=>$request->qte,
        ]);

        $notifications = notify("Pièce modifiée avec succès");
        return redirect()->back()->with($notifications);
    }
       /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return piece::findOrFail($request->id)->delete();
    }
}
