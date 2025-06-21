<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Online Shop - Form @php isset($produk) ? 'Edit Produk' : 'Tambah Produk'@endphp</title>
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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="mb-0 fw-semibold">{{ isset($produk) ? 'Form Edit produk' : 'Form Tambah produk' }}</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ isset($produk) ? route('updateProduk', $produk->id) : route('addProduk') }}"
                            method="POST" class="equipment-form">
                            @csrf
                            @if (isset($produk))
                                @method('PUT')
                            @endif
                            <div class="mb-3">
                                <label for="id" class="form-label fw-semibold">ID produk</label>
                                <input type="text" class="form-control" id="id" name="id"
                                    pattern="[A-Z]{1}[0-9]{3}" placeholder="Masukkan ID produk (contoh: A123)"
                                    value="{{ old('id', $produk->id ?? '') }}" {{ isset($produk) ? 'readonly' : '' }}
                                    title="ID produk harus terdiri dari 1 huruf besar di awal dan 3 angka di akhir">
                                <small class="text-muted">Format: 1 huruf kapital diikuti 3 angka</small>
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label fw-semibold">Nama produk</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukkan Nama produk"
                                    value="{{ old('nama', $produk->nama ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label fw-semibold">Deskripsi produk</label>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                                    placeholder="Masukkan Deskripsi produk" value="{{ old('deskripsi', $produk->deskripsi ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label fw-semibold">Harga produk</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="harga" name="harga" min="0"
                                        placeholder="Masukkan Harga produk"
                                        value="{{ old('harga', $produk->harga ?? '') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="stok" class="form-label fw-semibold">Stok produk</label>
                                <input type="number" class="form-control" id="stok" name="stok" min="0"
                                    placeholder="Masukkan Stok produk" value="{{ old('stok', $produk->stok ?? '') }}">
                            </div>

                            <div class="d-flex mt-4 gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="fas fa-save me-1"></i> {{ isset($produk) ? 'Update' : 'Tambah' }}
                                </button>
                                <a href="{{ route('index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
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
