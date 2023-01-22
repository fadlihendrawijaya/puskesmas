@extends('layouts.app')
@foreach ($metadatas as $metadata)
@section('judul_halaman')
{{ $metadata->Judul }}
@endsection
@section('deskripsi_halaman')
{{ $metadata->Deskripsi }}
@endsection
@endforeach
@section('content')
@foreach ($datas as $data)
<div class="card shadow mb-4">
<div class="card-header d-sm-flex align-items-center justify-content-between py-3">
    <h6 class="m-0 font-weight-bold text-primary">Formulir Edit lab</h6>
    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal" class="btn btn-sm btn-icon-split btn-danger">
        <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span class="text">Hapus</span>
    </a>
</div>
<div class="card-body">
    <code class="mb-6">Data terakhir diperbaharui {{ hitung_usia($data->updated_time) }} yang lalu</code>
    <form class="user" action="{{route('lab.update')}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control " name="nama_lab" value="{{ $data->nama }}" placeholder="Nama Pemeriksaan Lab" >
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control " name="satuan" value="{{ $data->satuan }}" placeholder="Satuan" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-money-bill-wave fa-fw"></i></div>
                    </div>
                    <input type="text" class="form-control " name="harga" value="{{ $data->harga }}" placeholder="Harga lab">
                </div></div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <a href="{{route ('lab')}}" class="btn btn-danger btn-block btn">
                        <i class="fas fa-arrow-left fa-fw"></i> Kembali
                    </a>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-block" name="simpan" value="simpan" >
                        <i class="fas fa-save fa-fw"></i> Simpan
                    </button>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-warning btn-block" name ="simpan" value="simpan_baru">
                        <i class="fas fa-plus fa-fw"></i> Simpan Dan Buat Baru
                    </button>
                </div>    
            </div>                      
        </form>
        @endforeach
    </div>
</div>
@endsection