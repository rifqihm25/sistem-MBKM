<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Register</title>
</head>

<body>
    <div class="row justify-content-center" style="margin-top: 150px">
        <div class="col-lg-6">
            <main class="form-registration">
                <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-floating m-1">
                            <input type="text"
                                class="form-control rounded-top @error('name')
                                is-invalid
                            @enderror"
                                name="name" id="name" required value="{{ old('name') }}" placeholder="Name">
                            <label for="name">Name</label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating m-1">
                            <input type="email"
                                class="form-control @error('email')
                                is-invalid
                            @enderror"
                                name="email" id="email" required value="{{ old('email') }}"
                                placeholder="name@example.com">
                            <label for="email">Email address</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating m-1">
                            <input type="password"
                                class="form-control rounded-bottom @error('password')
                                is-invalid
                            @enderror"
                                name="password" id="password" required placeholder="Password">
                            <label for="password">Confirmed Password</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating m-1">
                            <input type="password"
                                class="form-control rounded-bottom @error('password')
                                is-invalid
                            @enderror"
                                name="password_confirmation" id="password-confirm" required
                                placeholder="Confirmed Password" required autocomplete="new-password">
                            <label for="password-confirm">Password</label>
                        </div>
                    </div>

                    <button class="w-100 btn btn-lg btn-danger mt-3" type="submit">Register</button>
                </form>
                <small class="d-block mt-3">Have an account? <a class="text-danger" href="/login"> Login
                        Here</a></small>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
