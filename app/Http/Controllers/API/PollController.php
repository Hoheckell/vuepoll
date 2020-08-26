<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Option;
use App\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['polls'=>Poll::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'poll' => 'required'
        ]);

        try{
            DB::beginTransaction();

            $poll =  new Poll();
            $poll->description = $request->poll['poll_description'];
            $poll->save();
            foreach ($request->poll['options'] as $k=>$v){
                $option = new Option();
                $option->option_description = $v;
                $option->poll_id =$poll->id;
                $option->save();
            }
            DB::commit();
            return response()->json($poll);
        }catch (\Exception $e){
            DB::rollBack();
            $ex = new \stdClass();
            $ex->code = $e->getCode();
            $ex->message = $e->getMessage();
            $ex->line = $e->getLine();
            $ex->file = $e->getFile();
            return response()->json($ex);
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
        $poll = Poll::with('options')->find($id);
        if(empty($poll))
            abort(404);

        return response()->json(['poll'=>$poll]);;
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

    public function vote($id)
    {
        try {
            $option = Option::find($id);
            if (empty($option))
                abort(404);
            $option->votes += 1;
            $option->save();
            return response()->json($option);
        }catch (\Exception $e){
            $ex = new \stdClass();
            $ex->code = $e->getCode();
            $ex->message = $e->getMessage();
            $ex->line = $e->getLine();
            $ex->file = $e->getFile();
            return response()->json($ex);
        }

    }
}
