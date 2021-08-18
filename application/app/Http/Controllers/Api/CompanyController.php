<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Company::all();
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
            'name'                  => ['required', 'string'],
            'email'                 => ['nullable', 'email', 'unique:companies'],
            'logo'                  => ['nullable'],
            'website'               => ['nullable', 'string']
        ]);
        if($data){
            if($data['logo'])
            {
                $image = $request->input('logo'); // image base64 encoded
                preg_match("/data:image\/(.*?);/",$image,$image_extension); // extract the image extension
                $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
                $image = str_replace(' ', '+', $image);
                $imageName = 'company_logo/'. time() . '.' . $image_extension[1]; //generating unique file name;
                Storage::disk('local')->put($imageName, base64_decode($image));
                $data['logo']= $imageName;
            }
            else
                $data['logo'] = null;

            Company::create($data);
            return response()->json(['message' => 'Company Profile Created'], 200);
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
        return Company::findOrfail($id);
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
            'name'                  => ['required', 'string'],
            'email'                 => ['nullable', 'string', "unique:companies,email,$id"],
            'website'               => ['nullable', 'string'],
            'logo'                  => ['nullable']
        ]);
        if($data){
            $prev = Company::findOrfail($id);
            $change = array();

            if($data['name'] != $prev->name)
                $change['name'] = $data['name'];

            if($data['email']){
                if($data['email'] != $prev->email)
                    $change['email'] = $data['email'];
            }

            if($data['logo']){
                $image = $request->input('logo'); // image base64 encoded
                preg_match("/data:image\/(.*?);/",$image,$image_extension); // extract the image extension
                $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
                $image = str_replace(' ', '+', $image);
                $imageName = 'company_logo/'. time() . '.' . $image_extension[1]; //generating unique file name;
                Storage::disk('local')->put($imageName, base64_decode($image));
                $change['logo']= $imageName;
            }

            if($data['website']){
                if($data['website'] != $prev->website)
                    $change['website'] = $data['website'];
            }

            if(sizeof($change) > 0){
                Company::where('id', $id)->update($change);
                return response()->json(['message' => 'Company Profile Updated'], 200);
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
        Company::destroy($id);
    }
}
