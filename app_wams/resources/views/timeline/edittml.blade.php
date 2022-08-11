@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Project Timeline</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="mb-3 row">
                <label for="inputinstitusi" class="col-sm-2 col-form-label">Nama Client</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$time->nama_institusi}}" readonly>
                </div>
            </div>

            <div class="mb-2 row">
                <label for="inputproject" class="col-sm-2 col-form-label">Nama Project</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$time->nama_project}}" readonly>
                </div>
            </div>
            <form action="{{route('updatetml',$time->id)}}" method="post">
                {{csrf_field()}}
                <br>
                @foreach($time->detail as $tm)
                <label class="font-weight-bold">Timeline {{$loop->iteration}}</label>
                <hr class="mt-0">
                <div class="mb-2 row">
                    <label for="inputstart_date" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="start_date[]" value="{{$tm->start_date}}">
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputfinish_date" class="col-sm-2 col-form-label">Finish Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="finish_date[]" value="{{$tm->finish_date}}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputnama_technical" class="col-sm-2 col-form-label">Technikal</label>
                    <div class="col-sm-10">
                    <select name="nama_technical[]" id="" class="form-control">
                        <option value="{{$tm->nama_technical}}">{{$tm->nama_technical}}</option>
                        <option value=""></option>
                        @foreach($b as $t)
                        <option value="{{$t->name}}">{{$t->name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputjenis_pekerjaan" class="col-sm-2 col-form-label">Jenis Pekerjaan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="jenis_pekerjaan[]" value="{{$tm->jenis_pekerjaan}}">
                    </div>
                </div>
                @endforeach
                <div class="technical"></div>
                <a href="{{route('timeline')}}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary btn-sm">Save</button>

            </form>
        </div>
    </div>



</section>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
    $('.addtechnical').on('click', function() {
        addtechnical();
    });

    function addtechnical() {
        var technical = '<div class="container"><div class="row"><div class="col-6 col-sm-5"><label for="" class="">Start Date</label><input type="date" class="form-control" name="start_date[]"> </div><div class="col-6 col-sm-5"><label for="" class="">Finish Date</label><input type="date" class="form-control" name="finish_date[]"></div><div class="w-100 d-none d-md-block"></div><div class="col-6 col-sm-5"><label for="" class="">Jenis Pekerjaan</label><input type="text" class="form-control" name="jenis_pekerjaan[]"></div><div class="col-6 col-sm-5"><label for="" class="">Nama Technical</label><select name="nama_technical[]" id="" class="form-control"><option value=""></option>@foreach($b as $t)<option value="{{$t->name}}">{{$t->name}}</option>@endforeach</select><br><a href="#" class="remove btn btn-danger" style="float:right;"><i class="fas fa-trash"></i></a></form></div></div></div>';
        $('.technical').append(technical);
    };
    $('.remove').live('click', function() {
        $(this).parent().parent().parent().remove();
    });
</script>