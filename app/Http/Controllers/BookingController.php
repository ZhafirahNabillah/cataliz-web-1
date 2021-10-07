<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Program;
use App\Models\Batch;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use Alert;
use DataTables;
use PDF;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:list-docs', ['only' => 'index']);
        $this->middleware('permission:create-docs', ['only' => ['ajaxClients']]);
        $this->middleware('permission:update-docs', ['only' => ['edit']]);
        $this->middleware('permission:detail-docs', ['only' => ['show']]);
        $this->middleware('permission:delete-docs', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Booking::orderBy('created_at', 'desc')->whereNotNull('payment')
                ->get(['id', 'name', 'email', 'whatsapp_number', 'status']);

            //return data as datatable json
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    //add update button if user have permission
                    if (auth()->user()->can('update-docs')) {
                        $edit_btn = '<a href="' . route('booking.edit', $row->id) . '" class="dropdown-item"  data-id="' . $row->id . '" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit</a>';
                    } else {
                        $edit_btn = null;
                    };

                    //add detail button if user have permission
                    if (auth()->user()->can('detail-docs')) {
                        $detail_btn = '<a href="' . route('booking.detail', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Details</a>';
                    } else {
                        $detail_btn = null;
                    };

                    //final dropdown button that shows on view
                    $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
                <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_btn . '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data = DB::table('batches')
        //     ->join('programs', 'batches.program_id', '=', 'programs.id')
        //     ->where('batches.status', '=', '1')
        //     ->whereIn('programs.program_name', ['starco', 'scmp'])
        //     ->get();

        $data = Batch::select('batches.id', 'batches.program_id', 'batches.batch_number', 'programs.id', 'programs.program_name')
            ->join('programs', 'batches.program_id', '=', 'programs.id')
            ->where('batches.status', '1')
            ->whereIn('programs.program_name', ['starco', 'scmp'])
            ->get();
        // dd($data);

        $characters = '0123456789';
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        $code_booking = str_shuffle($pin);

        return view('booking.create', compact('code_booking', 'data'));
    }

    public function seeEmailSuccess()
    {
        return view('booking.email_successbooking');
    }

    public function seeEmailVerif()
    {
        return view('booking.email_verifbooking');
    }

    public function seeInvoice()
    {
        return view('booking.invoice');
    }

    //method to show edit agenda page
    public function edit($id)
    {
        $data = Booking::find($id);
        return view('booking.edit', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Booking::find($id);
        return view('booking.detail', compact('data'));
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
            'code' => 'required',
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
            'batch_id' => 'required',
        ]);

        $input = $request->all();
        $bookingData = Booking::create($input);

        // Booking::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'whatsapp_number' => $request->whatsapp_number,
        //     'instance' => $request->instance,
        //     'profession' => $request->profession,
        //     'address' => $request->address,
        //     'goals' => $request->goals,
        //     'book_demo' => $request->book_demo,
        //     'book_date' => $request->book_date,
        //     'session_coaching' => $request->session_coaching,
        //     'session_training' => $request->session_training,
        //     'session_mentoring' => $request->session_mentoring,
        //     'price' => $request->price,
        //     'program_id' => $request->program_id,
        //     'code' => $code_booking,
        //     'created_at' => date('Y-m-d H:1:s'),
        // ]);

        $data = array(
            'id' => $bookingData->id,
            'name' => $request->name,
            'book_date' => $request->book_date,
            'price' => $request->price,
            'code' => $bookingData->code,
        );

        $email = $request->email;
        Mail::send('booking/email_template', $data, function ($mail) use ($email) {
            $mail->to($email, 'no-reply')
                ->subject("Booking Cataliz");
            $mail->from('katum61199@gmail.com', 'Booking Cataliz');
        });

        Alert::success('Your booking has been successfully created! ', 'Please check your email to complete the payment');

        return redirect('booking/create')->with('success', 'value');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payment($id)
    {
        $id =  Crypt::decrypt($id);
        $dataBooking = Booking::find($id);
        // $dataBooking = DB::table('bookings')
        //     ->join('batches', 'bookings.batch_id', '=', 'batches.id')
        //     ->join('programs', 'batches.program_id', '=', 'programs.id')
        //     ->find($id);

        return view('booking.payment', compact('dataBooking'));
    }

    public function invoice($id)
    {
        $dataBooking = Booking::find($id);
        $name = $dataBooking->name;
        $data = array(
            'code' => $dataBooking->code,
            'name' => $dataBooking->name,
            'email' => $dataBooking->email,
            'profession' => $dataBooking->profession,
            'whatsapp_number' => $dataBooking->whatsapp_number,
            'instance' => $dataBooking->instance,
            'address' => $dataBooking->address,
            'goals' => $dataBooking->goals,
            'program' => $dataBooking->batchs->program->program_name,
            'book_date' => $dataBooking->book_date,
            'book_demo' => $dataBooking->book_demo,
            'session_coaching' => $dataBooking->session_coaching,
            'session_training' => $dataBooking->session_training,
            'session_mentoring' => $dataBooking->session_mentoring,
            'price' => $dataBooking->price,
            'status' => $dataBooking->status,
        );

        $pdf = PDF::loadView('booking.invoice', $data);
        return $pdf->download('Booking-Invoice-' . $name . '.pdf', compact('data'));
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
        $this->validate($request, [
            'bank' => 'required|string|max:30',
            'payment' => 'required|image|mimes:jpeg,png,jpg',

        ]);

        Booking::where('id', $id)->update([
            'payment' => $request->payment->store('payment'),
            'bank' => $request->bank,
        ]);

        $bookingData = Booking::find($id);
        $data = array(
            'id' => $bookingData->id,
            'code' => $bookingData->code,
            'name' => $bookingData->name,
            'whatsapp_number' => $bookingData->whatsapp_number,
            'email' => $bookingData->email,
            'program' => $request->program,
            'session_coaching' => $bookingData->session_coaching,
            'session_training' => $bookingData->session_training,
            'session_mentoring' => $bookingData->session_mentoring,
            'price' => $bookingData->price,
        );

        $email = 'admin@cataliz.id';
        Mail::send('booking/email_successbooking', $data, function ($mail) use ($email) {
            $mail->to($email, 'no-reply')
                ->subject("Booking Cataliz");
            $mail->from('katum61199@gmail.com', 'Booking Cataliz');
        });



        $name = $bookingData->name;
        $email = $bookingData->email;
        $message = 'Saya sudah Booking kegiatan dan telah menyelesaikan Pembayaran';
        $phone = '6285215269015';
        $urlSendWA = 'https://api.whatsapp.com/send?phone=' . $phone . '&text=Nama:%20' . $name . '%20%0AEmail:%20' . $email . '%20%0APesan:%20' . $message;
        return Redirect::to($urlSendWA);
    }

    public function updateAdmin(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'whatsapp_number' => 'required',
            'instance' => 'required',
            'profession' => 'required',
            'address' => 'required',
            'link' => 'required',
            'goals' => 'required',
            'book_date' => 'required',
            'time' => 'required',
        ]);

        if ($request->status == 'reservation') {

            Booking::where('id', $id)->update([
                'name' => $request->name,
                'whatsapp_number' => $request->whatsapp_number,
                'instance' => $request->instance,
                'profession' => $request->profession,
                'address' => $request->address,
                'link' => $request->link,
                'goals' => $request->goals,
                'book_date' => $request->book_date,
                'time' => $request->time,
                'status' => 'reservation',
            ]);

            $bookingData = Booking::find($id);
            $data = array(
                'name' => $bookingData->name,
                'whatsapp_number' => $bookingData->whatsapp_number,
                'email' => $bookingData->email,
                'program' => $request->program,
                'session_coaching' => $bookingData->session_coaching,
                'session_training' => $bookingData->session_training,
                'session_mentoring' => $bookingData->session_mentoring,
                'book_date' => $bookingData->book_date,
                'link' => $bookingData->link,
            );

            $email = $bookingData->email;
            Mail::send('booking/email_verifbooking', $data, function ($mail) use ($email) {
                $mail->to($email, 'no-reply')
                    ->subject("Booking Cataliz");
                $mail->from('katum61199@gmail.com', 'Booking Cataliz');
            });
        } else {
            Booking::where('id', $id)->update([
                'name' => $request->name,
                'whatsapp_number' => $request->whatsapp_number,
                'instance' => $request->instance,
                'profession' => $request->profession,
                'address' => $request->address,
                'link' => $request->link,
                'goals' => $request->goals,
                'book_date' => $request->book_date,
                'time' => $request->time,
                'status' => 'pending',
            ]);
        }

        Alert::success('Your verification successful!');
        return redirect('booking/index');
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
