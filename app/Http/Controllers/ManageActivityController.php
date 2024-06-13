<?php

namespace App\Http\Controllers;

use App\Models\ManageActivityEntity;
use Illuminate\Http\Request;

class ManageActivityController extends Controller
{
    public function index()
    {
        $kafaActivity = ManageActivityEntity::all();
        return view('ManageKafaActivity.kafaActivityList',compact("kafaActivity"));
    }

    public function kafaActivityList()
    {
        $kafaActivity = ManageActivityEntity::all();
        return view('ManageKafaActivity.kafaActivityList')->with('kafaActivity', $kafaActivity);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ManageKafaActivity.addKafaActivityForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_name' => 'required',
            'activity_studentAge' => 'required',
            ]);
        // dd($request);
        // $kafaActivity = new ManageActivityEntity();
        // $kafaActivity->activity_id = $request->activity_id;
        // $kafaActivity->activity_name = $request->activity_name;
        // $kafaActivity->activity_desc = $request->activity_desc;
        // $kafaActivity->activity_dateTime = $request->activity_dateTime;
        // $kafaActivity->activity_studentAge = $request->activity_studentAge;
        // $kafaActivity->activity_studentNum = $request->activity_studentNum;
        // $kafaActivity->activity_comment = $request->activity_comment;
        // $kafaActivity->user_id = auth()->id(); // Set the 'user id' to the currently authenticated user's id
        // $kafaActivity->save();

        ManageActivityEntity::create($request->all());
    
        return redirect()->route('kafaActivity')->with('success', 'Activity added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageActivityEntity $ManageActivityEntity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kafaActivity = ManageActivityEntity::find($id);
        return view('ManageKafaActivity.editKafaActivityForm', compact('kafaActivity'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        // Retrieve the existing record by its ID
        $kafaActivity = ManageActivityEntity::findOrFail($id);

        // Validate the incoming request
        $request->validate([
          'activity_name' => 'required',
            'activity_studentAge' => 'required|integer|min:1|max:120',
        ]);

        // Update the record with the new data
        $kafaActivity->update($request->all());
        return redirect()->route('kafaActivity')->with('success', 'Activity updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kafaActivity = ManageActivityEntity::find($id);
        $kafaActivity->delete();
        return redirect()->route('kafaActivity')->with('success', 'Activity deleted successfully');
    }
}
