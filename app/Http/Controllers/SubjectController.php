<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Category;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $subjects = Subject::all();
            $category = Category::first();
            foreach ($subjects as $subject) {
                $units = Unit::where('subject_id', $subject->id)->get();
                $availableUnits = Unit::where('status_id', 1)->where('subject_id', $subject->id)->get();
                $subject->available_stocks = count($availableUnits);
                $subject->total_stocks = count($units);
            }
            return view('subjects.index')
                ->with('subjects', $subjects)
                ->with('category', $category);
        } else {
            return abort(403, 'This action is unauthorized.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Subject::class);
        $categories = Category::all();
        return view('subjects.create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Subject::class);


        $validatedData = $request->validate([
            'name' => 'required|unique:subjects,name,NULL,id,deleted_at,NULL',
            'category_id' => 'required|numeric',
            'image' => 'required|image|max:2000'
        ]);
        $subject = new Subject($validatedData);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('/images/subjects'), $imageName);
        $subject->image = $imageName;

        $subject->save();
        $subjectAll = Subject::all();
        return redirect(route('subjects.index'))->with('message', "{$subject->name} subject is added successfully!")->with('alert', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        if (Auth::check()) {
            $units = Unit::where('subject_id', $subject->id)->get();
            $availableUnits = Unit::where('status_id', 1)->where('subject_id', $subject->id)->get();
            $subject->available_stocks = count($availableUnits);
            $subject->total_stocks = count($units);
            $subject->save();
            return view('subjects.show')
                ->with('subject', $subject)
                ->with('units', $units);
        } else {
            return abort(403, 'This action is unauthorized.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
         $this->authorize('update', Subject::class);
        return view('subjects.edit')->with('subject', $subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $this->authorize('update', $subject);
        $validatedData = $request->validate([
            'name' => 'required|unique:subjects,name,NULL,id,deleted_at,NULL',
            'category_id' => 'required|numeric',
            'image' => 'required|image|max:2000'
        ]);
        $subject->update($validatedData);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('/images/subjects'), $imageName);
            $subject->image = $imageName;
        }

        $subject->save();
        return redirect(route('subjects.index', $subject->id))->with('message', "Subject is updated successfully!")->with('alert', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
         $this->authorize('delete', $subject);
        $subject->delete();
        return redirect(route('subjects.index'))->with('message', "{$subject->name} subject has been deleted.")->with('alert', 'warning');
    }
}
