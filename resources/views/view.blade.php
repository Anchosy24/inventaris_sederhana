<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Online Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>

<body>
    <div class="container my-5">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                <h5 class="fw-bold mb-0">Data Produk</h5>
                <div class="align-items-right">
                    <a class="btn btn-light btn-sm fw-semibold" href="{{ route('formProduk') }}">
                        <i class="fas fa-plus-circle me-1"></i> Add Data Produk
                    </a>
                    <a class="btn btn-light btn-sm fw-semibold" href="{{ route('cetak') }}" target="_blank">
                        <i class="fas fa-file-export me-1"></i> Cetak Laporan
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" id="tabel">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">ID Produk</th>
                                <th class="text-center">Nama Produk</th>
                                <th class="text-center">Deskripsi Produk</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Stok Barang</th>
                                <th class="text-center">Tanggal Dibuat</th>
                                <th class="text-center">Tanggal Diperbarui</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $key => $row)
                                <tr>
                                    <td class="text-center">{{ $row->id }}</td>
                                    <td class="text-center">{{ $row->nama }}</td>
                                    <td class="text-center">{{ $row->deskripsi }}</td>
                                    <td class="text-center">Rp. {{ number_format($row->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $row->stok }}</td>
                                    <td class="text-center">{{ $row->created_at }}</td>
                                    <td class="text-center">{{ $row->updated_at}}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('editProduk', $row->id) }}" class="btn btn-primary btn-sm"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('deleteProduk', $row->id) }}" method="POST"
                                                onsubmit="return confirmDelete(event)" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tabel').DataTable({
                ordering: false,
            });
        });

        function confirmDelete(event) {
            event.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Ingin menghapusnya?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonText: "Ya, Hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit(); // Submit the form if confirmed
                }
            });
        }
    </script>
    <!-- SweetAlert Notification -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false,
            });
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 2000,
                showConfirmButton: false,
            });
        </script>
    @endif
    @stack('script')
</body>

</html>
