<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         $categories = Category::all();
         return view('category.index', compact('categories'));
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('category.create');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|min:3|unique:categories',
         ]);

         $category = new Category();
         $category->name = $request->name;
         $category->slug = Str::slug($request->name);
         $category->status = 1;
         $category->save();

         return redirect()->route('category.index')->with('message', 'New category has been added successfully!');
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
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $category = Category::findOrFail($id);
         return view('category.edit', compact('category'));
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
         $request->validate([
             'name' => 'required|min:3',
         ]);

         $category = Category::findOrFail($id);
         $category->name = $request->name;
         $category->slug = Str::slug($request->name);
         $category->save();

         return redirect()->route('category.index')->with('message', 'Category updated successfully!');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $category = Category::find($id);
         $category->delete();
         return redirect()->back()->with('message', 'Category deleted successfully!');

     }
 }
