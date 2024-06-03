<x-guest-layout>
    <div class="login-page center">
        <div class="card">
            <div class="card-body">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <a href="/"><img src="{{ asset('assets/logo.png') }}" alt="SECODISA Brand"
                                    class="mx-auto"></a>
                        </div>
                        <div class="col-12 mb-2 d-flex justify-content-center">
                            <div class="card-title">Olvidé mi contraseña</div>
                        </div>
                        <div class="col-12">
                            <p class="login-box-msg">Sólo tienes que indicarnos tu dirección de correo electrónico y te
                                enviaremos un enlace para restablecer la contraseña que te permitirá elegir una nueva.
                            </p>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="nombre">Correo electrónico *</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    :value="old('email')" required autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Enviar enlace para restablecer
                                contraseña</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-guest-layout>
