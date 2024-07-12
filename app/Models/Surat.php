<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Surat extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'jenis_surat', 'nomor_surat', 'asal_surat', 'tgl_surat', 'tgl_sampai','perihal', 'tgl_acara', 'sifat_surat', 'surat', 'lampiran', 'disposisi', 'tgl_disposisi','created_by', 'edited_by'
    ];

    public function userCreate() {
        return $this->belongsTo(User::class, 'created_by', 'uuid');
    }

    public function userEdit() {
        return $this->belongsTo(User::class, 'edited_by', 'uuid');
    }
}
