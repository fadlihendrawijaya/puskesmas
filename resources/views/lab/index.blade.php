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

<div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between py-3">               
        <h6 class="m-0 font-weight-bold text-primary">Daftar Fasilitas Lab</h6>
        <a href="{{route('lab.tambah')}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm"></i> Tambah Lab</a> 
    </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nama lab</th>
                  <th>Harga</th>
                  <th>Tindakan</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($labs as $lab)
                <tr>
                  <td>{{$lab->id }}</td>
                  <td>{{ $lab->nama }}</td>
                  <td>{{ formatrupiah($lab->harga)}}</td>
                  <td>
                    <a href ="{{ url('lab/edit/'. $lab->id) }}" class="btn btn-sm btn-icon-split btn-warning">
                        <span class="icon"><i class="fa fa-pen" style="padding-top: 4px;"></i></span><span class="text">Edit</span>
                    </a>
                    <a href="{{url('lab/hapus/'.$lab->id)}}" class="btn btn-danger btn-sm btn-flat" onclick="return confirm ('Apakah Akan Anda Hapus?')">Hapus</a>

                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      @endsection