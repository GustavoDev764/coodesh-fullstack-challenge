<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\{SpaceFlightNews,Events,Launches};
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class SpaceFlightNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderBy = 'ASC';

        if(isset($request->orderBy) && $request->orderBy == 'DESC'){
            $orderBy = 'DESC';
        }

        $data = [];

        if(isset($request->search) && !empty($request->search)){
            $data = SpaceFlightNews::with('events','launches')
                            ->where('title','like','%'.$request->search.'%')
                            ->orWhere('summary','like','%'.$request->search.'%')
                            ->orderBy('updated_at', $orderBy)->paginate(10);
        }else{
            $data = SpaceFlightNews::with('events','launches')->orderBy('updated_at', $orderBy)->paginate(10);
        }       

        return response()->json([
            'status' => true,
            'data'   => $data
        ], 200);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = SpaceFlightNews::create($request->all());

            if(isset($request->events)){
                $eventsproviders = $request->events;
                $dataProviders = [];
                for ($i=0; $i < count($eventsproviders); $i++) { 
                    
                    $now = Carbon::now();
                    $dataProviders[]= [
                        'provider'             => $eventsproviders[$i]['provider'],
                        'space_flight_news_id' => $data->id,
                        'created_at'           => $now,
                        'updated_at'           => $now,
                    ];                    
                }

                Events::insert($dataProviders);

            }
            
            if(isset($request->launches)){
                $launchesproviders = $request->launches;
                $dataProviders = [];
                for ($i=0; $i < count($launchesproviders); $i++) { 
                    $now = Carbon::now();
                    $dataProviders[]= [
                        'provider'             => $launchesproviders[$i]['provider'],
                        'space_flight_news_id' => $data->id,
                        'created_at'           => $now,
                        'updated_at'           => $now,
                    ];                    
                }

                Launches::insert($dataProviders);
            }

            DB::commit();

            $data = SpaceFlightNews::with('events','launches')->find($data->id);

            return response()->json([
                'status'  => true,
                'message' => 'date created successfully',
                'data'    => $data,
            ], 201);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status'=>false,
                // 'message'=> $th->getMessage(),
                // 'line'=> $th->getLine(),
                'message'=> 'Erro no servido!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpaceFlightNews  $spaceFlightNews
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data = SpaceFlightNews::with('events','launches')->find($id);
        
        if(!$data){
            return response()->json([
                'status'=>false,
                'message'=>'data not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data'   => $data,
        ], 200);
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpaceFlightNews  $spaceFlightNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        DB::beginTransaction();
        try {
            
            $data = SpaceFlightNews::with('events','launches')->findOrfail($id);
            
            $data->fill($request->all())->save();

            if(isset($request->events)){
                $eventsproviders = $request->events;
                $dataProviders = [];
                $idSave = [];
                for ($i=0; $i < count($eventsproviders); $i++) { 
                    if(isset($eventsproviders[$i]['id'])){
                        $idSave[] = $eventsproviders[$i]['id'];
                        Events::where('id','=',$eventsproviders[$i]['id'])
                                ->update($eventsproviders[$i]);
                    }else{
                        $now = Carbon::now();
                        $dataProviders[]= [
                            'provider'             => $eventsproviders[$i]['provider'],
                            'space_flight_news_id' => $data->id,
                            'created_at'           => $now,
                            'updated_at'           => $now,
                        ]; 
                    }                   
                }

                if(count($idSave) > 0){
                    Events::where('space_flight_news_id','=',$data->id)->whereNotIn('id',$idSave)->delete();
                }   

                if(count($dataProviders) > 0){
                    Events::insert($dataProviders);
                }               

            }
            
            if(isset($request->launches)){
                $launchesproviders = $request->launches;
                $dataProviders = [];
                $idSave = [];
                for ($i=0; $i < count($launchesproviders); $i++) { 
                    $now = Carbon::now();

                    if(isset($eventsproviders[$i]['id'])){
                        $idSave[] = $eventsproviders[$i]['id'];
                        Launches::where('id','=',$eventsproviders[$i]['id'])
                                ->update($eventsproviders[$i]);                      
                        
                    }else{
                        $dataProviders[]= [
                            'provider'             => $launchesproviders[$i]['provider'],
                            'space_flight_news_id' => $data->id,
                            'created_at'           => $now,
                            'updated_at'           => $now,
                        ]; 
                    }                   
                }

                if(count($idSave) > 0){
                    Launches::where('space_flight_news_id','=',$data->id)->whereNotIn('id',$idSave)->delete();
                } 

                if(count($dataProviders) > 0){                    
                    Launches::insert($dataProviders);
                }
            }

            DB::commit();

            $dataUpdate = SpaceFlightNews::with('events','launches')->find($data->id);

            return response()->json([
                'status'  => true,
                'message' => 'date created successfully',
                'data'    => $dataUpdate
            ], 200);

        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status'=>false,
                //'message'=> $th->getMessage(),
                //'line'=> $th->getLine(),
                'message'=> 'Erro no servido!'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpaceFlightNews  $spaceFlightNews
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $data = SpaceFlightNews::withTrashed()->findOrFail($id);
        if($data->trashed()) {
            $data->restore(); 
            return response()->json([
                'status' => true
            ]);
        } else {
            $data->delete(); 
            return response()->json([
                'status' => true
            ]);
        }
    }
}
