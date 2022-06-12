<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Responsable_filiere;
use App\Models\Filiere;
use App\Models\Eleve;




class HomeController extends Controller
{
    //
    public function index(){
      $type=Auth::user()->type;
      if($type=='etudiant'){
          return view('user');
      }
      else if($type=='admin'){
          return view('admin');
      }
     else{
         return view('chef');
     }
    }

     
   /* public function show(){
        $usr=Auth::user();
        return view('user')->with('user',$usr);
    }*/


    public function addutilisateur(Request $request){
        $data=new user;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=bcrypt($request->password);
        $data->type=$request->type;
        $data->save();
        return redirect()->back();

    }
    public function addresponsable(Request $request){
        $data=new responsable_filiere();
        $data->nom=$request->Nom;
        $data->prenom=$request->Prenom;
        $data->departement=$request->Departement;
        $data->login=$request->Login;
        $data->save();
        return redirect()->back();

    }
    public function addfiliere(Request $request){
        $data=new filiere();
        $data->code=$request->code;
        $data->designation=$request->Designation;
        $data->responsable=$request->Responsable;
        $data->save();
        return redirect()->back();

    }

    public function addeleve(Request $request){
        $data=new eleve();
        $data->nom=$request->nom;
        $data->prenom=$request->prenom;
        $data->code=$request->code;
        $data->niveau=$request->niveau;
        $data->code_fil=$request->code_fil;
        $data->login_E=$request->login_E;

        $data->save();
        return redirect()->back();

    }

    public function getchef(){
       
        $users=DB::select("SELECT * from users where type='chef' ");
        return view('users')->with([
            'users'=>$users
        ]);
        
    }
    

    public function getEleve(){
       
        $eleves=DB::select("SELECT * from users where type='etudiant' ");
        return view('eleves')->with([
            'eleves'=>$eleves
        ]);
        
    }
    public function getstudent(){
        $students=DB::select("SELECT * from eleves");
        return view('students')->with([
            'students'=>$students
        ]);
    }
    public function getDstudent(){
        $Dstudents=DB::select("SELECT * from eleves where login_E='auth()->user()->id' ");
        return view('Detudiant')->with([
            'Dstudents'=>$Dstudents
        ]);
    }

    public function getresponsable(){
        $responsables=DB::select("SELECT * from responsable_filieres");
        return view('responsables')->with([
            'responsables'=>$responsables
        ]);
    }
    public function getfiliere(){
        $filieres=DB::select("SELECT * from filieres");
        return view('filieres')->with([
            'filieres'=>$filieres
        ]);
    }
    public function getDeleve(){
        $users = DB::table('users')
        ->join('eleves', 'users.id', '=', 'eleves.login_E')
        ->select('users.*', 'eleves.nom', 'eleves.prenom')
        ->where('users.id', '=', auth()->user()->id)

        ->get();
            return view('Detudiant')->with([
            'users'=>$users
        ]);
    }
    

    // public function update_form($id){
    //     return view('modify')->with('id', $id); 
    // }
    //  public function update( Request  $request){
       
    //     $users=DB::update("update users set email=? where id=?", [$_POST['email'] ,$id]);        
    //  }
       
    public function edit($id){
        $user=User::where('id',$id)->first();
        return view('edit')->with([
            'user'=>$user
        ]);
    }
    public function deleteE($id){
        $eleve=eleve::where('id',$id)->first();
        $eleve->delete();
        return redirect()->route('student')->with([
            'success'=>'eleve supprimer'
        ]); 
        
    }
    public function deleteR($id){
        $responsable=responsable_filiere::where('id',$id)->first();
        $responsable->delete();
        return redirect()->route('responsable')->with([
            'success'=>'respensable supprimer'
        ]); 
    }
    public function deleteF($id){
        $filiere=filiere::where('id',$id)->first();
        $filiere->delete();
        return redirect()->route('filiere')->with([
            'success'=>'filiere supprimer'
        ]); 
    }
    
   /* public function editR($id){
        $user=responsable_filiere::where('id',$id)->first();
        return view('editR')->with([
            'user'=>$user
        ]);
    }*/
    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=> 'required|min:4',
        ]);
         $user=User::where('id',$id)->first();
         $user->update([
             'name' => $request->name,
             'email' => $request->email
         ]);
         return redirect()->route('users')->with([
            'success'=>'modification effectuer'
        ]);     }

       /*  public function updatee(Request $request,$id){
            $this->validate($request,[
                'name'=> 'required|min:4',
            ]);
             $user=responsable_filiere::where('id',$id)->first();
             $user->update([
                 'nom' => $request->Nom,
                 'prenom' => $request->Prenom,
                 'departement' => $request->Departement,
                 'login' => $request->Login
             ]);
             return redirect()->route('responsable')->with([
                'success'=>'modification effectuer'
            ]);     }*/

}
