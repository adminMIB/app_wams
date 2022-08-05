@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Project Timeline</h1>
    </div>


    <div class="tasks">
        <!-- .tasks-header -->
        <div class="task-header">
        </div><!-- /.tasks-header -->
        <!-- .task-body -->
        <div class="task-body" data-toggle="sortable" data-group="tasks" data-delay="50" data-force-fallback="true">
            <!-- .task-issue -->
            <div class="task-issue">
                <!-- .card -->
                <div class="card">
                    <!-- .card-header -->
                    <div class="card-header">
                        <div class="task-label-group">
                            <span class="task-label bg-teal"></span> <span class="task-label bg-green"></span>
                        </div>
                        <h4 class="card-title">
                            {{$time->lists->project}}
                            <br>
                            <span class="text-muted">{{$time->start_date}}</span> / <span class="text-muted">{{$time->finish_date}}</span>
                        </h4>

                        <h6 class="card-subtitle text-muted">

                        </h6>
                    </div><!-- /.card-header -->
                    <!-- .card-body -->
                    <div class="card-body pt-0">
                        <!-- .list-group -->
                        <div class="list-group">
                            <!-- .list-group-item -->
                            <div class="list-group-item" data-toggle="modal" data-target="#modalViewTask">
                                <a href="#" class="stretched-link"></a> <!-- .list-group-item-body -->
                                <div class="list-group-item-body">
                                    <h4>{{$time->nama_technical}}</h4>
                                </div><!-- /.list-group-item-body -->
                            </div><!-- /.list-group-item -->
                        </div><!-- /.list-group -->
                    </div><!-- /.card-body -->
                    <!-- .card-footer -->
                    <div class="card-footer">
                        <h5>{{$time->jenis_pekerjaan}}</h5>
                    </div><!-- /.card-footer -->
                </div><!-- .card -->
            </div><!-- /.task-issue -->
            <!-- .task-issue -->


        </div><!-- /.task-body -->
        <a href="{{route('timeline')}}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
</section>

@endsection