<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;
use App\Models\Category;
use App\Models\Lesson_history;
use Illuminate\Support\Facades\Validator;
use DataTables;
use PDF;

class TopicController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if (auth()->user()->hasRole('trainer')) {
      $data = Topic::where('trainer_id', auth()->user()->id)->get();
    } elseif (auth()->user()->hasRole('mentor')) {
      $data = Topic::all();
    } elseif (auth()->user()->hasRole('coach')) {
      $data = Topic::all();
    } elseif (auth()->user()->hasRole('manager')) {
      $data = Topic::all();
    } elseif (auth()->user()->hasRole('coachee')) {
      $client = auth()->user()->client;
      $data = $client->topics;
    } elseif (auth()->user()->hasRole('choachmentor')) {
      $data = Topic::all();
    } else {
      $data = Topic::all();
    }

    if ($request->ajax()) {

      //return data as datatable json
      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('participant', function ($row) {
          return $total_participant = $row->clients->count();
        })
        ->addColumn('category', function ($row) {
          return $row->category->toArray();
        })
        ->addColumn('sub_topic', function ($row) {
          return $row->sub_topics->count();
        })
        ->addColumn('action', function ($row) {

          //add update button if user have permission
          if (auth()->user()->can('update-topic')) {
            // $edit_btn = '<a href="' . route('topic.edit', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Edit Topic</a>';

            $edit_btn = '<a href="' . route('topic.edit', $row->id) . '" id="editBtn" class="btn-sm btn-primary">Edit</a>';
          } else {
            $edit_btn = null;
          };

          //add detail and whatsapp button if user have permission
          if (auth()->user()->can('detail-topic')) {
            // $detail_topic_btn = '<a href="' . route('topic.show', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Detail Topic</a>';
            // $detail_participant_btn = '<a href="' . route('topic.participant', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Detail Participant</a>';

            $detail_topic_btn = '<a href="' . route('topic.show', $row->id) . '" id="detailBtn" class="btn-sm btn-primary">Detail</a>';
          } else {
            $detail_topic_btn = null;
            // $detail_participant_btn = null;
          };

          //add delete button if user have permission
          if (auth()->user()->can('delete-topic')) {
            // $delete_btn = '<a href="javascript:;" class="dropdown-item deleteTopic" data-id="' . $row->id . '" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a>';
            $delete_btn = '<a href="javascript:;" class="btn-sm btn-danger deleteTopic" data-id="' . $row->id . '">Delete</a>';
          } else {
            $delete_btn = null;
          };

          //final dropdown button that shows on view
          // $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
          //   <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_topic_btn . $delete_btn . '</div>';

          // return $actionBtn;

          $actionBtn = $detail_topic_btn . ' ' . $edit_btn . ' ' . $delete_btn;
          return $actionBtn;
        })
        ->rawColumns(['topic','action', 'participant', 'category', 'sub_topic'])
        ->make(true);
    }

    return view('topic.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('topic.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'topic'               => 'required',
      'client_requirement'  => 'required',
      'client_target'       => 'required',
      'description'         => 'required'
    ]);

    if ($validator->fails()) {
      return back()
        ->withErrors($validator)
        ->withInput();
    }

    $topic = Topic::updateOrCreate(
      [
        'id' => $request->id
      ],
      [
        'topic'               => $request->topic,
        'category_id'         => $request->category,
        'client_requirement'  => $request->client_requirement,
        'client_target'       => $request->client_target,
        'description'         => $request->description,
        'trainer_id'          => auth()->user()->id
      ]
    );

    if ($topic->wasRecentlyCreated) {
      return redirect('/topic')->with('success', 'New Topic succesfully saved');
    } else {
      return redirect('/topic')->with('success', 'Topic succesfully updated');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, Topic $topic)
  {
    $category = Category::where('id', $topic->category_id)->pluck('category')->first();
    $data = $topic->clients;

    if ($request->ajax()) {
      //return data as datatable json
      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('email', function ($row) {
          $email = str_pad(substr($row->email, -15), strlen($row->email), 'x', STR_PAD_LEFT);

          return $email;
        })->addColumn('program', function ($row) {
          $batch = $row->batch;

          if ($batch) {
            $program = $batch->program;
          } else {
            $program = null;
          }

          if (is_null($program)) {
            return 'Not Registered to Any program';
          } else {
            return $program->program_name . ' Batch ' . $batch->batch_number;
          }
        })
        ->rawColumns(['email', 'program'])
        ->make(true);
    }

    $sub_topics = $topic->sub_topics;

    $lesson_histories = Lesson_history::where('topic_id', $topic->id)->where('user_id', auth()->user()->id)->get();

    // return $sub_topics;

    return view('topic.detailTopic', compact('topic', 'category', 'sub_topics', 'lesson_histories'));
  }

  public function show_detail_participant($id)
  {
    return view('topic.detailParticipant');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Topic $topic)
  {
    $category = Category::where('id', $topic->category_id)->pluck('category')->first();
    return view('topic.edit', compact('topic', 'category'));
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
  public function destroy(Topic $topic)
  {
    $topic->delete();
    return response()->json(['success' => 'Topic deleted!']);
  }

  // download pdf list coach
  public function topic_pdf_download(Topic $topic)
  {
    $pdf = PDF::loadview('pdf_template.topic_detail_pdf', compact('topic'));
    return $pdf->download('topic_detail.pdf');
  }

  public function topic_search(Request $request)
  {
    $topic = [];
    $trainer = User::find(auth()->user()->id);
    if ($request->has('q')) {
      $search = $request->q;
      $topic = $trainer->topic->where('topic', 'LIKE', "%$search%");
    } else {
      $topic = $trainer->topic;
    }
    return response()->json($topic);
  }
}
