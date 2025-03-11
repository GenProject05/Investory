@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <h2 class="text-center text-primary fw-bold">Investory - Kelola Keuangan dengan Mudah</h2>
                    <p class="text-center text-muted">Aplikasi pembukuan dan investasi terbaik untuk mengelola finansial Anda.</p>

                    <div class="row text-center mt-4">
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded">
                                <h4 class="text-success">Rp 10.000.000</h4>
                                <p>Total Investasi</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded">
                                <h4 class="text-danger">Rp 2.000.000</h4>
                                <p>Pengeluaran</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded">
                                <h4 class="text-info">Rp 8.000.000</h4>
                                <p>Saldo Tersisa</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('transactions.index') }}" class="btn btn-primary">Kelola Transaksi</a>
                        <a href="{{ route('investments.index') }}" class="btn btn-success">Lihat Investasi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
