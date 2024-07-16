<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Installation;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use QCod\AppSettings\Setting\AppSettings;
use Illuminate\Support\Facades\Cache; // 

class InstallationController extends Controller
{
     /**
     * Display a listing of the resource.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Installations';
        if($request->ajax()){
            $installations = Installation::get();
            return DataTables::of($installations)
                ->addIndexColumn()
                ->addColumn('client', function($installation) {
                    return $installation->client ? $installation->client->name : '';
                })

                ->addColumn('equipement',function($installation){
                    return $installation->equipement;
                })

              
                
                ->addColumn('date_debut',function($installation){
                    return $installation->date_debut;
                })
                ->addColumn('status',function($installation){
                    return $installation->status;
                })
                ->addColumn('description',function($installation){
                    return $installation->description;
                })

                ->addColumn('action', function ($row) {
                    $editbtn = '<a href="'.route("installations.edit", $row->id).'" class="editbtn"><button class="btn btn-primary" title="Modifier"><i class="fas fa-edit"></i></button></a>';
                    $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('installations.destroy', $row->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                    
                    if (!auth()->user()->hasPermissionTo('edit-installation')) {
                        $editbtn = '';
                    }
                    if (!auth()->user()->hasPermissionTo('destroy-installation')) {
                        $deletebtn = '';
                    }
                    $btn = $editbtn.' '.$deletebtn;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true); 
        }

        return view('admin.installations.index',compact(
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
        $clients = Client::all();
        $users = User::all();
        return view('admin.installations.create', compact('clients', 'users'));
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'client' => 'required|exists:clients,id',
            'equipement' => 'required|string|max:255',
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,id',
            'date_debut' => 'nullable|date',
            'date_pv_reception' => 'nullable|date',
            'date_fin_prevu' => 'nullable|date',
            'note' => 'nullable|string',
            'inputs' => 'nullable|array',
            'inputs.*.user_id' => 'nullable|array',
            'inputs.*.user_id.*' => 'exists:users,id',
            'inputs.*.date_debut' => 'nullable|date',
            'inputs.*.date_fin' => 'nullable|date',
            'inputs.*.comment' => 'nullable|string|max:255',
        ]);

        // Création de l'installation
        $installation = new Installation();
        $installation->client_id = $request->client;
        $installation->equipement = $request->equipement;
        $installation->date_debut = $request->date_debut;
        $installation->date_pv_reception = $request->date_pv_reception;
        $installation->date_fin_prevu = $request->date_fin_prevu;
        $installation->note = $request->note;
        $installation->save();

        // Attachement des techniciens à l'installation
        $installation->users()->attach($request->user_id);

        // Sauvegarde des détails des interventions
        if ($request->has('inputs')) {
            foreach ($request->inputs as $input) {
                $installation->interventions()->create([
                    'user_id' => $input['user_id'],
                    'date_debut' => $input['date_debut'],
                    'date_fin' => $input['date_fin'],
                    'comment' => $input['comment'],
                ]);
            }
        }

        return redirect()->route('installations.index')->with('success', 'Installation ajoutée avec succès.');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Models\installation $installation
     * @return \Illuminate\Http\Response
     */
    public function edit(Installation $installation)
    {
        $title = 'edit installation';
        $users = User::whereIn('role', ['technicien', 'ingenieur','administrateur'])->get();
        return view('admin.installations.edit',compact(
            'title','installation','users'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\Models\Installation $installation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Installation $installation)
    {
        $this->validate($request,[
            'date'=>'required'

        ]);

        $userId = $request->input('user_id');  // Fetch user_id from request
        // Ensure it's an integer
        $userId = is_array($userId) ? intval($userId[0]) : intval($userId);

        $installation->update([
            'client_id'=>$request->client,
            'equipement'=>$request->equipement,
            'user_id' => $userId,
            'date_debut'=>$request->date_debut,
            'status'=>$request->status,
            'description'=>$request->description,

        ]);
        $notification = notify("installation modifié avec succès");
        return redirect()->route('installations.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return Installation::findOrFail($request->id)->delete();
    }
}
