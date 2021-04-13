<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use Illuminate\Support\Facades\Validator;
use DataTables;

class TopicController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Topic::where('trainer_id', auth()->user()->id)->get();

      //return data as datatable json
      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {

          //add update button if user have permission
          if (auth()->user()->can('update-topic')) {
            $edit_btn = '<a href="' . route('topic.edit', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Edit Topic</a>';
          } else {
            $edit_btn = null;
          }

          //add detail and whatsapp button if user have permission
          if (auth()->user()->can('detail-topic')) {
            $detail_topic_btn = '<a href="' . route('topic.show', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Detail Topic</a>';
            $detail_participant_btn = '<a href="' . route('topic.participant', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Detail Participant</a>';
          } else {
            $detail_topic_btn = null;
            $detail_participant_btn = null;
          }

          //add delete button if user have permission
          if (auth()->user()->can('delete-topic')) {
            $delete_btn = '<a href="javascript:;" class="dropdown-item deleteTopic" data-id="' . $row->id . '" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a>';
          } else {
            $delete_btn = null;
          }

          //final dropdown button that shows on view
          $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
            <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_topic_btn . $detail_participant_btn . $delete_btn . '</div>';

          return $actionBtn;
        })
        ->rawColumns(['action'])
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
      'topic'       => 'required',
      'description' => 'required'
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
          'topic'       => $request->topic,
          'description' => $request->description,
          'trainer_id'  => auth()->user()->id
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
    public function show(Topic $topic)
    {
        return view('topic.detailTopic', compact('topic'));
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
        //
    }

    $topic = Topic::updateOrCreate(
      [
        'id' => $request->id
      ],
      [
        'topic'       => $request->topic,
        'description' => $request->description,
        'trainer_id'  => auth()->user()->id
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
  public function show($id)
  {
    $topic = Topic::where('trainer_id', auth()->user()->id)->first();
    return view('topic.detailTopic', compact('topic'));
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
  }
}
