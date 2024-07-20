@extends('auth.layouts')

@section('content')
<div class="container mt-4">
    <h1>Data Pengguna</h1>
    <div class="row">
        <div class="col-12 col-sm-6">
            <button class="btn btn-primary mb-2" onclick="showCreateForm()">Tambah Pengguna</button>
        </div>
    </div>

    <table class="table table-bordered" id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Phone</th>
                <th>License Number</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal for Create and Edit User -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTitle">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    @csrf
                    <input type="hidden" id="userId">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="fullname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" id="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>License Number</label>
                        <input type="text" id="license_number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea id="address" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="userForm" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('users.index') }}",
                type: 'GET',
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'fullname',
                    name: 'fullname'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'license_number',
                    name: 'license_number'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#userForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#userId').val();
            let url = id ? `/users/${id}` : '/users';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    fullname: $('#fullname').val(),
                    username: $('#username').val(),
                    phone: $('#phone').val(),
                    license_number: $('#license_number').val(),
                    address: $('#address').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#userModal').modal('hide');
                    $('#userForm')[0].reset();
                    table.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Operation successful!',
                        timer: 3000,
                        showConfirmButton: false
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Operation failed!',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });
        });

        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            $.ajax({
                url: `/users/${id}`,
                method: 'GET',
                success: function(response) {
                    $('#formTitle').text('Edit Pengguna');
                    $('#userId').val(response.id);
                    $('#fullname').val(response.fullname);
                    $('#username').val(response.username);
                    $('#phone').val(response.phone);
                    $('#license_number').val(response.license_number);
                    $('#address').val(response.address);
                    $('#email').val(response.email);
                    $('#userModal').modal('show');
                }
            });
        });

        $(document).on('click', '.delete', function() {
            let id = $(this).data('id');
            let username = $(this).data('username');

            Swal.fire({
                title: 'Hapus Pengguna',
                text: 'Apakah ingin menghapus pengguna dengan username ' + username + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/users/${id}`,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function() {
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                text: 'Delete operation successful!',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Delete operation failed!',
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    });
                }
            });
        });
    });

    function showCreateForm() {
        $('#formTitle').text('Tambah Pengguna');
        $('#userForm')[0].reset();
        $('#userId').val('');
        $('#userModal').modal('show');
    }
</script>
@endsection