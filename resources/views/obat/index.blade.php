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
        <h6 class="m-0 font-weight-bold text-primary">Daftar Stok Obat</h6>
        {{-- <a href="{{route('obat.tambah')}}" class="d-none d-sm-inline-block btn btn-primary btn-sm shadow-sm"> --}}
        <i class="fas fa-plus fa-sm"></i> Tambah Obat</a> 
    </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nama Obat</th>
                  <th>Sediaan</th>
                  <th>Dosis</th>
                  <th>Stok</th>
                  <th>Harga</th>
                  <th>Tindakan</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($obats as $obat)
                <tr>
                  <td>{{$obat->id }}</td>
                  <td>{{ $obat->nama_obat }}</td>
                  <td>{{ $obat->sediaan }}</td>
                  <td>{{ $obat->dosis }} {{$obat->satuan}}</td>
                  <td>{{ $obat->stok }}</td>
                  <td>{{ formatrupiah($obat->harga)}}</td>
                  <td>
                    {{-- <a href ="{{ route('obat.edit', $obat->id) }}" class="btn btn-sm btn-icon-split btn-warning"> --}}
                        <span class="icon"><i class="fa fa-pen" style="padding-top: 4px;"></i></span><span class="text">Edit</span>
                    </a>
                    {{-- <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$obat->id}})" data-target="#DeleteModal" class="btn btn-sm btn-icon-split btn-danger"> --}}
                        <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span class="text">Hapus</span></a>

                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
<script type="text/javascript">
 function deleteData(id)
 {
     var id = id;
     var url = '{{ route("obat.destroy", ":id") }}';
     url = url.replace(':id', id);
     $("#deleteForm").attr('action', url);
 }

 function formSubmit()
 {
     $("#deleteForm").submit();
 }
</script>
@endsection