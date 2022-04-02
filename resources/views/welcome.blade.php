<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel - LikeU API</title>

    <!-- Font-Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="app-container">
        <div class="center mt-5">
            <div class="card m-5">
                <div class="card body">
                    <div class="text-center">
                        <img src="https://laravel.com/img/logomark.min.svg" width="200" />
                    </div>
                    <h2 class="mt-3">LikeU API Basic CRUD with Authentication</h2>
                    <div class="text-center">
                        <span class="badge badge-info">Laravel 9</span>
                    </div>
                    <hr>
                    <p>API Documentation for Basic Laravel CRUD with Client and Appointments CRUD and User Authentication</p>
                    <div class="card card-body m-2">
                        <div class="row">
                            <div class="col-5">
                                <h4>Authentication Module</h4>
                            </div>
                            <div class="col-7">
                                <ul class="feature-list">
                                    <li>Login API with Token</li>
                                    <li>Authenticated User Profile</li>
                                    <li>Refresh Data</li>
                                    <li>Logout</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card card-body m-2">
                        <div class="row">
                            <div class="col-5">
                                <h4>Client Module</h4>
                            </div>
                            <div class="col-7">
                                <ul class="feature-list">
                                    <li>Client List</li>
                                    <li>Client List [Public]</li>
                                    <li>Create Client</li>
                                    <li>Edit Client</li>
                                    <li>View Client</li>
                                    <li>Delete Client</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card card-body m-2">
                        <div class="row">
                            <div class="col-5">
                                <h4>Appointment Module</h4>
                            </div>
                            <div class="col-7">
                                <ul class="feature-list">
                                    <li>Appointment List</li>
                                    <li>Create Appointment</li>
                                    <li>Edit Appointment</li>
                                    <li>View Appointment</li>
                                    <li>Delete Appointment</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <p class="text-center">
                        <a href="{{ route('l5-swagger.default.api') }}" class="btn btn-primary">
                            <i class="fa fa-book"></i> Read API Documentation
                        </a>
                        <a href="https://github.com/itdyaingenieria/apiagenda.git" target="_blank"
                            class="btn btn-info">
                            <i class="fab fa-github"></i> View in Github
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
