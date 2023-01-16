<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $student = Students::all();

        return response()->json([
            'status' => true,
            'message' => 'Students retrieved successfully',
            'data' => $student
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            "fullname" => 'required|string|max:150',
            "program" => 'required|string|max:150',
            "age" => 'required|integer|min:1|max:150',
            "email" => 'required|string|max:150',
            "address" => 'required|string|max:150',
        ]);
        $student = Students::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Student created successfully',
            'data' => $student
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       $student = Students::find($id);
       if($student){
            return response()->json([
                'status' => true,
                'message' => 'Student found successfully',
                'data' => $student
            ], 201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Student not found',
                'data' => null
            ],404);
        }
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
        $data = $request->validate([
            "fullname" => 'nullable|string|max:150',
            "program" => 'nullable|string|max:150',
            "age" => 'nullable|integer|min:1|max:150',
            "email" => 'nullable|string|max:150',
            "address" => 'nullable|string|max:150',
        ]);

        $student = Students::find($id);

        if($student){
            $student->update($data);
            return response()->json([
                'status' => true,
                'message' => 'Student found successfully',
                'data' => $student
            ], 201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Student not found',
                'data' => null
            ],404);
        }
        
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
        $student = Students::find($id);

        if($student){
            $student->delete();
            return response()->json([
                'status' => true,
                'message' => 'Student deleted successfully',
                'data' => null
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Student not found',
                'data' => null
            ], 404);
        }
    }
}
