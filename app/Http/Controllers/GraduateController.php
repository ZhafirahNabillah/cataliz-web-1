<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Graduate;
use App\Models\Client;
use DataTables;
use Image;
use Carbon\Carbon;

class GraduateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('alumni.index');
    }

    public function load_graduates_data(Request $request) {
      $data = Graduate::all();

      if ($request->ajax()) {
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('user_data', function ($row) {
            $user = $row->user;
            $client = $user->client->toArray();

            return $client;
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
          })->addColumn('action', function ($row) {
            // $remove_btn = '<a href="javascript:;" id="removeGraduateBtn" class="btn-sm btn-danger" data-id="' . $row->id . '" data-original-title="Remove Graduate">Remove</a>';
            $certificate_btn = '<a href="javascript:;" id="createCertificateBtn" class="btn-sm btn-primary" data-id="' . $row->id . '">Certificate</a>';

            $actionBtn = $certificate_btn;
            return $actionBtn;
          })
          ->rawColumns(['action', 'user_data'])
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
        //
        $validator = Validator::make($request->all(), [
          'name'        => 'required'
        ]);

        if ($validator->fails()) {
          return response()->json($validator->errors(), 422);
        }

        $client = Client::find($request->name);
        $user = $client->user;

        $graduate = new Graduate;
        $graduate->user_id = $user->id;
        $graduate->batch_id = $request->batch_id;
        $graduate->certificate_id = (string) Str::uuid();
        $graduate->certificate_number = 0;
        $graduate->save();

        $client->batch_id = 0;
        $client->save();

        return response()->json([
          'success' => 'Graduate saved successfully!'
        ]);
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
    public function edit(Graduate $graduate)
    {
        //
        return response()->json($graduate);
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
    public function destroy(Graduate $graduate)
    {
        $graduate->delete();
        return response()->json([
          'success' => 'Graduate deleted successfully!'
        ]);
    }

    public function load_clients_data(Request $request)
    {
        $coachee = [];
        // $graduated_coachee = Graduate::pluck('user_id');

        if ($request->has('q')) {
            $search = $request->q;
            $coachee = Client::with('batch.program')->whereNotIn('batch_id', [0])->where('name', 'LIKE', "%$search%")->get();
        } else {
            $coachee = Client::with('batch.program')->whereNotIn('batch_id', [0])->get();
        }
        return response()->json($coachee);
    }

    public function create_certificate($id)
    {
      $graduate = Graduate::where('certificate_id', $id)->first();
      $user = $graduate->user;

      $batch = $graduate->batch;
      $program = $batch->program;

      $certificate_filename = strtolower($program->program_name).'.png';

      $certificate = Image::make(public_path().'/assets/images/certificate/'.$certificate_filename);

      $months = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
      $month_formatted = $months[date('n')];

      $certificate_number = $graduate->certificate_number.'/'.$program->program_name.'/Batch-'.$batch->batch_number.'/'.$month_formatted.'/'.date('Y');

      $start_date = Carbon::parse($batch->start_date)->isoFormat('MMMM Do YYYY');
      $end_date = Carbon::parse($batch->end_date)->isoFormat('MMMM Do YYYY');

      $certificate->text($user->name, 640, 350, function($font) {
        $font->file(public_path().'\assets\fonts\Rubik-Bold.ttf');
        $font->size(30);
        $font->align('center');
      });

      $certificate->text($certificate_number, 580, 225, function($font) {
        $font->file(public_path().'\assets\fonts\Rubik-Bold.ttf');
        $font->size(15);
        $font->align('left');
      });

      $certificate->text($start_date.' - '.$end_date, 675, 425, function($font) {
        $font->file(public_path().'\assets\fonts\Rubik-Bold.ttf');
        $font->size(15);
        $font->align('left');
      });

      return $certificate->response('png');
    }

    public function store_certificate_data(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'certificate_number'        => 'required'
      ]);

      if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
      }

      $graduate = Graduate::find($request->graduate_id);
      $graduate->certificate_number = $request->certificate_number;
      $graduate->save();

      $url = route('graduates.certificate', $graduate->certificate_id);

      return response()->json($url);
    }
}
