<!-- Add Permission Modal -->
<div class="modal fade" id="addEditPremission" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-2" id="title-header">Add New Users</h3>
                </div>
                <form id="addEditPremissionForm" class="row" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" id="type" name="type">
                    <input type="hidden" id="user_id" name="user_id">
                    <input type="hidden" name="_method" id="_method" value="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Username </label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Username" autocomplete="off" autofocus />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="password">Password </label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Password" autocomplete="off" autofocus />
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="email">Email </label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Email" autocomplete="off" autofocus />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="roles">Role</label>
                            <select id="roles"
                                    name="roles"
                                    class="select2 form-select form-select-lg"
                                    data-allow-clear="true"
                                    autofocus>
                                <option value="">----Pilih----</option>
                                @foreach ($roles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        

<!--                      
                        <div class="col-12 mb-3 ">
                            <label class="form-label mb-2" for="permissions">Permissions</label>
                            <div class="row ">
                                @foreach($permissions->chunk(ceil($permissions->count() / 3)) as $chunk)
                                <div class="col-md-4">
                                    @foreach($chunk as $permission)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" id="permissions{{ $permission->id }}" value="{{ $permission->id }}">
                                        <label class="form-check-label" for="permissions{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div> -->

 
                        <div class="col-12 text-center demo-vertical-spacing">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Discard</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->
