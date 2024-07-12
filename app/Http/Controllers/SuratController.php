<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Surat;

use Auth;
use DataTables;
use URL;
use Helper;
use Image;
use Response;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (request()->ajax()) {
            $user = Auth::user();
            $roles = $user->getRoleNames();
            if ($roles[0] == "sekda") {
                $surat = Surat::all()->where('status','=', 1);

            return Datatables::of($surat)
                ->addIndexColumn()
                ->editColumn('sifat_surat', function($row){
                    switch ($row->sifat_surat) {
                        case 'biasa' :
                            return '<span class="badge badge-primary">Biasa</span>';
                            break;
                        case 'segera' :
                            return '<span class="badge badge-info">Segera</span>';
                            break;
                        case 'penting' :
                            return '<span class="badge badge-warning">Penting</span>';
                            break;
                        case 'rahasia' :
                            return '<span class="badge badge-danger">Rahasia</span>';
                            break;
                    }
                })
                ->editColumn('status', function($row){
                    switch ($row->status) {
                        case '1' :
                            return '<span class="badge badge-warning">Belum di Baca</span>';
                            break;
                        case '2' :
                            return '<span class="badge badge-secondary">Sudah Dibaca</span>';
                            break;
                    }
                })
                ->editColumn('tgl_surat', function ($row) {
                    if ($row->tgl_surat == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_surat)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_acara', function ($row) {
                    if ($row->tgl_acara == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_acara)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_sampai', function ($row) {
                    if ($row->tgl_sampai == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_sampai)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_disposisi', function ($row) {
                    if ($row->tgl_disposisi == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_disposisi)->translatedFormat('d M Y') ;
                })
                ->editColumn('created_by', function($row){
                    return $row->userCreate->name;
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('surat.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" href="' . route('get.view', $row->uuid) . '"><i class="fal fa-info"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','sifat_surat','status'])
                ->make(true);
        }
        elseif ($roles[0] == "bupati") {
            $surat = Surat::all()->where('status','=', 1);

        return Datatables::of($surat)
            ->addIndexColumn()
            ->editColumn('sifat_surat', function($row){
                switch ($row->sifat_surat) {
                    case 'biasa' :
                        return '<span class="badge badge-primary">Biasa</span>';
                        break;
                    case 'segera' :
                        return '<span class="badge badge-info">Segera</span>';
                        break;
                    case 'penting' :
                        return '<span class="badge badge-warning">Penting</span>';
                        break;
                    case 'rahasia' :
                        return '<span class="badge badge-danger">Rahasia</span>';
                        break;
                }
            })
            ->editColumn('status', function($row){
                switch ($row->status) {
                    case '1' :
                        return '<span class="badge badge-warning">Belum di Baca</span>';
                        break;
                    case '2' :
                        return '<span class="badge badge-secondary">Sudah Dibaca</span>';
                        break;
                }
            })
            ->editColumn('tgl_surat', function ($row) {
                if ($row->tgl_surat == null){
                    return Carbon::make(null);
                }
                return Carbon::parse($row->tgl_surat)->translatedFormat('d M Y');
            })
            ->editColumn('tgl_acara', function ($row) {
                if ($row->tgl_acara == null){
                    return Carbon::make(null);
                }
                return Carbon::parse($row->tgl_acara)->translatedFormat('d M Y');
            })
            ->editColumn('tgl_sampai', function ($row) {
                if ($row->tgl_sampai == null){
                    return Carbon::make(null);
                }
                return Carbon::parse($row->tgl_sampai)->translatedFormat('d M Y');
            })
            ->editColumn('tgl_disposisi', function ($row) {
                if ($row->tgl_disposisi == null){
                    return Carbon::make(null);
                }
                return Carbon::parse($row->tgl_disposisi)->translatedFormat('d M Y') ;
            })
            ->editColumn('created_by', function($row){
                return $row->userCreate->name;
            })
            ->addColumn('action', function ($row) {
                return '
                            <a class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" href="' . route('get.view', $row->uuid) . '"><i class="fal fa-info"></i></a>';
            })
            ->removeColumn('id')
            ->removeColumn('uuid')
            ->rawColumns(['action','sifat_surat','status'])
            ->make(true);
    }
        $surat = Surat::all()->where('status','=', 1);

            return Datatables::of($surat)
                ->addIndexColumn()
                ->editColumn('sifat_surat', function($row){
                    switch ($row->sifat_surat) {
                        case 'biasa' :
                            return '<span class="badge badge-primary">Biasa</span>';
                            break;
                        case 'segera' :
                            return '<span class="badge badge-info">Segera</span>';
                            break;
                        case 'penting' :
                            return '<span class="badge badge-warning">Penting</span>';
                            break;
                        case 'rahasia' :
                            return '<span class="badge badge-danger">Rahasia</span>';
                            break;
                    }
                })
                ->editColumn('status', function($row){
                    switch ($row->status) {
                        case '1' :
                            return '<span class="badge badge-warning">Belum di Baca</span>';
                            break;
                        case '2' :
                            return '<span class="badge badge-secondary">Sudah Dibaca</span>';
                            break;
                    }
                })
                ->editColumn('tgl_surat', function ($row) {
                    if ($row->tgl_surat == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_surat)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_acara', function ($row) {
                    if ($row->tgl_acara == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_acara)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_sampai', function ($row) {
                    if ($row->tgl_sampai == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_sampai)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_disposisi', function ($row) {
                    if ($row->tgl_disposisi == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_disposisi)->translatedFormat('d M Y');
                })
                ->editColumn('created_by', function($row){
                    return $row->userCreate->name;
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('surat.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('surat.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>
                            <a class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" href="' . route('get.download', $row->uuid) . '"><i class="fal fa-print"></i></a>
                            <a class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" href="' . route('get.view', $row->uuid) . '"><i class="fal fa-info"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','sifat_surat','status'])
                ->make(true);
        }

        return view('surat.index');
    }

    public function dibaca(Request $request)
    {
        if (request()->ajax()) {
            $user = Auth::user();
            $roles = $user->getRoleNames();
            if ($roles[0] == "sekda") {
                $surat = Surat::all()->where('status','=', 2);

            return Datatables::of($surat)
                ->addIndexColumn()
                ->editColumn('sifat_surat', function($row){
                    switch ($row->sifat_surat) {
                        case 'biasa' :
                            return '<span class="badge badge-primary">Biasa</span>';
                            break;
                        case 'segera' :
                            return '<span class="badge badge-info">Segera</span>';
                            break;
                        case 'penting' :
                            return '<span class="badge badge-warning">Penting</span>';
                            break;
                        case 'rahasia' :
                            return '<span class="badge badge-danger">Rahasia</span>';
                            break;
                    }
                })
                ->editColumn('status', function($row){
                    switch ($row->status) {
                        case '1' :
                            return '<span class="badge badge-warning">Belum di Baca</span>';
                            break;
                        case '2' :
                            return '<span class="badge badge-secondary">Sudah Dibaca</span>';
                            break;
                    }
                })
                ->editColumn('tgl_surat', function ($row) {
                    if ($row->tgl_surat == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_surat)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_acara', function ($row) {
                    if ($row->tgl_acara == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_acara)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_sampai', function ($row) {
                    if ($row->tgl_sampai == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_sampai)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_disposisi', function ($row) {
                    if ($row->tgl_disposisi == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_disposisi)->translatedFormat('d M Y') ;
                })
                ->editColumn('created_by', function($row){
                    return $row->userCreate->name;
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('surat.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" href="' . route('get.view', $row->uuid) . '"><i class="fal fa-info"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','sifat_surat','status'])
                ->make(true);
        }
        elseif ($roles[0] == "bupati") {
            $surat = Surat::all()->where('status','=', 2);

        return Datatables::of($surat)
            ->addIndexColumn()
            ->editColumn('sifat_surat', function($row){
                switch ($row->sifat_surat) {
                    case 'biasa' :
                        return '<span class="badge badge-primary">Biasa</span>';
                        break;
                    case 'segera' :
                        return '<span class="badge badge-info">Segera</span>';
                        break;
                    case 'penting' :
                        return '<span class="badge badge-warning">Penting</span>';
                        break;
                    case 'rahasia' :
                        return '<span class="badge badge-danger">Rahasia</span>';
                        break;
                }
            })
            ->editColumn('status', function($row){
                switch ($row->status) {
                    case '1' :
                        return '<span class="badge badge-warning">Belum di Baca</span>';
                        break;
                    case '2' :
                        return '<span class="badge badge-secondary">Sudah Dibaca</span>';
                        break;
                }
            })
            ->editColumn('tgl_surat', function ($row) {
                if ($row->tgl_surat == null){
                    return Carbon::make(null);
                }
                return Carbon::parse($row->tgl_surat)->translatedFormat('d M Y');
            })
            ->editColumn('tgl_acara', function ($row) {
                if ($row->tgl_acara == null){
                    return Carbon::make(null);
                }
                return Carbon::parse($row->tgl_acara)->translatedFormat('d M Y');
            })
            ->editColumn('tgl_sampai', function ($row) {
                if ($row->tgl_sampai == null){
                    return Carbon::make(null);
                }
                return Carbon::parse($row->tgl_sampai)->translatedFormat('d M Y');
            })
            ->editColumn('tgl_disposisi', function ($row) {
                if ($row->tgl_disposisi == null){
                    return Carbon::make(null);
                }
                return Carbon::parse($row->tgl_disposisi)->translatedFormat('d M Y') ;
            })
            ->editColumn('created_by', function($row){
                return $row->userCreate->name;
            })
            ->addColumn('action', function ($row) {
                return '
                            <a class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" href="' . route('get.view', $row->uuid) . '"><i class="fal fa-info"></i></a>';
            })
            ->removeColumn('id')
            ->removeColumn('uuid')
            ->rawColumns(['action','sifat_surat','status'])
            ->make(true);
    }
        $surat = Surat::all()->where('status','=', 2);

            return Datatables::of($surat)
                ->addIndexColumn()
                ->editColumn('sifat_surat', function($row){
                    switch ($row->sifat_surat) {
                        case 'biasa' :
                            return '<span class="badge badge-primary">Biasa</span>';
                            break;
                        case 'segera' :
                            return '<span class="badge badge-info">Segera</span>';
                            break;
                        case 'penting' :
                            return '<span class="badge badge-warning">Penting</span>';
                            break;
                        case 'rahasia' :
                            return '<span class="badge badge-danger">Rahasia</span>';
                            break;
                    }
                })
                ->editColumn('status', function($row){
                    switch ($row->status) {
                        case '1' :
                            return '<span class="badge badge-warning">Belum di Baca</span>';
                            break;
                        case '2' :
                            return '<span class="badge badge-secondary">Sudah Dibaca</span>';
                            break;
                    }
                })
                ->editColumn('tgl_surat', function ($row) {
                    if ($row->tgl_surat == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_surat)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_acara', function ($row) {
                    if ($row->tgl_acara == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_acara)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_sampai', function ($row) {
                    if ($row->tgl_sampai == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_sampai)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_disposisi', function ($row) {
                    if ($row->tgl_disposisi == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_disposisi)->translatedFormat('d M Y');
                })
                ->editColumn('created_by', function($row){
                    return $row->userCreate->name;
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('surat.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('surat.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>
                            <a class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" href="' . route('get.download', $row->uuid) . '"><i class="fal fa-print"></i></a>
                            <a class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" href="' . route('get.view', $row->uuid) . '"><i class="fal fa-info"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','sifat_surat','status'])
                ->make(true);
        }

        return view('surat.dibaca');
    }

    public function filterBelumBaca (Request $request)
    {
        $myDate = Surat::whereBetween('tgl_surat', array($request->get('start_date'), $request->get('end_date')))
                    ->where('status', '=', 1)->get();

        $user = Auth::user();
            $roles = $user->getRoleNames();
            if ($roles[0] == "sekda") {
                $surat = Surat::all();

            return Datatables::of($myDate)
                ->addIndexColumn()
                ->editColumn('sifat_surat', function($row){
                    switch ($row->sifat_surat) {
                        case 'biasa' :
                            return '<span class="badge badge-primary">Biasa</span>';
                            break;
                        case 'segera' :
                            return '<span class="badge badge-info">Segera</span>';
                            break;
                        case 'penting' :
                            return '<span class="badge badge-warning">Penting</span>';
                            break;
                        case 'rahasia' :
                            return '<span class="badge badge-danger">Rahasia</span>';
                            break;
                    }
                })
                ->editColumn('status', function($row){
                    switch ($row->status) {
                        case '1' :
                            return '<span class="badge badge-warning">Belum di Baca</span>';
                            break;
                        case '2' :
                            return '<span class="badge badge-secondary">Sudah Dibaca</span>';
                            break;
                    }
                })
                ->editColumn('tgl_surat', function ($row) {
                    return Carbon::parse($row->tgl_surat)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_acara', function ($row) {
                    if ($row->tgl_acara == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_acara)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_sampai', function ($row) {
                    if ($row->tgl_sampai == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_sampai)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_disposisi', function ($row) {
                    if ($row->tgl_disposisi == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_disposisi)->translatedFormat('d M Y');
                })
                ->editColumn('created_by', function($row){
                    return $row->userCreate->name;
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('surat.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" href="' . route('get.view', $row->uuid) . '"><i class="fal fa-info"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','sifat_surat','status'])
                ->make(true);
        }
        $surat = Surat::all();

            return Datatables::of($myDate)
                ->addIndexColumn()
                ->editColumn('sifat_surat', function($row){
                    switch ($row->sifat_surat) {
                        case 'biasa' :
                            return '<span class="badge badge-primary">Biasa</span>';
                            break;
                        case 'segera' :
                            return '<span class="badge badge-info">Segera</span>';
                            break;
                        case 'penting' :
                            return '<span class="badge badge-warning">Penting</span>';
                            break;
                        case 'rahasia' :
                            return '<span class="badge badge-danger">Rahasia</span>';
                            break;
                    }
                })
                ->editColumn('status', function($row){
                    switch ($row->status) {
                        case '1' :
                            return '<span class="badge badge-warning">Belum di Baca</span>';
                            break;
                        case '2' :
                            return '<span class="badge badge-secondary">Sudah Dibaca</span>';
                            break;
                    }
                })
                ->editColumn('tgl_surat', function ($row) {
                    return Carbon::parse($row->tgl_surat)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_acara', function ($row) {
                    if ($row->tgl_acara == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_acara)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_sampai', function ($row) {
                    if ($row->tgl_sampai == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_sampai)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_disposisi', function ($row) {
                    if ($row->tgl_disposisi == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_disposisi)->translatedFormat('d M Y');
                })
                ->editColumn('created_by', function($row){
                    return $row->userCreate->name;
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('surat.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('surat.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>
                            <a class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" href="' . route('get.download', $row->uuid) . '"><i class="fal fa-print"></i></a>
                            <a class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" href="' . route('get.view', $row->uuid) . '"><i class="fal fa-info"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','sifat_surat','status'])
                ->make(true);
        }

        public function filterSudahBaca (Request $request)
    {
        $myDate = Surat::whereBetween('tgl_surat', array($request->get('start_date'), $request->get('end_date')))
                    ->where('status', '=', 2)->get();

        $user = Auth::user();
            $roles = $user->getRoleNames();
            if ($roles[0] == "sekda") {
                $surat = Surat::all();

            return Datatables::of($myDate)
                ->addIndexColumn()
                ->editColumn('sifat_surat', function($row){
                    switch ($row->sifat_surat) {
                        case 'biasa' :
                            return '<span class="badge badge-primary">Biasa</span>';
                            break;
                        case 'segera' :
                            return '<span class="badge badge-info">Segera</span>';
                            break;
                        case 'penting' :
                            return '<span class="badge badge-warning">Penting</span>';
                            break;
                        case 'rahasia' :
                            return '<span class="badge badge-danger">Rahasia</span>';
                            break;
                    }
                })
                ->editColumn('status', function($row){
                    switch ($row->status) {
                        case '1' :
                            return '<span class="badge badge-warning">Belum di Baca</span>';
                            break;
                        case '2' :
                            return '<span class="badge badge-secondary">Sudah Dibaca</span>';
                            break;
                    }
                })
                ->editColumn('tgl_surat', function ($row) {
                    return Carbon::parse($row->tgl_surat)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_acara', function ($row) {
                    if ($row->tgl_acara == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_acara)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_sampai', function ($row) {
                    if ($row->tgl_sampai == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_sampai)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_disposisi', function ($row) {
                    if ($row->tgl_disposisi == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_disposisi)->translatedFormat('d M Y');
                })
                ->editColumn('created_by', function($row){
                    return $row->userCreate->name;
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('surat.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" href="' . route('get.view', $row->uuid) . '"><i class="fal fa-info"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','sifat_surat','status'])
                ->make(true);
        }
        $surat = Surat::all();

            return Datatables::of($myDate)
                ->addIndexColumn()
                ->editColumn('sifat_surat', function($row){
                    switch ($row->sifat_surat) {
                        case 'biasa' :
                            return '<span class="badge badge-primary">Biasa</span>';
                            break;
                        case 'segera' :
                            return '<span class="badge badge-info">Segera</span>';
                            break;
                        case 'penting' :
                            return '<span class="badge badge-warning">Penting</span>';
                            break;
                        case 'rahasia' :
                            return '<span class="badge badge-danger">Rahasia</span>';
                            break;
                    }
                })
                ->editColumn('status', function($row){
                    switch ($row->status) {
                        case '1' :
                            return '<span class="badge badge-warning">Belum di Baca</span>';
                            break;
                        case '2' :
                            return '<span class="badge badge-secondary">Sudah Dibaca</span>';
                            break;
                    }
                })
                ->editColumn('tgl_surat', function ($row) {
                    return Carbon::parse($row->tgl_surat)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_acara', function ($row) {
                    if ($row->tgl_acara == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_acara)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_sampai', function ($row) {
                    if ($row->tgl_sampai == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_sampai)->translatedFormat('d M Y');
                })
                ->editColumn('tgl_disposisi', function ($row) {
                    if ($row->tgl_disposisi == null){
                        return Carbon::make(null);
                    }
                    return Carbon::parse($row->tgl_disposisi)->translatedFormat('d M Y');
                })
                ->editColumn('created_by', function($row){
                    return $row->userCreate->name;
                })
                ->addColumn('action', function ($row) {
                    return '
                            <a class="btn btn-success btn-sm btn-icon waves-effect waves-themed" href="' . route('surat.edit', $row->uuid) . '"><i class="fal fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm btn-icon waves-effect waves-themed delete-btn" data-url="' . URL::route('surat.destroy', $row->uuid) . '" data-id="' . $row->uuid . '" data-token="' . csrf_token() . '" data-toggle="modal" data-target="#modal-delete"><i class="fal fa-trash-alt"></i></a>
                            <a class="btn btn-primary btn-sm btn-icon waves-effect waves-themed" href="' . route('get.download', $row->uuid) . '"><i class="fal fa-print"></i></a>
                            <a class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" href="' . route('get.view', $row->uuid) . '"><i class="fal fa-info"></i></a>';
                })
                ->removeColumn('id')
                ->removeColumn('uuid')
                ->rawColumns(['action','sifat_surat','status'])
                ->make(true);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('surat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'jenis_surat' => 'required',
            'asal_surat' => 'required',
            'perihal' => 'required',
            'sifat_surat' => 'required',
            'surat' => 'required|mimes:pdf'
        ];

        $messages = [
            '*.required' => 'Field tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
            '*.mimes' => 'File harus berbentuk PDF !'
        ];

        $this->validate($request, $rules, $messages);

        $surat = new Surat();
        $surat->jenis_surat = $request->jenis_surat;
        $surat->nomor_surat = $request->nomor_surat;
        $surat->asal_surat = $request->asal_surat;
        $surat->tgl_surat = $request->tgl_surat;
        $surat->perihal = $request->perihal;
        // $surat->tgl_acara = $request->tgl_acara;
        // $surat->tgl_sampai = $request->tgl_sampai;
        $surat->sifat_surat = $request->sifat_surat;
        $surat->surat = $request->surat;
        $surat->disposisi = $request->disposisi;
        $surat->status = 1;
        $surat->created_by = Auth::user()->uuid;

        if ($image = $request->file('surat')) {
            $destinationPath = 'surat/';
            // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $profileImage = $request->file('surat')->getClientOriginalName();
            $fileName = $image->getClientOriginalName();

            if (file_exists(public_path($destinationPath . $fileName))) {
                toastr()->error('Surat dengan filename tersebut sudah ada!', 'Error');
                return redirect()->back()->withInput()->with('error', 'Surat dengan filename tersebut sudah ada!');
            }

            $profileImage = date('YmdHis') . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $surat->surat = "$profileImage";
        }

        $surat->save();

        toastr()->success('Surat Baru Terbuat', 'Success');
        return redirect()->route('surat.index');
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
        $surat = Surat::uuid($id);
        return view('surat.edit', compact('surat'));
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
        $rules = [
            'jenis_surat' => 'required',
            'asal_surat' => 'required',
            'perihal' => 'required',
            'sifat_surat' => 'required'
        ];

        $messages = [
            '*.required' => 'Field tidak boleh kosong !',
            '*.min' => 'Nama tidak boleh kurang dari 2 karakter !',
        ];

        $this->validate($request, $rules, $messages);
        // dd($request->all());

        $surat = Surat::uuid($id);
        if($request->hasFile('surat')){

            // user intends to replace the current image for the category.  
            // delete existing (if set)
        
            if($oldImage = $surat->surat) {
        
                @unlink(public_path('surat/') . $oldImage);
            }
        
            // save the new image
            $image = $request->file('surat');
            $destinationPath = 'surat/';
            // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            // $profileImage = $request->file('surat')->getClientOriginalName();
            $profileImage = date('YmdHis') . "_" . $image->getClientOriginalName();
            $image->move($destinationPath, $profileImage);
            $surat->surat = "$profileImage";
        }

        $surat->jenis_surat = $request->jenis_surat;
        $surat->nomor_surat = $request->nomor_surat;
        $surat->asal_surat = $request->asal_surat;
        $surat->tgl_surat = $request->tgl_surat;
        $surat->perihal = $request->perihal;
        // $surat->tgl_acara = $request->tgl_acara;
        // $surat->tgl_sampai = $request->tgl_sampai;
        $surat->sifat_surat = $request->sifat_surat;
        $surat->disposisi = $request->disposisi;
        if($surat->status == 1){
            $route = 'surat.index';
        }else{
            $route = 'get.dibaca';
        }
        if(!empty($surat->disposisi)){
            $surat->status = 2;
        }
        $surat->edited_by = Auth::user()->uuid;
        if($surat->status == '2'){
            $surat->tgl_disposisi = Carbon::now()->toDateTimeString();
        }
        $surat->save();

        toastr()->success('Surat Baru Di Edit', 'Success');
        return redirect()->route($route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $surat = Surat::uuid($id);
        $file = public_path('surat/').$surat->surat;
        if(file_exists($file)){
            @unlink($file);
        }
        $surat->delete();
        toastr()->success('Surat Berhasil di Hapus', 'Success');
        return redirect()->route('surat.index');
    }

    public function download(Request $request, $id)
    {
        $surat = Surat::uuid($id);
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path('surat/'.$surat->surat);

        $headers = array(
                'Content-Type: application/pdf',
                );

        return Response::download($file, $surat->surat, $headers);

    }

    public function view(Request $request, $id)
    {
        $surat = Surat::uuid($id);
        $file= public_path('surat/'.$surat->surat);

        if (!file_exists($file)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $headers = array(
                'Content-Type: application/pdf',
                );

        return response()->file($file, $headers);

    }
}
