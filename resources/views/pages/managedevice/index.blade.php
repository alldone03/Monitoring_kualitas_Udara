@extends('pages.template')

@section('content')
    @push('title')
        Manage Device - {{ env('APP_NAME') }}
    @endpush
    @push('links')
        <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon" />
        <link rel="shortcut icon"
            href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
            type="image/png" />
        <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/extensions/toastify-js/src/toastify.css') }}" />
    @endpush
    @push('scripts')
        @include('pages.managedevice.edit')
        @include('pages.managedevice.add')
        @include('pages.managedevice.binduser')
        <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
        <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/compiled/js/app.js') }}"></script>

        <script src="{{ asset('assets/js/extensions/code.jquery.com_jquery-3.7.1.js') }}"></script>
        <script src="{{ asset('assets/js/extensions/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
        <script src="{{ asset('assets/extensions/toastify-js/src/toastify.js') }}"></script>
        <script>
            @if (session()->has('success'))
                Toastify({
                    text: "{{ session('success') }}",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#4fbe87",
                }).showToast()
            @endif
            $(document).ready(function() {
                $('#save').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        data: $('#saveDevice').serialize(),
                        url: "{{ route('managedevice/add') }}",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            // console.log(data);

                            Toastify({
                                text: data.message,
                                duration: 900,
                                close: true,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#4fbe87",
                            }).showToast()
                            setTimeout(() => {
                                window.location.reload();

                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            Toastify({
                                text: err.message,
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#dc3545",
                            }).showToast()
                        }
                    })
                });
                $('.edit').on("click", function(e) {
                    e.preventDefault()
                    var id = $(this).attr('data-bs-id');


                    $.ajax({
                        url: "{{ url()->current() }}/edit/" + id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {

                            $('#iddevice').val(data.id);
                            $('#nama_device').val(data.nama_device);
                            $('#inlineFormEdit').modal('show');
                        }
                    });
                });
                $('#update').on("click", function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "PUT",
                        data: $('#updateDevice').serialize(),
                        url: '{{ url()->current() }}/update/'.concat($('#iddevice')
                            .val()),
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {


                            Toastify({
                                text: data.success,
                                duration: 900,
                                close: true,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#4fbe87",
                            }).showToast()
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        },
                        error: function(data) {

                            Toastify({
                                text: JSON.parse(data.responseText).message,
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#dc3545",
                            }).showToast();
                            $('#inlineFormEdit').modal('show');

                        }

                    })
                });


                $('#bindsend').on("click", function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        data: $('#bindUser').serialize(),
                        url: "{{ route('managedevice/bind') }}",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            console.log(data);
                            if (data.gagal) {
                                Toastify({
                                    text: data.gagal,
                                    duration: 2000,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "#dc3545",
                                }).showToast()
                                setTimeout(() => {
                                    // window.location.reload();

                                }, 2000);
                            } else {
                                Toastify({
                                    text: data.success,
                                    duration: 2000,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    backgroundColor: "#4fbe87",
                                }).showToast()
                                setTimeout(() => {
                                    window.location.reload();

                                }, 2000);
                            }


                        },
                        error: function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            Toastify({
                                text: err.message,
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#dc3545",
                            }).showToast()
                        }
                    })
                });
                $('.addbind').on("click", function(e) {
                    e.preventDefault()
                    $.ajax({
                        url: "{{ route('managedevice/bindshow') }}",
                        type: "POST",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            $('#selectuser').html('');
                            $('#selectdevice').html('');
                            data.user.forEach(element => {
                                $('#selectuser').append($('<option>', {
                                    value: element.id,
                                    text: element.name
                                }))
                            });
                            data.device.forEach(element => {
                                $('#selectdevice').append($('<option>', {
                                    value: element.id,
                                    text: element.nama_device
                                }))
                            });

                            $('#inlineFormAddBindUser').modal('show');
                        }
                    });
                });
            });
        </script>
    @endpush

    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    @extends('pages.layout')
@section('layout-content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manage Device</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#inlineFormAdd">
                            Add Device
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Device</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($device as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->nama_device }}</td>
                                            <td>
                                                <div class="flex">
                                                    <div class="row justify-content-md-around">
                                                        <div class="col-md-1">
                                                            <button type="button" class="btn btn-outline-warning edit"
                                                                data-bs-id="{{ $d['id'] }}">Edit</button>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <form method="POST"
                                                                action="{{ route('managedevice') . '/delete/' . $d['id'] }}"
                                                                onsubmit="return confirm('Are you sure?')">
                                                                @csrf

                                                                <input name="_method" type="hidden"
                                                                    class="btn-primary btn-xs" value="DELETE">
                                                                <button type="submit" class="btn btn-outline-danger">
                                                                    DELETE
                                                                </button>


                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-outline-success addbind" data-bs-toggle="modal"
                            data-bs-target="#inlineFormAddBindUser">
                            Bind User
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Device</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hasilambil as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d['namauser'] }}</td>
                                            <td>{{ $d['namadevice'] }}</td>
                                            <td>
                                                <div class="flex">
                                                    <div class="row justify-content-md-around">

                                                        <div class="col-md-1">
                                                            <form method="POST"
                                                                action="{{ route('managedevice') . '/binddelete/' . $d['id'] }}"
                                                                onsubmit="return confirm('Are you sure?')">
                                                                @csrf

                                                                <input name="_method" type="hidden"
                                                                    class="btn-primary btn-xs" value="DELETE">
                                                                <button type="submit" class="btn btn-outline-danger">
                                                                    DELETE
                                                                </button>


                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@endsection
