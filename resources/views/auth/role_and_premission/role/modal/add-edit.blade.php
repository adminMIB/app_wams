<!-- Add role Modal -->
<div class="modal fade" id="addEditRoles" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-2" id="title-header">Add New Roles</h3>
                </div>
                <form id="addEditRolesForm" class="row" onsubmit="return false">
                    @csrf
                    <input type="hidden" id="type">
                    <input type="hidden" id="roles_id">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" autocomplete="off" autofocus />
                        </div>
                        <div class="col-12 mb-3 ">
                            <label class="form-label mb-2" for="permissions">Permissions</label>
                            <div class="row ">
                                @foreach($permissions->chunk(ceil($permissions->count() / 3)) as $chunk)
                                <div class="col-md-4">
                                    @foreach($chunk as $permission)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" id="permissions{{ $permission->name }}" value="{{ $permission->name }}">
                                        <label class="form-check-label" for="permissions{{ $permission->name }}">{{ $permission->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 text-center demo-vertical-spacing">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>