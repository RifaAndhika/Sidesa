<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $guarded = [];

        public function getStatusLabelAttribute()
        {
            return match($this->status) {
                'new' => 'Baru',
                'processing' => 'Diproses',
                'completed' => 'Selesai',
                default => 'Tidak Diketahui',
            };
        }

        public function getReportDataLabelAttribute() //label data laporan
        {
            return \Carbon\Carbon::parse($this->report_data)->format('d M Y , H:i:s');
        }


        public function resident() {
            return $this->belongsTo(Resident::class);
        }

        public function user() {
            return $this->belongsTo(User::class);
        }

    }
