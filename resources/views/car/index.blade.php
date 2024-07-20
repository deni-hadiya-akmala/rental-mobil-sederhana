@extends('auth.layouts')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container mt-4">
    <h1>Data Mobil</h1>
    <div class="row">
        <div class="col-12 col-sm-6">
            <button class="btn btn-primary mb-2" onclick="showCreateForm()">Tambah Mobil</button>
        </div>
    </div>

    <table class="table table-bordered" id="carTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Plat Nomor</th>
                <th>Harga Rental</th>
                <th>Tersedia</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal for Create and Edit Car -->
<div class="modal fade" id="carModal" tabindex="-1" role="dialog" aria-labelledby="carModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTitle">Tambah Mobil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="carForm">
                    @csrf
                    <input type="hidden" id="carId">
                    <div class="form-group">
                        <label>Brand</label>
                        <input type="text" id="brand" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Model</label>
                        <input type="text" id="model" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Plat Nomor</label>
                        <input type="text" id="plate_number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Rental</label>
                        <input type="number" id="rental_price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tersedia</label>
                        <select id="is_available" class="form-control">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" form="carForm" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#carTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('cars.index') }}",
                type: 'GET',
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'brand',
                    name: 'brand'
                },
                {
                    data: 'model',
                    name: 'model'
                },
                {
                    data: 'plate_number',
                    name: 'plate_number'
                },
                {
                    data: 'rental_price',
                    name: 'rental_price'
                },
                {
                    data: 'is_available',
                    name: 'is_available',
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

        $('#carForm').on('submit', function(e) {
            e.preventDefault();
            let id = $('#carId').val();
            let url = id ? `/cars/${id}` : '/cars';
            let method = id ? 'PUT' : 'POST'; // PUT untuk update dan POST untuk create

            $.ajax({
                url: url,
                method: method,
                data: {
                    brand: $('#brand').val(),
                    model: $('#model').val(),
                    plate_number: $('#plate_number').val(),
                    rental_price: $('#rental_price').val(),
                    is_available: $('#is_available').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#carModal').modal('hide');
                    $('#carForm')[0].reset();
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


        $(document).on('click', '.edit', function() {
            let id = $(this).data('id');
            $.ajax({
                url: `/cars/${id}`,
                method: 'GET',
                success: function(response) {
                    $('#formTitle').text('Edit Mobil');
                    $('#carId').val(response.id);
                    $('#brand').val(response.brand);
                    $('#model').val(response.model);
                    $('#plate_number').val(response.plate_number);
                    $('#rental_price').val(response.rental_price);
                    $('#is_available').val(response.is_available);
                    $('#carModal').modal('show');
                }
            });
        });

        $(document).on('click', '.delete', function() {
            let id = $(this).data('id');
            let plate_number = $(this).data('plate_number');

            Swal.fire({
                title: 'Hapus Mobil',
                text: 'Apakah ingin menghapus mobil dengan plate number ' + plate_number + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/cars/${id}`,
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
        $('#formTitle').text('Tambah Mobil');
        $('#carForm')[0].reset();
        $('#carId').val('');
        $('#carModal').modal('show');
    }
</script>
@endsection