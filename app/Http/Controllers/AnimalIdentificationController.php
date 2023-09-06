<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\AnimalIdentification;
class AnimalIdentificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
     
    //show all identification number
    public function index(){
        return response()->json(AnimalIdentification::all(), 200);
    }
    
    //create identification number if not exist
    public function create(Request  $request){
        $query =$request->input('identification_number');
        if(empty($query) || !is_numeric($query)){
            return response()->json(['data'=>array('message'=>'Animal identification number is not a number','success'=>'false')], 404);
        }
        $check_identification_number = AnimalIdentification::where('identification_number', '=',  $query)->first();
        if ( $check_identification_number !== null) {
            return response()->json(['data'=>array('message'=>'Animal identification number already exist', 'success'=>'false')], 422);
        }        
        AnimalIdentification::create(['identification_number'=> $query]);
        return response()->json(['data'=>array('message'=>'New animal identification number successfully created', 'success'=>'true')], 201);
    }
    
    //show identification number by its id
    public function show($id){
        $identification_number = AnimalIdentification::find($id);
        if(is_null($identification_number)){
            return response()->json(['data'=>array('message'=>'Animal identification number not found','success'=>'false')], 404);
        }
        
        return response()->json(['data'=>array('identification_number'=>$identification_number,'success'=>'true')], 200);
    }
    //update identification number by its id
    public function update(Request $request, $id){
        $identification_number = AnimalIdentification::find($id);
        if(is_null($identification_number)){
            return response()->json(['data'=>array('message'=>'Animal identification number not found','success'=>'false')], 404);
        }
        $query =$request->input('identification_number');
        if(empty($query) || !is_numeric($query)){
            return response()->json(['data'=>array('message'=>'Animal identification number is not a number','success'=>'false')], 404);
        }
        $check_identification_number = AnimalIdentification::where('identification_number', '=', $query)->first();
        if ( $check_identification_number !== null) {
            return response()->json(['data'=>array('message'=>'Animal identification number already exist','success'=>'false')], 422);
        }         

        $identification_number->update(['identification_number'=>$query]);
        return response()->json(['data'=>array('identification_number'=>array($identification_number),'success'=>'true')], 200);
    }
    
    public function delete($id){
        $identification_number = AnimalIdentification::find($id);
        if(is_null($identification_number)){
            return response()->json(['data'=>array('message'=>'Animal identification number not found','success'=>'false')], 404);
        }
        $identification_number->delete();
        return response()->json(['data'=>array('message'=>'Animal identification number successfully deleted','success'=>'true')], 204);        
    }

    //search by animal identification number if not exist
    public function search(Request  $request){
        $query =$request->input('identification_number');
        if(!empty($query) || is_numeric($query)){
            $identification_number = AnimalIdentification::where("identification_number", "LIKE", "%{$query}%")->get();
            if(is_null($identification_number)){
                return response()->json(['data'=>array('message'=>'Animal identification number not found','success'=>'false')], 404);
            }        
            return response()->json(['data'=>array('identification_number'=>$identification_number,'success'=>'true')], 200);
        }else{
            return response()->json(['data'=>array('message'=>'Animal identification number is not a number','success'=>'false')], 404); 
        }

    }    

}
