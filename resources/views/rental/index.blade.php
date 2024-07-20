@extends('auth.layouts')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container mt-4">
    <h1>Data Peminjaman</h1>
    <div class="row">
        <div class="col-12 col-sm-6">
            <button class="btn btn-primary mb-2" onclick="showCreateForm()">Tambah Peminjaman</button>
        </div>
    </div>

    <table class="table table-bordered" id="rentalTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pengguna</th>
                <th>Mobil</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Akhir</th>
                <th>Total Biaya</th>
                <th>Pengembalian</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal for Create and Edit Rental -->
<div class="modal fade" id="rentalModal" tabindex="-1" role="dialog" aria-labelledby="rentalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTitle">Tambah Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rentalForm">
                    @csrf
                    <input type="hidden" id="rentalId">
                    <div class="form-group">
                        <label>Pengguna</label>
                        <select id="user_id" class="form-control" required>
                            <!-- Options should be populated dynamically -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mobil</label>
                        <select id="car_id" class="form-control" required>
                            <!-- Options should be populated dynamically -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="date" id="start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input type="date" id="end_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Total biaya</label>
                        <input type="number" id="total_cost" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Pengembalian</label>
                        <select id="returned" class="form-control">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="rentalForm" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Viewing Rental -->
<div class="modal fade" id="ViewrentalModal" tabindex="-1" role="dialog" aria-labelledby="ViewrentalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Detail Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Pengguna:</strong> <span id="userDetails"></span></p>
                <p><strong>Mobil:</strong> <span id="carDetails"></span></p>
                <p><strong>Tanggal Mulai:</strong> <span id="startDate"></span></p>
                <p><strong>Tanggal Akhir:</strong> <span id="endDate"></span></p>
                <p><strong>Total biaya:</strong> <span id="totalCost"></span></p>
                <p><strong>Pengembalian:</strong> <span id="returnedStatus"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        var table = $('#rentalTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('rentals.index') }}",
                type: 'GET',
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'user.fullname',
                    name: 'user.fullname'
                },
                {
                    data: 'car.brand',
                    name: 'car.brand'
                },
                {
                    data: 'start_date',
                    name: 'start_date'
                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'total_cost',
                    name: 'total_cost',
                },
                {
                    data: 'returned',
                    name: 'returned',
                    render: function(data) {
                        return data ? 'Ya' : 'Tidak';
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#rentalForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#rentalId').val();
            let url = id ? `/rentals/${id}` : '/rentals';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    user_id: $('#user_id').val(),
                    car_id: $('#car_id').val(),
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val(),
                    total_cost: $('#total_cost').val(),
                    returned: $('#returned').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#rentalModal').modal('hide');
                    $('#rentalForm')[0].reset();
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
                    let errorMessage = 'Operation failed!';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors).flat().join(', ');
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });
        });

        loadCars();
        loadUsers();

        function loadUsers() {
            $.ajax({
                url: '/users',
                method: 'GET',
                success: function(response) {
                    populateUserDropdown(response.data);
                },
                error: function(error) {
                    console.error('Error fetching car data:', error);
                }
            });
        }

        function loadCars() {
            $.ajax({
                url: '/cars',
                method: 'GET',
                success: function(response) {
                    populateCarDropdown(response.data);
                },
                error: function(error) {
                    console.error('Error fetching car data:', error);
                }
            });
        }

        function populateUserDropdown(users) {
            let userDropdown = $('#user_id');
            userDropdown.empty();
            $.each(users, function(index, user) {
                userDropdown.append(
                    $('<option>', {
                        value: user.id,
                        text: `${user.fullname} (${user.phone})`
                    })
                );
            });
        }

        function populateCarDropdown(cars) {
            let carDropdown = $('#car_id');
            carDropdown.empty();
            $.each(cars, function(index, car) {
                carDropdown.append(
                    $('<option>', {
                        value: car.id,
                        text: `${car.brand} ${car.model} (${car.plate_number})`
                    })
                );
            });
        }

        $(document).on('click', '.view', function() {
            let id = $(this).data('id');
            $.ajax({
                url: `/rentals/${id}`,
                method: 'GET',
                success: function(response) {
                    $('#modalTitle').text('Detail Peminjaman');
                    $('#userDetails').text(response.user.fullname);
                    $('#carDetails').text(response.car.brand + ' ' + response.car.model);
                    $('#startDate').text(response.start_date);
                    $('#endDate').text(response.end_date);
                    $('#totalCost').text(response.total_cost);
                    $('#returnedStatus').text(response.returned ? 'Yes' : 'No');
                    $('#ViewrentalModal').modal('show');
                }
            });
        });
        $(document).on('click', '.delete', function() {
            let id = $(this).data('id');
            let car = $(this).data('car');

            Swal.fire({
                title: 'Hapus Peminjaman',
                text: 'Apakah ingin menghapus peminjaman untuk mobil ' + car + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/rentals/${id}`,
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
        $('#formTitle').text('Tambah Peminjaman');
        $('#rentalForm')[0].reset();
        $('#rentalId').val('');
        $('#rentalModal').modal('show');
    }
    $(document).on('click', '.edit', function() {
        let id = $(this).data('id');
        $.ajax({
            url: `/rentals/${id}`,
            method: 'GET',
            success: function(response) {
                $('#formTitle').text('Edit Peminjaman');
                $('#rentalId').val(response.id);
                $('#user_id').val(response.user_id);
                $('#car_id').val(response.car_id);
                $('#start_date').val(response.start_date);
                $('#end_date').val(response.end_date);
                $('#total_cost').val(response.total_cost);
                $('#returned').val(response.returned);
                $('#rentalModal').modal('show');
            }
        });
    });
</script>
@endsection