<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use app\Models\User;
use App\Models\Client;
use App\Models\Skill;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function profil($id)
    {
        if (auth()->user()->hasRole('coachee')) {
            $user = User::select('*')
                ->join('clients', 'user_id', '=', 'users.id')
                ->where('users.id', Auth::user()->id)
                ->first();

            $contents = Storage::disk('s3')->url('images/profil_picture/' . $user->profil_picture);
            $contents_bg = Storage::disk('s3')->url('images/background_picture/' . $user->background_picture);

            return view('profile.index', compact('user', 'contents'));
        } else {
            $user = User::where('id', Auth::user()->id)->first();
            $contents = Storage::disk('s3')->url('images/profil_picture/' . $user->profil_picture);
            $contents_bg = Storage::disk('s3')->url('images/background_picture/' . $user->background_picture);

            return view('profile.index', compact('user', 'contents', 'contents_bg'));
        }
    }

    public function profil_detail($id)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $category = Category::all()->take(7);
        $other_category = Category::whereNotIn('id', [1, 2, 3, 4, 5, 6, 7])->get();
        $all_skills = Skill::get();

        return view('profile.detail', compact('user', 'category', 'all_skills', 'other_category'));
    }

    public function skill_search(Request $request)
    {
        $skill = [];
        $search = trim($request->q);

        if (empty($search)) {
            $skill = Skill::all();
        } else {
            $skill = Skill::where('skill_name', 'LIKE', "%$search%")->get();
        }

        return response()->json($skill);
    }

    public function simpan_password(Request $request, $id)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect(route('profil', Auth::user()->id))->with('success', 'Your Password has been updated!');
    }

    public function store_data(Request $request, $id)
    {
        if (auth()->user()->hasRole('coachee')) {
            $user = User::find($id);
            // return $user;
            $client = Client::where('user_id', $user->id)->first();
            // return $client;

            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->update();

            $client->name = $user->name;
            $client->phone = $user->phone;
            $client->organization = $request->organization;
            $client->company = $request->company;
            $client->occupation = $request->occupation;
            $client->update();
        } else {

            $user = User::find($id);
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->update();
        }
        return redirect(route('profil', Auth::user()->id));
    }

    public function update_profil(Request $request, $id)
    {
        $user = User::where('id', Auth::user()->id)->first();

        if ($request->has('profil_picture')) {
            if ($request->hasFile('profil_picture')) {
                // $filenameWithExt = $request->file('profil_picture')->getClientOriginalName();
                // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // $extension = $request->file('profil_picture')->getClientOriginalExtension();
                // $filenameSave = $filename . '_' . time() . '.' . $extension;

                $file = $request->file('profil_picture');
                $filenameSave = 'UIMG' . date('YmdHis') . uniqid() . '.jpg';

                $move = $file->move(public_path('storage/profil/crop'), $filenameSave);

                if ($move) {
                    $user->profil_picture = $filenameSave;
                    $user->update();

                    if (Storage::disk('s3')->exists('images/profil_picture/' . $user->profil_picture)) {
                        Storage::disk('s3')->delete('images/profil_picture/' . $user->profil_picture);
                    }
                    Storage::disk('s3')->put('images/profil_picture/' . $filenameSave, file_get_contents(public_path('storage/profil/crop/' . $filenameSave)));

                    unlink(public_path('storage/profil/crop/' . $filenameSave));
                    return response()->json(['status' => 1, 'msg' => 'Image has been cropped successfully.']);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
                }

                // $request->file('profil_picture')->storeAs('public/profil', $filenameSave);

                // if (!file_exists(public_path('storage/profil/crop'))) {
                //     mkdir(public_path('storage/profil/crop'), 0755);
                // }

                // crop image
                // $img = Image::make(public_path('storage/profil/' . $filenameSave));
                // $croppath = public_path('storage/profil/crop/' . $filenameSave);

                // $img->crop($request->input('w'), $request->input('h'), $request->input('x1'), $request->input('y1'));
                // $img->save($croppath);

            }
        }

        return redirect(route('profil', Auth::user()->id));
    }

    public function update_background(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        if ($request->hasFile('background_picture')) {
            if ($request->hasFile('background_picture')) {
                $filenameWithExt = $request->file('background_picture')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('background_picture')->getClientOriginalExtension();
                $filenameSave = $filename . '_' . time() . '.' . $extension;
                if (Storage::disk('s3')->exists('images/background_picture/' . $user->background_picture)) {
                    Storage::disk('s3')->delete('images/background_picture/' . $user->background_picture);
                }
                Storage::disk('s3')->put('images/background_picture/' . $filenameSave, file_get_contents($request->file('background_picture')));
                // $path = $request->file('background_picture')->storeAs('public/background', $filenameSave);
                $user->background_picture = $filenameSave;
            }
        }
        $user->update();

        return redirect(route('profil', Auth::user()->id));
    }

    public function create_category(Request $request)
    {
        $all_category = Category::all();
        $category = new Category;
        if ($request->category != $all_category) {
            $category->category = $request->category;
        }
        return response()->json(['success' => 'Category saved successfully!']);
    }

    public function create_expertise()
    {
        return response()->json(['success' => 'Expertise saved successfully!']);
    }

    public function create_education()
    {
        return response()->json(['success' => 'Education saved successfully!']);
    }

    public function create_employment()
    {
        return response()->json(['success' => 'Employment saved successfully!']);
    }

    public function create_languages()
    {
        return response()->json(['success' => 'Languages saved successfully!']);
    }

    public function create_overview()
    {
        return response()->json(['success' => 'Overview saved successfully!']);
    }

    public function create_address()
    {
        return response()->json(['success' => 'Address saved successfully!']);
    }
}
