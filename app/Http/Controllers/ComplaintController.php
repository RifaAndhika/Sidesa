<?php

namespace App\Http\Controllers;
use App\Models\Complaint;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
        public function index()
        {
            $user = Auth::user();
            $resident = $user->resident;

            // Jika user role 2 (warga) tapi belum punya data resident, beri peringatan
            if ($user->role_id == 2 && !$resident) {
                session()->flash('resident_warning', 'Anda belum terhubung dengan data Penduduk. Silakan hubungi admin.');
            }

            $residentId = $resident->id ?? null;

            // Ambil complaint hanya milik warga (jika warga), atau semua (jika admin)
            $complaints = Complaint::when($user->role_id == 2, function ($query) use ($residentId) {
                $query->where('resident_id', $residentId);
            })->paginate(5);

            // Tambahkan flag can_edit_delete ke setiap complaint
            foreach ($complaints as $complaint) {
                $complaint->can_edit_delete = false;

                if (
                    $user->role_id === 2 &&
                    $resident &&
                    $complaint->status === 'new'
                ) {
                    $complaint->can_edit_delete = true;
                }
            }

            return view('pages.complaints.index', [
                'complaint' => $complaints,
                'resident' => $resident,
            ]);
        }





        public function create(){

             $resident = Auth::user()->resident;
            if (!$resident) {
                return redirect()->route('complaint')->with('error', 'Anda belum terhubung dengan data resident.');
            }
            return view('pages.complaints.create');
        }

        public function store(Request $request){
            $request->validate([
                'title' => ['required', 'min:3', 'max:255'],
                'content' => ['required', 'min:3', 'max:2000'],
                'photo_proof' => ['nullable', 'image','mimes:jpeg,png,jpg,gif','max:2048'],
            ]);

            $complaint = new Complaint();
            $complaint->resident_id = Auth::user()->resident->id;
            $complaint->title = $request->input('title');
            $complaint->content = $request->input('content');

            if($request->hasFile('photo_proof')){
                $filePath =  $request->file('photo_proof')->store('public/complaints');
                $complaint->photo_proof = $filePath;
        }

        $complaint->save();
        return redirect()->route('complaint')->with('success' , 'Pengaduan berhasil dikirim');
    }
        public function  edit($id){

                $resident = Auth::user()->resident;
            if (!$resident) {
                return redirect()->route('complaint')->with('error', 'Anda belum terhubung dengan data resident.');
            }
            $complaint = Complaint::findOrFail($id);

             if($complaint->status !== 'new'){
            return redirect()->route('complaint')->with('error', "Aduan tidak dapat dihapus. status aduan anda  saat ini adalah $complaint->status_label");
        }
            return view('pages.complaints.edit' , compact(
                'complaint'
            ));
        }


         public function update(Request $request , $id){
            $request->validate([
                'title' => ['required', 'min:3', 'max:255'],
                'content' => ['required', 'min:3', 'max:2000'],
                'photo_proof' => ['nullable', 'image','mimes:jpeg,png,jpg,gif','max:2048'],
            ]);

            $complaint = Complaint::findOrFail($id);
            $complaint->resident_id = Auth::user()->resident->id;
            $complaint->title = $request->input('title');
            $complaint->content = $request->input('content');

            if($request->hasFile('photo_proof')){
              if ($complaint->photo_proof && Storage::disk('public')->exists($complaint->photo_proof)) {
                    Storage::disk('public')->delete($complaint->photo_proof);
                }

                $filePath =  $request->file('photo_proof')->store('public/complaints');
                $complaint->photo_proof = $filePath;
        }

        $complaint->save();
        return redirect()->route('complaint')->with('success' , 'Berhasil mengubah Aduan');
    }


    public function destroy($id)
    {
        $resident = Auth::user()->resident;
        if (!$resident) {
            return redirect()->route('complaint')->with('error', 'Anda belum terhubung dengan data penduduk.');
        }
        $complaint = Complaint::findOrFail($id);

        if($complaint->status !== 'new'){
            return redirect()->route('complaint')->with('error', 'Aduan tidak dapat dihapus karena sudah diproses.');
        }

          // Cek jika ada gambar, dan file-nya benar-benar ada di storage
        if ($complaint->photo_proof && Storage::exists($complaint->photo_proof)) {
            Storage::delete($complaint->photo_proof);
        }
        $complaint->delete();

        return redirect()->route('complaint')->with('success', 'Berhasil menghapus Aduan');
    }

        public function updateStatus(Request $request, $id)
        {
            $user = Auth::user()->resident;
            // Cek apakah user adalah admin (role_id == 1)
            if (Auth::user()->role_id !== 1 && !$user) {
                abort(403, 'Akses ditolak. Hanya admin yang dapat mengubah status.');
            }

            // Validasi input status
            $request->validate([
                'status' => 'required|in:new,processing,completed',
            ]);

            // Update status complaint
            $complaint = Complaint::findOrFail($id);
            $complaint->status = $request->input('status');
            $complaint->save();

            return redirect()->back()->with('success', 'Status berhasil diperbarui.');
        }

}
