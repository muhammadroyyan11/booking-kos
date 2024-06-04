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
                        <h4 class="card-title">{{ $data['title'] }}
                        </h4>
                        <div class="pull-right">
                            <a href="{{route('kamar.promo')}}" class="btn btn-primary btn-flat btn-sm">
                                <i class="fa fa-files-plus"></i> Tambah Kamar
                            </a>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive">
                                <table class="table zero-configuration">
                                    <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th class="text-nowrap">Nama Pemilik</th>
                                        <th class="text-nowrap">Email</th>
                                        <th class="text-nowrap">No HP</th>
                                        <th class="text-nowrap">Kredit Point</th>
                                        {{--                      <th class="text-center">Action</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data['owner'] as $key => $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->no_wa}}</td>
                                            <td>{{$item->credit}}</td>
                                            {{--                      <td class="text-center">--}}
                                            {{--                        <a href="{{url('room', $item->id)}}" class="btn btn-info btn-sm">Show</a>--}}
                                            {{--                       --}}
                                            {{--                      </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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
