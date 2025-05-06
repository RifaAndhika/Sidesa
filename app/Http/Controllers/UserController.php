<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function account_request_view(){

        $users = User::where('status', 'submitted')->get();
return view('pages.account-request.index', [
    'users' => $users,
]);

    }

        public function account_approval(Request $request, $userId){

            $request->validate([
                'status' => ['required', Rule::in(['approve', 'reject' , 'activate' , 'deactivate'])],
            ]);

            $for = $request->input('for');

            $user = User::findOrFail($userId);

            $user->status = $for == 'approve' || $for == 'activate' ? 'approved' : 'rejected';
            $user->save();

            if($for == 'activate'){
                return back()->with('success', 'Berhasil mengaktifkan akun');
            } else if($for == 'deactivate'){
                return back()->with('success', 'Berhasil menonaktifkan akun');
            }
            return back()->with('success', $for == 'approve' ? 'Berhasil menyetujui akun' : 'Berhasil menolak akun');
        }

        public function account_list_view() {

            $users = User::where('role_id', 2)->where('status', '!=' ,'submitted')->get();

            return view('pages.account-list.index' , [
                'users' => $users,
            ]);

        }

        public function profile_view(){
            return view('pages.profile.index');
        }
        public function update_profile(Request $request , $UserId){
            $request->validate([
                'name' => 'required|min:3',
            ]);

            $user = User::findOrFail($UserId);
            $user->name = $request->input('name');
            $user->save();

            return back()->with('success', 'Berhasil mengubah data profile');
        }

        public function change_password_view(){
            return view('pages.profile.change-password');
        }

        public function change_password(Request $request , $UserId){
            $request->validate([
                'old_password' => 'required|min:8',
                'new_password' => 'required|min:8',
            ]);


            $user = User::findOrFail($UserId);

            $curentpasswordIsValid = Hash::check($request->input('old_password'), $user->password);

            if($curentpasswordIsValid){

                 $user->password = $request->input('new_password');
                $user->save();

                return back()->with('success', 'Berhasil mengubah password');

            }

            return back()->with('error', 'Gagal mengubah password, password lama tidak sesuai');
        }

}
