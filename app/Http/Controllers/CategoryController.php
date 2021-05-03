<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DataTables;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Category::all();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $edit_btn = '<a href="javascript:;" id="editCategory" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail feedback">Update</a>';
          $delete_btn = '<a href="javascript:;" id="deleteCategory" class="btn-sm btn-danger" data-id="' . $row->id . '" data-original-title="detail feedback">Delete</a>';
          $actionBtn = $edit_btn . ' ' . $delete_btn;
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('category.index');
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
    Category::updateOrCreate(
      ['id' => $request->input('category_id')],
      ['category' => $request->input('category')]
    );

    return response()->json(['success' => 'Category saved successfully!']);
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
    $category = Category::find($id);
    return response()->json($category);
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

    return response()->json(['success' => 'Category deleted!']);
  }

  public function category_search(Request $request)
  {
    $category = [];
    if ($request->has('q')) {
      $search = $request->q;
      $category = Category::where('category', 'LIKE', "%$search%");
    } else {
      $category = Category::all();
    }
    return response()->json($category);
  }

  public function sub_topic_search(Request $request)
  {
    $sub_category = [];
    $trainer = User::find(auth()->user()->id);
    if ($request->has('q')) {
      $search = $request->q;
      $sub_category = $trainer->topic->where('topic', 'LIKE', "%$search%");
    } else {
      $sub_category = $trainer->topic;
    }
    return response()->json($sub_category);
  }
}
