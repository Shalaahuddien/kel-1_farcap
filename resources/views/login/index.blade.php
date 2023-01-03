@extends('layouts.main')

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div style="color: red" id="error"></div>
            <main class="form-signin w-100 m-auto">
                <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>
                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                    <label for="email">Email address</label>
                    @error('email')
                        <div class="invalid_feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    <label for="password" required>Password</label>
                </div>


                <button class="w-100 btn btn-lg btn-primary" id="submit" type="submit">Login</button>
            </main>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const emailInput = document.querySelector('#email');
            const passwordInput = document.querySelector('#password');

            document.querySelector('#submit').addEventListener('click', async () => {
                const fd = new FormData();

                fd.append('email', emailInput.value);
                fd.append('password', passwordInput.value);

                const loginRes = await $.ajax({
                    url: 'http://localhost:8000/api/auth/login',
                    type: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: (res) => {
                        localStorage.setItem('token', res.token);
                        window.location.href = 'http://localhost:8000/dashboard/aspiration?token=' + res.token;
                    },
                    error: (err) => {
                        $("#error").html('Email atau password salah');
                    }
                });
            })

        });
    </script>
@endsection
