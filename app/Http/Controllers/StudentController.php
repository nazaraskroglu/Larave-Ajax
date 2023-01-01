<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $students=Student::get();
        if($request->ajax()){
            $allData=DataTables::of($students)
                ->addIndexColumn()
                ->addColumn('update',function($row){
                    $btn = '<button href="javascript:void(0)" data-toggle="tooltip" value="'.
                    $row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editStudent">Edit</button>';
                    return $btn;
                })
                ->addColumn('delete',function($row){
                    $btn = '<button href="javascript:void(0)" data-toggle="tooltip" value="'.
                    $row->id.'" data-original-title="Delete" class="edit btn btn-danger btn-sm deleteStudent">Delete</button>';
                    return $btn;
                })
            ->rawColumns(['update','delete'])
            ->make(true);
            return $allData;

        }
        return view('home',compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Student::updateOrCreate(
            [
               'name'=>$request->name,
               'surname'=>$request->surname,
               'city'=>$request->city
            ]);
        return response()->json(['success']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student=Student::find($id);
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'surname' => 'required|min:3',
            'city' => 'required',
        ]);
        Student::where('id', $request->id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'city' => $request->city,
        ]);
        return response()->json(['Success' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student=Student::find($id);
        $student->delete();
        return response()->json(['Success' => 'success']);
    }

}
