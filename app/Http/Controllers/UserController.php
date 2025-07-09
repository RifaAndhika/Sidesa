<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Complaint;

class UserController extends Controller
{
        public function account_request_view(){

            $users = User::where('status', 'submitted')->paginate(5);

            return view('pages.account-request.index', [
                'users' => $users,

            ]);

        }

        public function account_approval(Request $request, $userId){

            $request->validate([
                'for' => ['required', Rule::in(['approve', 'reject' , 'activate' , 'deactivate'])],
                'resident_id' => ['nullable' , 'exists:residents,id']

            ]);

            $for = $request->input('for');

            $user = User::findOrFail($userId);

            $user->status = $for == 'approve' || $for == 'activate' ? 'approved' : 'rejected';
            $user->save();

            $residentId = $request->input('resident_id');

            if($request->has('resident_id') && isset($residentId)){
                Resident::where('id', $residentId)->update([
                    'user_id' => $user->id]);
            }


            if($for == 'activate'){
                return back()->with('success', 'Berhasil mengaktifkan akun');
            } else if($for == 'deactivate'){
                return back()->with('success', 'Berhasil menonaktifkan akun');
            }
            return back()->with('success', $for == 'approve' ? 'Berhasil menyetujui akun' : 'Berhasil menolak akun');
        }

        public function account_list_view() {

            $users = User::where('role_id', 2)->where('status', '!=' ,'submitted')->paginate(5);
            $residents = Resident::where('user_id', null)->get();

            return view('pages.account-list.index' , [
                'users' => $users,
                'residents' => $residents
            ]);

        }

        public function destroy_user($id)
        {
            $user = User::findOrFail($id);

            if ($user->status === 'approved') {
                return back()->with('error', 'Akun aktif tidak dapat dihapus.');
            }

            $user->delete();

            return back()->with('success', 'Akun berhasil dihapus.');
        }


        public function profile_view(){
            return view('pages.profile.index');
        }
        public function update_profile(Request $request, $UserId)
            {
                 $user = Auth::user();
                $resident = $user->resident;

                 $query = Complaint::query()->with(['resident.user']);

                $user = User::findOrFail($UserId);

                // Jika Admin: hanya update name
                if ($user->role_id == \App\Models\Role::ROLE_ADMIN) {
                    $request->validate([
                        'name' => ['required', 'max:100'],
                    ]);

                    $user->name = $request->input('name');
                    $user->save();

                    return back()->with('success', 'Nama berhasil diperbarui oleh admin.');
                }

                // Jika User: validasi semua
                $request->validate([
                    'nik' => ['required', 'digits:16'],
                    'name' => ['required', 'max:100'],
                    'gender' => ['required', Rule::in(['male', 'female'])],
                    'birth_date' => ['required', 'string'],
                    'birth_place' => ['required', 'max:100'],
                    'address' => ['required', 'max:800'],
                    'religion' => ['nullable', 'max:50'],
                    'marital_status' => ['required', Rule::in(['single', 'married', 'divorced', 'widowed'])],
                    'occupation' => ['nullable', 'max:100'],
                    'phone' => ['nullable', 'max:15'],
                    'status' => ['required', Rule::in(['active', 'moved', 'deceased'])],
                ]);

                // Update user
                $user->name = $request->input('name');
                $user->save();

                // Update resident
                $resident = $user->resident;
                if ($resident) {
                    $resident->nik = $request->input('nik');
                    $resident->gender = $request->input('gender');
                    $resident->birth_date = $request->input('birth_date');
                    $resident->birth_place = $request->input('birth_place');
                    $resident->address = $request->input('address');
                    $resident->religion = $request->input('religion');
                    $resident->marital_status = $request->input('marital_status');
                    $resident->occupation = $request->input('occupation');
                    $resident->phone = $request->input('phone');
                    $resident->status = $request->input('status');
                    $resident->save();
                }

                return back()->with('success', 'Berhasil mengubah data profil');
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

                $user->password = Hash::make($request->input('new_password'));
                $user->save();

                return back()->with('success', 'Berhasil mengubah password');

            }

            return back()->with('error', 'Gagal mengubah password, password lama tidak sesuai');
        }

}
