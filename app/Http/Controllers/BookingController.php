<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'whatsapp_number' => 'required',
            'instance' => 'required',
            'profession' => 'required',
            'address' => 'required',
            'goals' => 'required',
            'program' => 'required',
            'book_demo' => 'required',
            'book_date' => 'required',
            'session_coaching' => 'required',
            'session_training' => 'required',
            'session_mentoring' => 'required',
            'price' => 'required',
        ]);

        Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'instance' => $request->instance,
            'profession' => $request->profession,
            'address' => $request->address,
            'goals' => $request->goals,
            'program' => $request->program,
            'book_demo' => $request->book_demo,
            'book_date' => $request->book_date,
            'session_coaching' => $request->session_coaching,
            'session_training' => $request->session_training,
            'session_mentoring' => $request->session_mentoring,
            'price' => $request->price,
            'created_at' => date('Y-m-d H:1:s'),
        ]);

        return response()->json([
            'success' => 'Booking successfully created!'
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
