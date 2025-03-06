

@section('content')
    <div class="container mt-5">
        <div class="row justify-center">
            <div class="col-md-8">
                <div class="card shadow-lg rounded-3 border border-primary">
                    <div class="card-body text-center">
                        <h1 class="fw-bold text-primary">Investory</h1>
                        <p class="text-muted">Kelola keuangan dan investasi dengan mudah dan efisien.</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-full">Mulai Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card text-center rounded-3 border border-gray-300 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold">Manajemen Keuangan</h5>
                        <p class="text-muted">Catat pemasukan, pengeluaran, dan kelola anggaran dengan lebih baik.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center rounded-3 border border-gray-300 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold">Investasi Pintar</h5>
                        <p class="text-muted">Lacak investasi dan pertumbuhan aset Anda dengan mudah.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center rounded-3 border border-gray-300 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold">Laporan Keuangan</h5>
                        <p class="text-muted">Dapatkan laporan keuangan terperinci untuk analisis mendalam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

