<!-- Detail Roles Modal -->
<div class="modal fade" id="detailRolesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailRolesModalTitle">Detail Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="roleName" class="form-label">Role Name:</label>
                    <input type="text" class="form-control" id="roleName" readonly>
                </div>
                <div class="mb-3">
                    <label for="createdAt" class="form-label">Created At:</label>
                    <input type="text" class="form-control" id="createdAt" readonly>
                </div>
                <div class="mb-3">
                    <label for="permissionsList" class="form-label">Permissions:</label>
                    <ul class="list-group" id="permissionsList">
                        <!-- Permissions will be dynamically populated here -->
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- /Detail Roles Modal -->
