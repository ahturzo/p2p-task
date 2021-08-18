<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::with('company')->get();
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
        $data = $request->validate([
            'first_name'                    => ['required', 'string'],
            'last_name'                     => ['required', 'string'],
            'company_id'                    => ['required', 'integer'],
            'email'                         => ['nullable', 'string', 'unique:employees'],
            'phone'                         => ['nullable', 'string', 'unique:employees'],
        ]);
        if($data) {
            Employee::create($data);
            return response()->json(['message' => 'Employee Profile Created'], 200);
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
        return Employee::findOrFail($id);
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
        $data = $request->validate([
            'first_name'                    => ['required', 'string'],
            'last_name'                     => ['required', 'string'],
            'company_id'                    => ['required', 'integer'],
            'email'                         => ['nullable', 'string', "unique:employees,email,$id"],
            'phone'                         => ['nullable', 'string', "unique:employees,phone,$id"],
        ]);
        if($data){
            $prev = Employee::findOrFail($id);
            $change = array();

            if($data['first_name'] != $prev->first_name)
                $change['first_name'] = $data['first_name'];

            if($data['last_name'] != $prev->last_name)
                $change['last_name'] = $data['last_name'];

            if($data['company_id'] != $prev->company_id)
                $change['company_id'] = $data['company_id'];

            if($data['email']){
                if($data['email'] != $prev->email)
                    $change['email'] = $data['email'];
            }

            if($data['phone']){
                if($data['phone'] != $prev->phone)
                    $change['phone'] = $data['phone'];
            }

            if(sizeof($change) > 0){
                Employee::where('id', $id)->update($change);
                return response()->json(['message' => 'Employee Profile Updated'], 200);
            }
            else
                return response()->json(['message' => 'Nothing to change'], 422);
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
        Employee::destroy($id);
    }
}
