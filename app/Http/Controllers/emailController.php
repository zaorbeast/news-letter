<?php

namespace App\Http\Controllers;

use App\Models\emails;
use App\Models\application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\emailRessource;
use Exception;
use Illuminate\Support\Facades\Validator;

class emailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email = emails::paginate(10);
        return emailRessource::collection($email);
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

        $rules=array('email'=>'required','AppCode'=>'required');
        $validator=Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json( $validator->errors(),400);
        } else {
            $appCode=$request->AppCode;
            $app=DB::table('applications')
            ->where('applications.AppCode',hash("sha256",$appCode))
            ->select('applications.id')
            ->get();
            if(!$app->isEmpty()){
                try{
               // $AppCode3=hash("sha256",$appCode);
                $emails=new emails();
                $emails->email=$request->email;
                $emails->AppCode=hash("sha256",$request->AppCode);
                if ($emails->save()) {
                    return new emailRessource($emails);
                }
            }catch(Exception $e){
                return response()->json( $e,400);
            }
            }



    }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emails=emails::where('emails.key',$id)->paginate();
        return  emailRessource::collection($emails);
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
