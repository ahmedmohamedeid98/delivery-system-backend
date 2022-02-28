<?php

namespace App\Http\Controllers;

use App\Jobs\TriggerNotification;
use App\Models\Identity;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IdentityController extends Controller
{

    public function canUpload()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $identity_status = Profile::find($user_id)->identity_status;
        if ($user->identity_id != null && $identity_status == 0) {
            return response(['can-upload' => false, 'reason' => 'your identities already in review process, we will notify you soon!']);
        }
        if ($user->identity_id != null && $identity_status == 1) {
            return response(['can-upload' => false, 'reason' => 'you are verified successfully!']);
        }
        return response(['can-upload' => true, 'reason' => 'you need to verify your identity']);
    }

    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $frontPicture = $data['front_image'];
        $backPicture = $data['back_image'];
        $selfyPicture = $data['selfy_image'];
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
            $user->identity_id = $identity->id;
            $user->save();
            $notifyMsg = "Identity images uploaded succesfully, We will approve it soon!";
            $this->dispatch(new TriggerNotification($notifyMsg, $user->id));
            return $this->success(
                'Identity Images Uploaded Succesfully, We will approve it soon!',
                ['user_id' => $user_id, 'new_identity_id' => $identity->id]
            );
        } else {
            return  ['invalid data', $request->header()];
        }
    }

    // public function create(Request $request)
    // {
    //     $user_id = Auth::user()->id;
    //     $frontPicture = null;
    //     $backPicture = null;
    //     $selfyPicture = null;
    //     if ($request->hasFile('front_image')) {
    //         // return response(['hasFile' => 'front']);
    //         $frontPicture = $this->store($request->file('front_image'));
    //     }
    //     if ($request->hasFile('back_image')) {
    //         $backPicture = $this->store($request->file('back_image'));
    //     }
    //     if ($request->hasFile('selfy_image')) {
    //         $selfyPicture = $this->store($request->file('selfy_image'));
    //     }

    //     // return response(['frontPicture' => $frontPicture, 'backPicture' =>  $backPicture, 'selfyPicture' => $selfyPicture]);

    //     if ($frontPicture && $backPicture && $selfyPicture) {
    //         $identity = Identity::create([
    //             'identity_front' => $frontPicture,
    //             'identity_back' => $backPicture,
    //             'identity_selfy' => $selfyPicture,
    //         ]);
    //         $user = User::find($user_id);
    //         $identity_id = $user->identity_id;
    //         if (isset($identity_id)) {
    //             Identity::where('id', $identity_id)->delete();
    //         }
    //         $user->identity_id = $identity->id;
    //         $user->save();
    //         $notifyMsg = "Identity images uploaded succesfully, We will approve it soon!";
    //         $this->dispatch(new TriggerNotification($notifyMsg, $user->id));
    //         return $this->success(
    //             'Identity Images Uploaded Succesfully, We will approve it soon!',
    //             ['user_id' => $user_id, 'new_identity_id' => $identity->id]
    //         );
    //     } else {
    //         return  ['invalid data', $request->header()];
    //     }
    // }

    // private function store($file)
    // {
    //     $filename  = $file->getClientOriginalName();
    //     $picture   = date('His') . '-' . $filename;
    //     $file->move(public_path('img'), $picture);
    //     return $picture;
    // }
}
