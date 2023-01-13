<div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myCenterModalLabel">Add Task</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form role="form" action="{{ url('/save-data') }}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="listL_id" value="{{$shorder->id}}">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Title</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm" name="job_essay" id="inputEmail3" >
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="text-sm col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control text-sm" name="start_date" id="inputEmail3" >
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">End Date</label>
                    <div class="col-sm-10">
                    <input type="date" class="form-control text-sm" name="end_date" id="inputEmail3" >
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Status</label>
                    <div class="col-sm-10">
                        <select name="status" id="" class="text-sm form-control">
                            <option value=""></option>
                            <option value="0">To Do</option>
                            <option value="1">In Progress</option>
                            <option value="2">Done</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Description</label>
                    <div class="col-sm-10">
                    <textarea name="note" class="form-control text-sm" id="" rows="5"></textarea>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>