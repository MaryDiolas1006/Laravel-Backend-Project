<?php

namespace App\Http\Controllers;
use App\Unit;
use App\UnitStatus;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $units = Unit::all();
            return view('units.index')->with('units', $units);
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
        $this->authorize('create', Unit::class);
        // return abort(404);
        $units = Unit::all();
        return view('units.create')
            ->with('units', $units);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->authorize('create', Unit::class);

        $control_code = $request->subject_id . '-' . $request->control_code;
        $request->request->add(['control_code' => $control_code]);
        $validatedData = $request->validate([
            'control_code' => 'required|string|unique:units,control_code',
            'subject_id' => 'required|numeric',
            // 'image' => 'required|image|max:2000'
        ]);

        $unit = new Unit($validatedData);

        // $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        // $request->image->move(public_path('/images/units'), $imageName);
        // $unit->image = $imageName;

        $unit->control_code = strtoupper($unit->control_code);
        $unit->save();

        return redirect(route('subjects.show', $unit->subject_id))->with('message', "Unit is added successfully!")->with('alert', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        if (Auth::check()) {
            return view('units.show')->with('unit', $unit);
        } else {
            return abort(403, 'This action is unauthorized.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
         $this->authorize('update', Unit::class);
        return view('units.edit')
            ->with('unit', $unit)
            ->with('subjects', Subject::all())
            ->with('statuses', UnitStatus::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $this->authorize('update', $unit);
        $validatedData = $request->validate([
            'subject_id' => 'required|numeric',
            'status_id' => 'required',
            // 'image' => 'required|image|max:2000'
        ]);

        $unit->update($validatedData);

        $unit->status_id = $request->status_id;

        // if ($request->hasFile('image')) {
        // $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        // $request->image->move(public_path('/images/units'), $imageName);
        // $unit->image = $imageName;
        // }

        $unit->save();

        return redirect(route('units.show', $unit->id))->with('message', "{$unit->control_code} is updated successfully!")->with('alert', 'info');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Unit $unit)
    {
        $this->authorize('delete', $unit);
        if ($request->session()->has('cart')) {

            session()->forget("cart.$unit->id");

            if (count(session()->get('cart')) === 0) {
                session()->forget('cart');
            }
        }

        $unit->delete();
        return redirect(route('units.index'))->with('message', "{$unit->control_code} has been deleted.")->with('alert', 'warning');
    }
}
