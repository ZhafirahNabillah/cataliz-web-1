<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Program;
use Illuminate\Support\Facades\Mail;
use Facade\FlareClient\View;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< Updated upstream
        return view('booking.index');
=======
        // $data = Booking::orderBy('created_at', 'desc')->whereNotNull('payment')->get(); 
        if ($request->ajax()) {
            $data = Booking::orderBy('created_at', 'desc')->whereNotNull('payment')->get(); 
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
      
                //add detail button if user have permission
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
        // if ($request->ajax()) {
        //     $data = Booking::orderBy('created_at', 'desc')->whereNotNull('payment')->get(); 
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($row) {
        //             $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        //     }
        // return response()->json($data);
        return view('booking.index');
    }

    public function seePayment()
    {
        $data = Booking::where('name', '');
        return view('booking.payment', compact('data'));
    }

    public function search(Request $request)
    {
        $searchData = $request->searchBooking;
        $data = Booking::where('code', 'like', "%" . $searchData . "%")
            ->whereNull('payment')
            ->get();
        return view('booking.payment', compact('data'));
>>>>>>> Stashed changes
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programs = Program::where('program_name', 'starco')
            ->orWhere('program_name', 'scmp')
            ->get();
        return view('booking.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'whatsapp_number' => 'required',
            'instance' => 'required',
            'profession' => 'required',
            'address' => 'required',
            'goals' => 'required',
            'book_demo' => 'required',
            'book_date' => 'required',
            'session_coaching' => 'required',
            'session_training' => 'required',
            'session_mentoring' => 'required',
            'price' => 'required',
            'program_id' => 'required',
        ]);

        Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'instance' => $request->instance,
            'profession' => $request->profession,
            'address' => $request->address,
            'goals' => $request->goals,
            'book_demo' => $request->book_demo,
            'book_date' => $request->book_date,
            'session_coaching' => $request->session_coaching,
            'session_training' => $request->session_training,
            'session_mentoring' => $request->session_mentoring,
            'price' => $request->price,
            'program_id' => $request->program_id,
            'created_at' => date('Y-m-d H:1:s'),
        ]);

        $email = $request->email;
        $data = array(
            'name' => $request->name,
            'book_date' => $request->book_date,
            'price' => $request->price,
        );
        Mail::send('booking/email_template', $data, function ($mail) use ($email) {
            $mail->to($email, 'no-reply')
                ->subject("Sample Email Laravel");
            $mail->from('aditcarlytos61199@gmail.com', 'Booking Cataliz');
        });


        return redirect('booking/create')->with('success', 'value');
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
