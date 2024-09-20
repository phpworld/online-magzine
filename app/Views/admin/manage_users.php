<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>
<style>
ul.pagination li {
    padding: 10px;
    background-color: lightblue;
    margin: 4px;
    border-radius: 8px;
}
</style>
<div class="container mt-4">
    <h2>Manage Users</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['id']) ?></td>
                        <td><?= esc($user['name']) ?></td>
                        <td><?= esc($user['email']) ?></td>
                        <td>
                            <span class="badge <?= esc($user['status'] == 1 ? 'bg-success' : 'bg-warning') ?>" id="status-badge-<?= $user['id'] ?>">
                                <?= esc($user['status'] == 1 ? 'Active' : 'Inactive') ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="openEditModal(<?= $user['id'] ?>, '<?= $user['name'] ?>', <?= $user['status'] ?>)">Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <nav>
        <?= $pager->links() ?>
    </nav>
</div>

<!-- Modal for editing user status -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editStatusForm" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit User Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="user-name"></p>
                    <input type="hidden" name="user_id" id="user-id">
                    <label for="status">Change Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEditModal(userId, userName, userStatus) {
    document.getElementById('user-id').value = userId;
    document.getElementById('user-name').innerText = `Changing status for: ${userName}`;
    document.getElementById('status').value = userStatus;

    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}

document.getElementById('saveChanges').addEventListener('click', function() {
    const userId = document.getElementById('user-id').value;
    const newStatus = document.getElementById('status').value;

    // Make sure to add CSRF token to the header
    fetch(`<?= base_url('admin/updateUserStatus/') ?>${userId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const statusBadge = document.getElementById('status-badge-' + userId);
            statusBadge.className = newStatus == 1 ? 'badge bg-success' : 'badge bg-warning';
            statusBadge.innerText = newStatus == 1 ? 'Active' : 'Inactive';
            bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
            alert(data.message);
        } else {
            alert(data.message || 'Failed to update user status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the status.');
    });
});

</script>

<?= $this->endSection() ?>
