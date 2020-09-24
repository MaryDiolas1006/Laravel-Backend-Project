<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subject;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if (Auth::check()) {
            $categories = Category::all();
            foreach ($categories as $category) {
                $subjects = Subject::where('category_id', $category->id)->get();
                $category->totalSubjects = count($subjects);
            }
            return view('categories.index')->with('categories', $categories);
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
        $this->authorize('create', Category::class);
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name,NULL,id,deleted_at,NULL',
        ]);
        $category = new Category($validatedData);
        $category->save();
        return redirect(route('categories.index'))->with('message', "{$category->name} category is added successfully!")->with('alert', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
         if (Auth::check()) {
            $subjects = Subject::where('category_id', $category->id)->get();
            foreach ($subjects as $subject) {
                $units = Unit::where('subject_id', $subject->id)->get();
                $availableUnits = Unit::where('status_id', 1)->where('subject_id', $subject->id)->get();
                $subject->available_stocks = count($availableUnits);
                $subject->total_stocks = count($units);
            }
            return view('categories.show')
                ->with('category', $category)
                ->with('subjects', $subjects);
        } else {
            return abort(403, 'This action is unauthorized.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
         $this->authorize('update', Category::class);
        return view('categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
       $this->authorize('update', $category);
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name,NULL,id,deleted_at,NULL'
        ]);
        $category->update($validatedData);
        $category->save();
        return redirect(route('categories.index', $category->id))->with('message', "category is updated successfully!")->with('alert', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
          $this->authorize('delete', $category);
        $category->delete();
        return redirect(route('categories.index'))->with('message', "{$category->name} category has been deleted.")->with('alert', 'warning');
    }
}
