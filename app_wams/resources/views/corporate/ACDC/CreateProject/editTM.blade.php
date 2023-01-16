<form action="{{route('update-TMACDC',$item->id)}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Principal</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="principal_name" value="{{ $item->cpt->principal_name }}" required>
        </div>
    </div> 
    
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Client Name</label>
        <div class="col-sm-10">
            <select name="cpt_id" class="form-select" id="">
                <option value="{{ $item->cpt_id }}" hidden > {{ $item->cpt->client_name }}</option>
                <option value=""></option>
                @foreach ($cp as $it)
                    <option value="{{ $it->id}}">{{ $it->client_name}}</option>
                @endforeach
            </select>
        </div>
    </div> 

    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Project Name</label>
        <div class="col-sm-10">
            <select name="project_name" class="form-select" id="">
                <option value="{{ $item->cpt->project_name }}" > {{ $item->cpt->project_name }}</option>
                <option value=""></option>
                @foreach ($cp as $it)
                    <option value="{{ $it->project_name }}">{{ $it->project_name}}</option>
                @endforeach
            </select>
        </div>
    </div> 

    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">ID Project</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="id_project" value="{{ $item->cpt->id_project }}" required>
        </div>
    </div> 
{{--     
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">ID</label>
        <div class="col-sm-10">
            <select name="opptyproject_id" class="form-select" id="">
                <option value="{{ $item->opptyproject_id }}" hidden>{{ $item->tmaker->jenis }} - {{ $item->tmaker->ID_opptyproject }}</option>
                @foreach ($opptprjt as $it)
                    <option value="{{ $it->id }}">{{ $it->jenis }} - {{ $it->ID_opptyproject }}</option>
                @endforeach
            </select>
        </div>
    </div>  --}}
    
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-info" >Submit</button>
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Close</span>
        </button>
    </div>
</form>