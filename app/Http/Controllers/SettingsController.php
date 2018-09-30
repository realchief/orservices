<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Setting;
use App\Airtables;
use Image;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Sentinel;
use Route;

class SettingsController extends Controller
{
    protected function validator(Request $request,$id='')
    {
        return Validator::make($request->all(), [
          
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $settings = Setting::find(1);
        $airtables = Airtables::all();

        return view('backEnd.pages.settings', compact('settings', 'airtables'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        if ($this->validator($request,Sentinel::getUser()->id)->fails()) {
            
            return redirect()->back()
                    ->withErrors($this->validator($request))
                    ->withInput();
        }
        
        Setting::create($request->all());

        Session::flash('message', 'Page added!');
        Session::flash('status', 'success');

        return redirect('settings');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $page = Setting::findOrFail($id);

        return view('backEnd.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $page = Setting::findOrFail($id);

        return view('backEnd.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        // if ($this->validator($request,Sentinel::getUser()->id)->fails()) {
            
        //     return redirect()->back()
        //             ->withErrors($this->validator($request))
        //             ->withInput();
        // }
        
        $settings = Setting::find($id);

        $settings->airtable_name=$request->airtable_name;
        $settings->base_name=$request->base_name;
        $settings->api_key=$request->api_key;
        $settings->link=$request->link;
        $settings->note=$request->note;

        $settings->save();

        Session::flash('message', 'Settings updated!');
        Session::flash('status', 'success');

        return redirect('datasync');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        $page->delete();

        Session::flash('message', 'Page deleted!');
        Session::flash('status', 'success');

        return redirect('pages');
    }

    public function datasync()
    {
        $airtables = Airtables::all();

        return view('backEnd.datasync', compact('airtables'));
    }

}
