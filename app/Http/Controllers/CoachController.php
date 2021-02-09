<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use app\Models\User;
use App\Models\Client;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class CoachController extends Controller
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

    public function profil($id)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $client = Client::find($id);
        return view('coach.profile', compact('user', 'client'));
    }

    public function simpan_password(Request $request, $id)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect(route('coachs.profil', Auth::user()->id))->with('success', 'Password berhasil diubah!');
    }

    public function update_profil(Request $request, $id)
    {
        $user = User::where('id', Auth::user()->id)->first();

        if ($request->has('profil_picture')) {
            if ($request->hasFile('profil_picture')) {
                $filenameWithExt = $request->file('profil_picture')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('profil_picture')->getClientOriginalExtension();
                $filenameSave = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('profil_picture')->storeAs('public/profil', $filenameSave);
                $user->profil_picture = $filenameSave;
            }
        }
        $user->update();

        return redirect(route('coachs.profil', Auth::user()->id))->with('success2', 'Foto profil berhasil diubah!');
    }

    public function update_background(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        if ($request->hasFile('background_picture')) {
            $filenameWithExt = $request->file('background_picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('background_picture')->getClientOriginalExtension();
            $filenameSave = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('background_picture')->storeAs('public/background', $filenameSave);
            $user->profil_picture = $filenameSave;
            $user->update();
        }
        return redirect(route('coachs.profil', Auth::user()->id))->with('success2', 'Background berhasil diubah!');
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
