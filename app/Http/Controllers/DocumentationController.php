<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentation;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use DataTables;

class DocumentationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $roles = Role::all();
    if ($request->ajax()) {
      $data = Documentation::where('role', 'admin')->get();

      //return data as datatable json
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {

          //add update button if user have permission
          if (auth()->user()->can('update-docs')) {
            $edit_btn = '<a href="' . route('docs.edit', $row->id) . '" class="dropdown-item"  data-id="' . $row->id . '" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit</a>';
          } else {
            $edit_btn = null;
          };

          //add detail and whatsapp button if user have permission
          if (auth()->user()->can('detail-docs')) {
            $detail_btn = '<a href="' . route('docs.show', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Details</a>';
          } else {
            $detail_btn = null;
          };

          //add delete button if user have permission
          if (auth()->user()->can('delete-docs')) {
            $delete_btn = '<a href="javascript:;" class="dropdown-item deleteDocs" data-id="' . $row->id . '" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a></div>';
          } else {
            $delete_btn = null;
          };

          //final dropdown button that shows on view
          $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
            <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_btn . $delete_btn . '</div>';
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }


    return view('docs.index', compact('roles'));
  }

  public function coachee_docs(Request $request)
  {
    if ($request->ajax()) {
      $data = Documentation::where('role', 'coachee')->get();
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $detail_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-primary editUser" data-id = "' . $row->id . '">Update</a></div>';
          $suspend_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-danger suspendUser" data-id = "' . $row->id . '">Suspend</a></div>';
          $unsuspend_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-success unsuspendUser" data-id = "' . $row->id . '">Unsuspend</a></div>';

          if ($row->suspend_status == 1) {
            $actionBtn = $detail_btn . ' ' . $suspend_btn;
          } else {
            $actionBtn = $detail_btn . ' ' . $unsuspend_btn;
          }
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
  }

  public function coach_docs(Request $request)
  {
    if ($request->ajax()) {
      $data = Documentation::where('role', 'coach')->get();
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $detail_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-primary editUser" data-id = "' . $row->id . '">Update</a></div>';
          $suspend_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-danger suspendUser" data-id = "' . $row->id . '">Suspend</a></div>';
          $unsuspend_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-success unsuspendUser" data-id = "' . $row->id . '">Unsuspend</a></div>';

          if ($row->suspend_status == 1) {
            $actionBtn = $detail_btn . ' ' . $suspend_btn;
          } else {
            $actionBtn = $detail_btn . ' ' . $unsuspend_btn;
          }
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function create()
  {
    $documentations = Documentation::get()->groupBy('category');
    $roles = Role::all();
    return view('docs.create', compact('documentations', 'roles'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
    $documentation = Documentation::updateOrCreate(
      [
        'id' => $request->id
      ],
      [
        'title'       => $request->title,
        'category'    => $request->category,
        'description' => $request->description,
        'role'        => $request->role
      ]
    );
    // $documentation = new Documentation;
    // $documentation->title = $request->title;
    // $documentation->category = $request->category;
    // $documentation->description = $request->description;
    // $documentation->save();

    if ($documentation->wasRecentlyCreated) {
      return redirect('/docs')->with('success', 'New Documentation succesfully saved');
    } else {
      return redirect('/docs')->with('success', 'Documentation succesfully updated');
    }
    // return $request->description;
  }

  public function image_upload(Request $request)
  {
    $fileName = $request->file('file')->getClientOriginalName();
    if (Storage::disk('s3')->exists('uploads/' . $fileName)) {
      Storage::disk('s3')->delete('uploads/' . $fileName);
    }
    Storage::disk('s3')->put('uploads/' . $fileName, file_get_contents($request->file('file')));
    $path = Storage::disk('s3')->url('uploads/' . $fileName);
    return response()->json(['location' => $path]);
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
    $documentation = Documentation::find($id);

    return view('docs.show', compact('documentation'));
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
    $documentation = Documentation::find($id);
    $documentations = Documentation::get()->groupBy('category');
    $roles = Role::all();
    return view('docs.edit', compact('documentation', 'documentations', 'roles'));
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
    //
    Documentation::find($id)->delete();
    return response()->json(['success' => 'Documentation deleted!']);
  }
}
