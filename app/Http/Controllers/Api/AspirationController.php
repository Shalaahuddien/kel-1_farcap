<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { {

            $aspirations = Aspiration::orderBy('is_read', 'asc')
                ->orderBy('created_at', 'DESC')
                ->get();

            return response()->json([

                "status" => true,
                "message" => "data Book",
                "data" => $aspirations
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payload = $request->all();

        $validator = Validator::make($payload, [
            'name'      => 'required|max:50',
            'email'     => 'required|email|max:50',
            'telephone'  => 'required|max:15',
            'address'      => 'required',
            'captcha' => 'required|captcha'
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = $photo->hashName();
            $photo->move('photo', $filename);
            $payload['photo'] = $request->getSchemeAndHttpHost() . "/photo/" . $filename;
        }

        $aspiration = Aspiration::create($payload);
        return response()->json([
            'status' => true,
            'message' => 'insert data Book success',
            'data' => $aspiration
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aspiration  $aspiration
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aspiration = Aspiration::find($id);
        $aspiration->fill([
            'is_read' => true,
        ]);
        $aspiration->save();
        return response()->json([
            'status' => true,
            'message' => 'show data buku',
            'data' => $aspiration
        ]);
    }
}
