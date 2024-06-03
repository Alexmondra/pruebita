<x-guest-layout>
    <div class="login-page d-flex justify-content-center align-items-center vh-100" style="background-color: #333;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-body">
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="text-center mb-3">
                                    <a href="/">
                                        <img src="{{ asset('assets/logo.png') }}" alt="SECODISA Brand" class="img-fluid" style="max-width: 150px;">
                                    </a>
                                </div>
                                <div class="text-center mb-3">
                                    <h2 class="card-title">Iniciar sesión</h2>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <input placeholder="email"  type="email" id="email" name="email" class="form-control" :value="old('email')" required autofocus />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="form-group mb-3">
                                    <input placeholder="password"  type="password" name="password" id="password" class="form-control" required autocomplete="current-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-block">Acceder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
