<div class="p2">
    <div class="form-group d-flex">
        <h4 style="font-size: 20px"  > <img src="{{asset('image/pr.png')}}" width="30" height="30" alt="" srcset=""> {{$data->job_essay}} </h4>
    </div>
    <br>
    <div class="form-group d-flex">
        <form action="{{route('update.des',$data->id)}}" method="POST">
            @csrf
            <div class="col">
                <h4 style="font-size: 20px;"  > <img src="{{asset('image/list.png')}}" width="30" height="30" alt="" srcset=""> <span style="margin-bottom: 3%">Description</span></h4>
                <textarea name="note" class="form-control" id="" cols="30" >{{$data->note}}</textarea>
            </div>
            @if (Auth::user()->hasRole('Technikal'))
            <button class="btn icon btn-primary btn-sm mt-2" type="submit"><i class="bi bi-save2"></i></button>
            @endif
        </form>
        <div class="col">
            <h4 style="font-size: 20px;"  > <img src="{{asset('image/status.png')}}" width="40" height="40" alt="" srcset=""> <span style="">Status</span></h4>
            <p class="" style="margin-left: 40%" >   
                @if ($data->status == 0)
                <div class="badge bg-primary" style="margin-left: 18%">To Do</div>
                @elseif ($data->status == 1)
                <div class="badge bg-warning" style="margin-left: 18%">In Progress</div>
                @elseif ($data->status == 2)
                <div class="badge bg-success" style="margin-left: 18%">Done</div>
                @endif 
        </div>
        <div class="col">
        <h4 style="font-size: 20px;margin-left:14%;"  > <img src="{{asset('image/po.png')}}" width="30" height="30" alt="" srcset="">Technikal </h4>
        <p class="ml-4" style="margin-left: 27%" >   
            {{$data->name_technikal}}</p>
        </div>
    </div>
    <br>
    <form action="{{url('show-simpan',$data->id)}}" method="POST" id="comment-one"  >
        @csrf
        <input type="hidden" name="weekly_id" value="{{$data->id}}">
        <input type="hidden" name="parent_id" value="0">
        <div class="form-group d-flex">
            @php($avatar = auth()->user()->avatar)  
            @if($avatar == null)
            <div class="avatar avatar-md2" >
                <img src="{{ asset('image/user.png') }}" alt="Avatar" class="border">
            </div>
            @else
            <div class="avatar avatar-md2" >
                <img src="{{ asset('storage/users/'.auth()->user()->avatar) }}" alt="Avatar" class="border">
            </div>
            @endif
            <textarea name="content" class="text-sm form-control" style="margin-left: 1%" id="comment-one" cols="10" placeholder="Tulis komentar disini..."></textarea>
        </div>
    <div class="form-group mt-2">
        <button type="submit" class="btn btn-primary btn-sm" style="margin-left: 7%" >Save</button>
    </div>
</form>

<ul class="list-unstyled activity-list mt-4">
    @foreach ($data->taskdiscussion()->where('parent_id',0)->orderBy('created_at','desc')->get() as $item)
    <div class="border" >
        <li class="d-flex " >
            <div class="avatar avatar-md2" >
                <img src="{{ asset('image/user.png') }}" alt="Avatar" class="border">
            </div>
    
            <p style="margin-left: 1%;font-size:13px"><a >{{$item->user->name}} ~  <span class="timestamp" style="font-size: 10px">{{$item->created_at->diffForHumans()}}</span> </a> <br> {{$item->content}}</p>
            
        </li>
        @foreach ($item->child as $childs)
        <li class="d-flex " style="margin-left: 6%">
            <div class="avatar avatar-md2" >
                <img src="{{ asset('image/user.png') }}" alt="Avatar" class="border">
            </div>
            <p style="margin-left: 1%;font-size:13px"><a >{{$childs->user->name}} ~  <span class="timestamp" style="font-size: 10px">{{$childs->created_at->diffForHumans()}}</span> </a> <br> {{$childs->content}}</p>
        </li>
        @endforeach
        
        <form action="{{url('show-simpanT',$data->id)}}" method="POST" id="comment-two" style="margin-left: 6%">
            @csrf
            <input type="hidden" name="weekly_id" value="{{$data->id}}">
            <input type="hidden" name="parent_id" value="{{$item->id}}">
            <textarea  name="content"  class="text-sm form-control "  id="comment-two"   cols="4" placeholder="Balas komentar disini..."></textarea>
            <button  type="submit" class="btn btn-primary btn-sm mt-2"  id="btn-one">Kirim</button>
        </form>
    </div>
    <br>
    @endforeach
</ul>
</div>


