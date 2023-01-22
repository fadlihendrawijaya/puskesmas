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
        @endforeach
    
    </div>
    </div>
</div>
@foreach ($datas as $data)
<div class="card shadow mb-4">
    <a href="#tambahrm" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="tambahrm">
      <h6 class="m-0 font-weight-bold text-primary">Rekam Medis pasien</h6> </a> 
</a>
    <div class="collapse show" id="tambahrm">
    <div class="card-body">
    <div class="row">
        <div class="col-sm-12" align="right">
        <a href="{{url('rekamedis/edit/'. $data->id)}}" class="btn btn-warning btn-icon-split">
            <span class="icon">
            <i style="padding-top:4px"class="fas fa-pen"></i>
            </span>
            <span class="text">Edit</span>
            </a>
            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$data->id}})" data-target="#DeleteModal" class="btn btn-icon-split btn-danger">
            <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span class="text">Hapus Rekam Medis</span></a>
        </div>
    </div>
        <form class="user" action="{{route('rekamedis.update')}}" method="post">
        {{csrf_field()}}
        
        <input type="hidden" name="idpasien" value="{{ $data->idpasien }}">
        <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="form-group row">
                <div class="col-sm-3 text-md-right">
                    <label for="keluhan-utama"><strong>Tanggal Periksa</strong></label>
                </div>
                <div class="col-sm-1 text-md-center">
                    :
                </div>
                <div class="col-sm-8">
                    <p class="text-md-left">{{ format_date($data->created_time) }}</p>
                </div>
            </div>
                <div class="form-group row">
                <div class="col-sm-3 text-md-right">
                    <label ><strong>Dokter Pemeriksa</strong></label>
                </div>
                <div class="col-sm-1 text-md-center">
                    :
                </div>
                <div class="col-sm-8">
                   <p class="text-md-left">dr. {{ get_value('users',$data->dokter,'name') }}</p>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-md-right">
                    <label for="keluhan-utama"><strong>Keluhan Utama</strong></label>
                </div>
                <div class="col-sm-1 text-md-center">
                    :
                </div>
                <div class="col-sm-8">
                    <p class="text-md-left">{{ $data->ku }}</p>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-md-right">
                    <label for="keluhan-utama"><strong>Anamnesis</strong></label>
                </div>
                <div class="col-sm-1 text-md-center">
                    :
                </div>
                <div class="col-sm-8">
                    <p class="text-md-left">{{ $data->anamnesis}}</p>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-md-right">
                    <label for="keluhan-utama"><strong>Pemeriksaan Fisix</strong></label>
                </div>
                <div class="col-sm-1 text-md-center">
                    :
                </div>    
                <div class="col-sm-8">
                    <p class="text-md-left">{{ $data->pxfisik}}</p>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-md-right">
                    <label for="keluhan-utama"><strong>Pemeriksaan Penunjang</strong></label>
                </div>
                <div class="col-sm-1 text-md-center">
                    :
                </div>
                <div class="col-sm-8">
                    @if ($data->lab != NULL)
                    @for ($i=0;$i<$num['lab'];$i++) <li> {{get_value('lab',array_keys($data->labhasil)[$i],'nama')}} : {{$data->labhasil[array_keys($data->labhasil)[$i]]}} {{get_value('lab',array_keys($data->labhasil)[$i],'satuan')}} </li>
                    
                    @endfor
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-md-right">
                    <label for="keluhan-utama"><strong>Diagnosis</strong></label>
                </div>
                <div class="col-sm-1 text-md-center">
                    :
                </div>
                <div class="col-sm-8">
                    <p class="text-md-left">{{ $data->diagnosis }}</p>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-md-right">
                    <label for="keluhan-utama"><strong>Resep</strong></label>
                </div>
                <div class="col-sm-1 text-md-center">
                    :
                </div>
                
                <div class="col-sm-8">
                @if ($data->resep != NULL)                          
                    @for ($i=0;$i<$num['resep'];$i++)
                        <li class="text-md-left">{{get_value('obat',array_keys($data->allresep)[$i],'nama_obat')}} {{get_value('obat',array_keys($data->allresep)[$i],'sediaan')}} {{get_value('obat',array_keys($data->allresep)[$i],'dosis')}}  {{$data->allresep[array_keys($data->allresep)[$i]]}}</li>
                    @endfor
                   @endif
                </div>
                 
            </div>

            
            
            <div class="form-group row">
            <div class="col-sm-4 mb-3 mb-sm-0">
            @foreach ($idens as $iden)
                <a href= "{{route('rekamedis.list',$iden->id)}}" class="btn btn-danger btn-block" name="simpan">
                     <i class="fas fa-arrow-left fa-fw"></i> kembali
                </a>
            @endforeach
            </div>
            <div class="col-sm-4 mb-3 mb-sm-0">

            </div>
            <div class="col-sm-4 mb-3 mb-sm-0">
                <a href="javascript:;" data-toggle="modal" onclick="print()"  class="btn btn-primary btn-block">
                <span class="icon"><i class="fa  fa-print" ></i></span><span class="text"> Cetak</span></a>
            </div> 
        </form>
        @endforeach
    </div>
    </div>
        
</div>
@endsection