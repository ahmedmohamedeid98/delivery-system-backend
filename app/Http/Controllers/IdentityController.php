<?php

namespace App\Http\Controllers;

use App\Models\Identity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IdentityController extends Controller
{
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        $frontPicture = null;
        $backPicture = null;
        $selfyPicture = null;
        if ($request->hasFile('front_image')) {
            $frontPicture = $this->store($request->file('front_image'));
        }
        if ($request->hasFile('back_image')) {
            $backPicture = $this->store($request->file('back_image'));
        }
        if ($request->hasFile('selfy_image')) {
            $selfyPicture = $this->store($request->file('selfy_image'));
        }

        return response(['frontPicture' => $frontPicture, 'backPicture' =>  $backPicture, 'selfyPicture' => $selfyPicture]);

        if ($frontPicture && $backPicture && $selfyPicture) {
            $identity = Identity::create([
                'identity_front' => $frontPicture,
                'identity_back' => $backPicture,
                'identity_selfy' => $selfyPicture,
            ]);
            $user = User::find($user_id);
            $identity_id = $user->identity_id;
            if (isset($identity_id)) {
                Identity::where('id', $identity_id)->delete();
            }
            $c =  $identity->id();

            $user->identity_id = $identity->id();
            $user->save();
            return $this->success(
                'Identity Images Uploaded Succesfully, We will approve it soon!',
                ['user_id' => $user_id, 'new_identity_id' => $c]
            );
        } else {
            return  $this->failure(['invalid data']);
        }
    }

    private function store($file)
    {
        $filename  = $file->getClientOriginalName();
        $picture   = date('His') . '-' . $filename;
        $file->move(public_path('img'), $picture);
        return $picture;
    }
}
