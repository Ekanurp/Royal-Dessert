@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-star"></i>
                        Favorite
                    </a>
                </li>
            </ul>
            <hr>
        </div>
        <div class="col-7">
            <main>
                <div class="album py-4 bg-light">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                            @foreach ($produks as $item)
                                <div class="col">
                                    <div class="card shadow-sm">
                                        <img class="bd-placeholder-img card-img-top" width="100%" height="200"
                                            src="{{ asset('img/produk/' . $item->gambar) }}" role="img"
                                            aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                                            focusable="false">
                                        </img>

                                        <div class="card-body">
                                            <h6 class="card-title">{{ $item->nama }}</h6>
                                            <p class="card-text">{{ $item->keterangan }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <form action="{{ route('cart.add') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" name="nama" value="{{ $item->nama }}">
                                                    <input type="hidden" name="harga" value="{{ $item->harga }}">
                                                    <input type="hidden" value="1" name="quantity">

                                                    <button type="submit" class="btn btn-sm btn-primary">Add to
                                                        Cart</button>
                                                </form>
                                                <small class="text-muted">Rp. {{ $item->harga }},00</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="col shadow">
            <div class="row">
                <div class="col mt-2 text-center">
                    <button class="btn btn-sm btn-primary"><i class="fas fa-archive"></i> Meja</button>
                    <button class="btn btn-sm btn-primary"><i class="far fa-user-circle"></i> Pelanggan</button>
                </div>
            </div>
            <hr class="sidebar-devider">
            <div class="row">
                <div class="col">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jml</th>
                                <th class="text-center">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartitems as $items)
                                <tr>
                                    <td>{{ $items->name }}</td>
                                    <td>{{ $items->quantity }}</td>
                                    <td class="text-end">Rp. {{ $items->price }},00</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-warning">Remove All Cart</button>
                        </form>
                    </div>

                </div>
            </div>
            <hr class="sidebar-devider">
            <div class="row align-bottom shadow">
                <div class="col">
                    <table class="table text-center">
                        <tfoot>
                            <tr>
                                <th colspan="2">Total</th>

                                <th class="text-end">Rp. {{ Cart::getTotal() }},00</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-light py-5 bg-primary">
        <div class="container">
            Copyright &copy; 2020
        </div>
    </footer>
@endsection
