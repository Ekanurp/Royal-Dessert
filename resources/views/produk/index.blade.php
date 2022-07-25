@extends('layouts.appAdmin')

@section('content')
    <div class="container py-2">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Data Produk</h5>
                    <a href="{{ route('admin.produk.create') }}" class="btn btn-primary ms-auto">Tambah Data</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Keterangan</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @foreach ($produks as $item)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>
                                    <img src="{{ asset('img/produk/' . $item->gambar) }}" alt="{{ $item->nama_produk }}"
                                        class="img-thumbnail" width="100">
                                </td>
                                <td>{{ $item->harga }}</td>
                                <td>
                                    <a href="{{ route('admin.produk.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('admin.produk.delete', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
@endsection
