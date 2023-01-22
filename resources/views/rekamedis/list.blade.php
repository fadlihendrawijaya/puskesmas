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
    <a href="#Identitas" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Identitas">
      <h6 class="m-0 font-weight-bold text-primary">Identitas Pasien</h6></a>
    <div class="collapse show" id="Identitas">
    <div class="card-body">
        @if (isset($idens))
        @foreach ($idens as $iden)
        <form class="user" action="">
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="Nama_Lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control " name="Nama_Lengkap" value="{{$iden->nama}}" readonly>
                </div>
              <div class="col-sm-6">
                <label for="Tanggal_Lahir">Tanggal lahir :</label>
                <input type="date" class="form-control " name="Tanggal_Lahir"  value="{{$iden->tgl_lhr}}" readonly>
              </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="Alamat">Alamat</label>
                    <input type="text" class="form-control " name="Alamat"  value="{{$iden->alamat}}" readonly>   
                </div>
                <div class="col-sm-6">
                    <label for="jk">Jenis Kelamin</label>
                    <input type="text" class="form-control " name="jk" value="{{$iden->jk}}" readonly> 
                  </div>
                </div>
            
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="no_bpjs">No. BPJS</label>
                    <input type="text" class="form-control " name="no_bpjs" value="{{$iden->no_bpjs}}" readonly>
              </div>
              <div class="col-sm-6">
                <label for="no_handphone">No. Handphone</label>
                <input type="text" class="form-control " name="no_handphone"  value="{{$iden->hp}}" readonly>
              </div>
            </div>
        </form>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
              </div>
              <div class="col-sm-6" align="right">
                <a href="{{route('rekamedis.tambah.id',$iden->id)}}" class="d-none d-sm-inline btn btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm"></i> Tambah Rekam Medis</a>
                </a>
              </div>
            </div>

        @endforeach
    @endif
    </div>
    </div>
</div>

<div class="card shadow mb-4">

    <!-- Card Header - Accordion -->
    <a href="#PilihPasien" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="PilihPasien">
      <h6 class="m-0 font-weight-bold text-primary">Jejak Rekam Medis</h6></a>


    <!-- Card Content - Collapse -->
    <div class="collapse show" id="PilihPasien" style="">
      <div class="card-body">
      
       <div class="table-responsive">
    <table class="table table-bordered table-striped" id="pasien" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Id</th>
          <th>Tanggal Periksa</th>
          <th>Keluhan Utama</th>
          <th>Lab</th>
          <th>Diagnosis</th>
          <th>Terapi</th>
          <th>Tindakan</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($rms as $rm)
        <tr>
          <td>{{str_pad($rm->id, 4, '0', STR_PAD_LEFT)  }}</td>
          <td>{{ format_date($rm->created_time) }}</td>
          <td>{{ $rm->ku }}</td>
          <td>
          @if ($rm->lab != NULL)
            @for ($i=0;$i<sizeof($lab=encode($rm->lab));$i++)
                @if ($has=encode($rm->hasil))
                    <li>{{get_value('lab',$lab[$i],'nama')}} : {{$has[$i]}} {{get_value('lab',$lab[$i],'satuan')}}</li>
                @endif
            @endfor
          @endif
          </td>
          <td>{{ $rm->diagnosis}}</td>
          <td>
          @if ($rm->resep != NULL)
            @for ($i=0;$i<sizeof($resep=encode($rm->resep));$i++)
                @if ($aturan=encode($rm->aturan))
                    <li>{{ get_value('obat',$resep[$i],'nama_obat')}} {{ get_value('obat',$resep[$i],'sediaan')}} {{ get_value('obat',$resep[$i],'dosis')}} {{ get_value('obat',$resep[$i],'satuan')}} : {{$aturan[$i]}}</li>
                @endif
            @endfor
          @endif
          </td>
          <td width="120px">
            <a href="{{url('rekamedis/edit/'. $rm->id)}}" class="btn btn-warning btn-sm btn-icon-split">
            <span class="icon">
            <i style="padding-top:4px"class="fas fa-pen"></i>
            </span>
            <span class="text">Edit</span>
            </a>
            <a href="{{route('rekamedis.lihat', $rm->id)}}" class="btn btn-success btn-sm btn-icon-split">
            <span class="icon">
            <i style="padding-top:4px"class="fas fa-eye"></i>
            </span>
            <span class="text">Lihat</span>
            </a>
            <a href="{{route('tagihan', $rm->id)}}" class="btn btn-secondary btn-sm btn-icon-split">
            <span class="icon">
            <i style="padding-top:4px"class="fas fa-cart-plus"></i>
            </span>
            <span class="text">Tagihan</span>
            </a>
            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$rm->id}})" data-target="#DeleteModal" class="btn btn-sm btn-icon-split btn-danger">
            <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span class="text">Hapus</span></a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
      </div>
    </div>
@endsection