@extends('../layout')
@section('content')
<style>
    @media print {

        nav,
        .navbar,
        .sidebar,
        .btn,
        .header,
        .footer,
        .no-print {
            display: none !important;
        }

        body {
            margin: 0;
            padding: 0;
        }
    }

</style>
<div class="col-12 justify-content-center d-flex no-print">
    <button onclick="window.print()" class="btn btn-sm btn-primary mb-3">
        <i class="ri-printer-line me-1"></i> Cetak Surat
    </button>
</div>
<div style="max-width: 800px; margin: auto; padding: 40px; font-family: 'Times New Roman', serif; border: 1px solid #ccc;">
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="margin-bottom: 0;">PT. {{ $app_setting->app_name }}</h2>
        <p>
            IT SPESIALIST | JASA INSTALASI KOMPUTER | JASA INSTALASI JARINGAN
        </p>
        <small>Jl. Ambatukam No.123, Surabaya</small><br>
        <small>Telp: 021-21696921 | Email: admin@gmail.com</small>
        <hr style="border-top: 2px solid #000;">
    </div>

    <div style="text-align: right;">
        <p>Surabaya, {{ now()->translatedFormat('d F Y') }}</p>
    </div>

    <p class="mb-2">Perihal :</p>
    <p class="mb-0"><strong>Surat Pergerakan Barang</strong><br></p>
    <p class="mb-6">No. {{ $product_stock_movement->custom_id }}</p>

    <p>Dengan hormat,</p>

    <p>
        Bersama ini saya informasikan bahwa telah dilakukan pergerakan stok dengan rincian sebagai berikut:
    </p>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td><strong>Nama Produk</strong></td>
            <td>: {{ $product_stock_movement->product->name }}</td>
        </tr>
        <tr>
            <td><strong>Kode Produk</strong></td>
            <td>: {{ $product_stock_movement->product->sku }}</td>
        </tr>
        <tr>
            <td><strong>Jumlah</strong></td>
            <td>: {{ $product_stock_movement->quantity }} Barang</td>
        </tr>
        <tr>
            <td><strong>Jenis Pergerakan</strong></td>
            <td>: {{ ucfirst($product_stock_movement->movement_type) }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Pergerakan</strong></td>
            <td>: {{ \Carbon\Carbon::parse($product_stock_movement->created_at)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td><strong>Keterangan</strong></td>
            <td>: {{ $product_stock_movement->damage_reason }}</td>
        </tr>
    </table>

    <p>Demikian informasi ini saya sampaikan, atas perhatiannya saya ucapkan terima kasih.</p>

    <br><br>

    <div style="text-align: right;">
        <p>Hormat saya,</p>
        <br>{{ $product_stock_movement->user->name }}<br>
        <strong>PT. {{ $app_setting->app_name }}</strong>
    </div>
</div>
@endsection
