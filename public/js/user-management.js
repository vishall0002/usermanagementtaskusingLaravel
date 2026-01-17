$(document).ready(function () {
    let searchTimer;

    // Fetch users (Pagination & Search)
    function fetchUsers(page = 1) {
        let search = $('#search-user').val();
        let trashed = $('#filter-trashed').val();

        $.ajax({
            url: "/users?page=" + page + "&search=" + search + "&trashed=" + trashed,
            success: function (data) {
                $('#user-table-body').html(data.html);
                $('#pagination-links').html(data.pagination);
            }
        });
    }

    // Filter Dropdown Change
    $('#filter-trashed').change(function () {
        fetchUsers();
    });

    // Search Input
    $('#search-user').on('keyup', function () {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            fetchUsers();
        }, 500);
    });

    // Pagination Links
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchUsers(page);
    });

    // Add User Modal
    $('#btn-add-user').click(function () {
        $.get('/users/create', function (data) {
            $('#modal-container').html(data);
            $('#userModal').modal('show');
        });
    });

    // Edit User Modal
    $(document).on('click', '.btn-edit', function () {
        let id = $(this).data('id');
        $.get('/users/' + id + '/edit', function (data) {
            $('#modal-container').html(data);
            $('#userModal').modal('show');
        });
    });

    // Save/Update User
    $(document).on('submit', '#user-form', function (e) {
        e.preventDefault();
        let form = $(this);
        let id = $('#user_id').val();
        let url = id ? '/users/' + id : '/users';
        let method = id ? 'PUT' : 'POST';

        // Add _method field for PUT requests
        let formData = form.serialize();
        if (id) {
            formData += '&_method=PUT';
            method = 'POST'; // Send as POST with _method spoofing
        }

        // Clear errors
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function (response) {
                $('#userModal').modal('hide');
                fetchUsers(); // Refresh table
                alert(response.success);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key).next('.invalid-feedback').text(value[0]);
                    });
                } else {
                    alert('Something went wrong!');
                }
            }
        });
    });

    // Delete User
    $(document).on('click', '.btn-delete', function () {
        if (!confirm('Are you sure you want to delete this user?')) return;

        let id = $(this).data('id');
        $.ajax({
            url: '/users/' + id,
            method: 'DELETE',
            success: function (response) {
                fetchUsers();
                alert(response.success);
            }
        });
    });

    // Restore User
    $(document).on('click', '.btn-restore', function () {
        if (!confirm('Are you sure you want to restore this user?')) return;

        let id = $(this).data('id');
        $.ajax({
            url: '/users/' + id + '/restore',
            method: 'POST',
            success: function (response) {
                fetchUsers();
                alert(response.success);
            }
        });
    });
});
