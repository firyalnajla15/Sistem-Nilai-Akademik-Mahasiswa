@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="card border-0 shadow-sm rounded-3"
         style="background:#f8f9fb; max-width:800px;">

        <div class="card-body p-4">

            <div class="text-center mb-4">

                <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center"
                     style="width:100px;height:100px;background:#1f2a44;color:white;font-size:40px;">
                    <i class="fa-solid fa-user"></i>
                </div>

                <h3 class="mt-3 fw-semibold text-dark">
                    {{ auth()->user()->name }}
                </h3>

                <p class="text-muted">
                    Administrator Sistem Akademik
                </p>

            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-3 fw-semibold text-muted">
                    ID Pengguna
                </div>
                <div class="col-md-9">
                    {{ auth()->id() }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-semibold text-muted">
                    Nama
                </div>
                <div class="col-md-9">
                    {{ auth()->user()->name }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 fw-semibold text-muted">
                    Email
                </div>
                <div class="col-md-9">
                    {{ auth()->user()->email }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 fw-semibold text-muted">
                    Role
                </div>
                <div class="col-md-9">
                    <span class="badge px-3 py-2"
                          style="background:#1f2a44;">
                        Admin
                    </span>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection