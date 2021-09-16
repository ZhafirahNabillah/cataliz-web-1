<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Program;
use Illuminate\Support\Facades\Mail;
use Alert;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Booking::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        //return response()->json($data);
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
        $programs = Program::where('program_name', 'starco')
            ->orWhere('program_name', 'scmp')
            ->get();

        $characters = '0123456789';
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        $code_booking = str_shuffle($pin);
        return view('booking.create', compact('programs', 'code_booking'));
    }

    public function seeEmailTemplate()
    {
        return view('booking.email_template');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $characters = '0123456789';
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        $code_booking = str_shuffle($pin);
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
            'code' => $code_booking,
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
                ->subject("Booking Cataliz");
            $mail->from('aditcarlytos61199@gmail.com', 'Booking Cataliz');
        });

        Alert::success('Your booking has been successfully created! ','Please check your email to complete the payment');

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
