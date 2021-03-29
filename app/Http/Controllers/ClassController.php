<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Models\Coach;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DataTables;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:list-class', ['only' => 'index']);
        $this->middleware('permission:create-class', ['only' => ['create', 'store']]);
        $this->middleware('permission:detail-class', ['only' => 'show']);
    }



    // public function index(Request $request)
    // {
    //   if (auth()->user()->hasRole('coach')) {
    //     $data = Class_model::with('coach')->where('coach_id',auth()->user()->id)->get();
    //   } elseif (auth()->user()->hasRole('coachee')) {
    //     $client = Client::where('user_id',auth()->user()->id)->first();
    //     $class_id = Class_has_client::where('client_id',$client->id)->pluck('class_id');
    //     $data = Class_model::with('coach')->whereIn('id',$class_id)->get();
    //   } else {
    //     $data = Class_model::with('coach')->get();
    //   }
    //
    //     if ($request->ajax()) {
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function ($row) {
    //
    //                 $detail_btn = '<a href="' . route('class.show', $row->id) . '" class="btn-sm btn-primary">Detail</a>';
    //
    //                 return $detail_btn;
    //             })
    //             ->addColumn('participant', function ($row) {
    //                 $participant = Class_has_client::where('class_id', $row->id)->count();
    //
    //                 return ($participant . '/10');
    //             })
    //             ->rawColumns(['action', 'participant'])
    //             ->make(true);
    //     }
    //     return view('class.index');
    // }

    // method to show class index page
    public function index(Request $request){
      // $coach = Coach::where('user_id', 1)->first();
      //
      // return $coach->clients->count();

      $data = Coach::with('user')->get();

      if ($request->ajax()) {
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {

          $detail_btn = '<a href="' . route('class.show', $row->id) . '" class="btn-sm btn-primary">Detail</a>';

          return $detail_btn;
        })
        ->addColumn('Total Client', function ($row) {
          $coach = Coach::where('id', $row->id)->first();

          return $coach->clients->count();
        })
        ->rawColumns(['action', 'Total Client'])
        ->make(true);
      }

      return view('class.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //method to assign coachee to a coach and send email to admin, coach, and coachee
    public function store(Request $request)
    {
        // return $request->cl;

        // $this->validate($request, [
        //     'class_name'  => 'required',
        //     'coach_id' => 'required',
        //     'clients' => 'required'
        // ]);
        //
        // $class = new Class_model;
        // $class->class_name = $request->class_name;
        // $class->coach_id = $request->coach_id;
        // $class->status = 'On-Going';
        // $class->save();
        //
        // foreach ($request->clients as $client) {
        //     $class_has_client = new Class_has_client;
        //     $class_has_client->class_id = $class->id;
        //     $class_has_client->client_id = $client;
        //     $class_has_client->save();
        // }
        //
        // return redirect('/class')->with('success','Class succesfully created');

        $coach = Coach::find($request->coach_id);
        // $old_clients = $coach->clients->pluck('id')->toArray();
        // $coach->clients()->sync($request->input('client'));
        //
        // $request_client = $request->input('client');
        //
        // if ($request->filled('client')) {
        //   $new_clients_id = array_diff($request_client, $old_clients);
        // } else {
        //   $new_clients_id = [];
        // }
        $coach->clients()->attach($request->input('client'));

        $coach_detail = User::where('id', $coach->user_id)->first();
        $new_clients = Client::whereIn('id', $request->input('client'))->get();

        // MailController::SendAddClassMailToCoachee($new_clients, $coach_detail);
        // MailController::SendAddClassMailToCoach($new_clients, $coach_detail);
        // MailController::SendAddClassMailToAdmin($new_clients, $coach_detail);

        //sending email
        MailController::SendAddClassMail($new_clients, $coach_detail);

        // if ($new_clients_id) {
        //
        //
        // }


        return response()->json([
          'success' => 'Customer saved successfully!'
          // 'old_clients' => $old_clients,
          // 'request_client' => $request_client,
          // 'new_clients' => $new_clients
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // method to show class detail page
    public function show($id, Request $request)
    {
        //
        // $class = Class_model::with('coach')->where('id', $id)->first();
        // $coachee_id = Class_has_client::where('class_id', $class->id)->pluck('client_id');

        $coach = Coach::find($id);

        $data = $coach->clients;

        // if ($request->ajax()) {
        //
        //     $data = Client::whereIn('id', $coachee_id)->get();
        //
        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         ->make(true);
        // }
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                  $remove_btn = '<button id="removeBtn" type="button" data-id="' . $row->id . '" name="button" class="btn-sm btn-danger">Remove</button>';
                  return $remove_btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $clients = Client::all();

        return view('class.detail', compact('coach','clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //method to show client list for modal add coachee to coach on detail class page
    public function edit($id)
    {
      $coach = Coach::find($id);

      return response()->json($coach->clients);
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

    public function remove_client(Request $request){
      //removing client from coach
      $coach = Coach::find($request->coach_id);
      $coach->clients()->detach($request->client_id);

      //get data for email
      $coach_detail = $coach->user;
      $client = Client::find($request->client_id);

      //sending email
      MailController::SendRemoveClassMail($client, $coach_detail);

      return response()->json([
        'success' => 'Client removed succesfully!'
      ]);
    }

    //method ajax for livesearch on detail class when adding coachee to a coach
    public function ajaxClass(Request $request)
    {
        $coachee = [];
        $coach = Coach::where('id', $request->coach_id)->first();
        $existing_coachee = $coach->clients->pluck('id');

        if ($request->has('q')) {
            $search = $request->q;
            $coachee = Client::whereNotIn('id', $existing_coachee)->where('name', 'LIKE', "%$search%")->get();
        } else {
            $coachee = Client::whereNotIn('id', $existing_coachee)->get();
        }
        return response()->json($coachee);
    }

    // public function ubah_status(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'notes'  => 'required',
    //     ]);
    //
    //     $class = Class_model::where('id', $id)->first();
    //     $class->status = $request->status;
    //     $class->notes = $request->notes;
    //     $class->update();
    //
    //     return redirect('/class');
    // }
}
