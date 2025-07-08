<?php

namespace App\Http\Controllers;
use App\Models\Complaint;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;
use App\Notifications\ComplaintStatusChanged;

class ComplaintController extends Controller
 {
            public function index(Request $request)
        {
            $user = Auth::user();
            $resident = $user->resident;

            $query = Complaint::query()->with(['resident']);

            // Filter berdasarkan role (warga hanya melihat aduan miliknya)
            if ($user->role_id == \App\Models\Role::ROLE_USER) {
                $query->where('resident_id', $resident->id);
            }

            // Filter kategori
            $category = trim($request->input('category'));
            if (!empty($category)) {
                $query->where('category', $category);
            }

            // Filter status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            } else {
                // Hanya admin yang default ke status 'new'
                if ($user->role_id != \App\Models\Role::ROLE_USER) {
                    $query->where('status', 'new');
                }
            }

            // Ambil hasil
            $complaints = $query->latest()->paginate(10)->withQueryString();

            // Tandai aduan yang masih bisa di-edit atau delete
            foreach ($complaints as $complaint) {
                $complaint->can_edit_delete = false;

                if (
                    $user->role_id === \App\Models\Role::ROLE_USER &&
                    $resident &&
                    $complaint->resident_id === $resident->id &&
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

            return view('pages.complaints.create');
        }

        public function store(Request $request){
            $request->validate([
                'category' => 'required|in:infrastruktur,kebersihan,keamanan,sosial,kesehatan',
                'title' => ['required', 'min:3', 'max:255'],
                'content' => ['required', 'min:3', 'max:2000'],
                'photo_proof' => ['nullable', 'image','mimes:jpeg,png,jpg,gif','max:2048'],
            ]);

            $complaint = new Complaint();
            $complaint->resident_id = Auth::user()->resident->id;
            $complaint->category = $request->input('category');
            $complaint->title = $request->input('title');
            $complaint->content = $request->input('content');

            if($request->hasFile('photo_proof')){
                $filePath =  $request->file('photo_proof')->store('public/complaints');
                $complaint->photo_proof = $filePath;
        }

        $complaint->save();
        return redirect()->route('complaint.index')->with('success' , 'Pengaduan berhasil dikirim');
    }
        public function  edit($id){

                $resident = Auth::user()->resident;
            if (!$resident) {
                return redirect()->route('complaint.index')->with('error', 'Anda belum terhubung dengan data resident.');
            }
            $complaint = Complaint::findOrFail($id);

             if($complaint->status !== 'new'){
            return redirect()->route('complaint.index')->with('error', "Aduan tidak dapat dihapus. status aduan anda  saat ini adalah $complaint->status_label");
        }
            return view('pages.complaints.edit' , compact(
                'complaint'
            ));
        }


         public function update(Request $request , $id){
            $request->validate([
                'category' => 'required|in:infrastruktur,kebersihan,keamanan,sosial,kesehatan',
                'title' => ['required', 'min:3', 'max:255'],
                'content' => ['required', 'min:3', 'max:2000'],
                'photo_proof' => ['nullable', 'image','mimes:jpeg,png,jpg,gif','max:2048'],
            ]);

            $complaint = Complaint::findOrFail($id);
            $complaint->category = $request->input('category');
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
        return redirect()->route('complaint.index')->with('success' , 'Berhasil mengubah Aduan');
    }


    public function destroy($id)
    {
        $resident = Auth::user()->resident;
        // if (!$resident) {
        //     return redirect()->route('complaint.index')->with('error', 'Anda belum terhubung dengan data penduduk.');
        // }
        $complaint = Complaint::findOrFail($id);

        if($complaint->status !== 'new'){
            return redirect()->route('complaint.index')->with('error', 'Aduan tidak dapat dihapus karena sudah diproses.');
        }

          // Cek jika ada gambar, dan file-nya benar-benar ada di storage
        if ($complaint->photo_proof && Storage::exists($complaint->photo_proof)) {
            Storage::delete($complaint->photo_proof);
        }
        $complaint->delete();

        return redirect()->route('complaint.index')->with('success', 'Berhasil menghapus Aduan');
    }

        public function updateStatus(Request $request, $id)
        {
            $user = Auth::user()->resident;
            // Cek apakah user adalah admin (role_id == 1)
            if (Auth::user()->role_id !== \App\Models\Role::ROLE_ADMIN && !$user) {
                abort(403, 'Akses ditolak. Hanya admin yang dapat mengubah status.');
            }

            // Validasi input status
            $request->validate([
                'status' => 'required|in:new,processing,completed',
            ]);

            // Update status complaint
            $complaint = Complaint::findOrFail($id);

            $oldStatus = $complaint->status_label;

            $complaint->status = $request->input('status');
            $complaint->save();

            $newStatus = $complaint->status_label;

            User::where('id', $complaint->resident->user_id)
                ->firstOrFail()
                ->notify(new ComplaintStatusChanged($complaint, $oldStatus, $newStatus));

            return redirect()->back()->with('success', 'Status berhasil diperbarui.');
        }

}
