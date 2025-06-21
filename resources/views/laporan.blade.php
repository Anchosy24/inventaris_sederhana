<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Pengadaan Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .container {
            width: 100%;
            padding: 20px 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 12px;
            margin: 0;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            background-color: #4e73df;
            color: white;
            font-size: 14px;
            font-weight: bold;
            padding: 8px 10px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 11px;
        }
        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin-left: auto;
            margin-bottom: 5px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>LAPORAN PENGADAAN PRODUK</h1>
            <p>Tanggal Cetak: {{ date('d-m-Y') }}</p>
        </div>
        
        <div class="section">
            <div class="section-title">DATA STOK PRODUK YANG MENIPIS</div>
            <table>
                <thead>
                    <tr>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Tanggal dibuat</th>
                        <th>Tanggal diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stokTipis as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->deskripsi }}</td>
                        <td>Rp. {{ number_format($row->harga, 0, ',', '.') }}</td>
                        <td>{{ $row->stok }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="section">
            <div class="section-title">DATA PRODUK YANG BARU DITAMBAHKAN</div>
            <table>
                <thead>
                    <tr>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Tanggal dibuat</th>
                        <th>Tanggal diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produkTerbaru as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->deskripsi }}</td>
                        <td>Rp. {{ number_format($row->harga, 0, ',', '.') }}</td>
                        <td>{{ $row->stok }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            <div class="signature">
                <p>{{ date('d F Y') }}</p>
                <p>Penanggung Jawab</p>
                <br>
                <br>
                <br>
                <p>(________________________)</p>
            </div>
        </div>
    </div>
</body>
</html>