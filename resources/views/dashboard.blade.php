@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">Total Transactions</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalTransactions }}</h5>
                                    <p class="card-text">Total transactions that have been made.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-header">Total Income</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ number_format($totalIncome, 2) }}</h5>
                                    <p class="card-text">Total income that has been made.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-header">Total Expense</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ number_format($totalExpense, 2) }}</h5>
                                    <p class="card-text">Total expense that has been made.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
