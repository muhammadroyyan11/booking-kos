@extends('layouts.backend.app')
@section('title','Data Kosan')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @elseif($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $data['title'] }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            {{-- ISI --}}
                            <?php
                                if (\Illuminate\Support\Facades\Auth::user()->role != 'Admin'){
                                    $route = '/pemilik/laporan/cetak';
                                } else {
                                    $route = 'laporan/cetak';
                                }
                            ?>
                            <form action="<?= $route?>" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <label class="col-form-label">Tanggal</label>
                                            <input name="tanggal" id="tanggalrange" type="text" class="form-control"
                                                   placeholder="Periode Tanggal">
                                        </div>
                                        <div class="col-sm-2">
                                            <br>
                                            <button type="submit" class="btn btn-primary mt-1">Tampilkan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('scripts')
    <script type="text/javascript">
        // Status Kamar
        $(document).on('click', '#statusKamar', function () {
            var id = $(this).attr('data-id-kamar');
            $.get('status-kamar', {'_token': $('meta[name=csrf-token]').attr('content'), id: id}, function (_resp) {
                location.reload()
            });
        });
    </script>
@endsection
