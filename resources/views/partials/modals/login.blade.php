<!-- resources/views/partials/modals/login.blade.php -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login ke Akun Anda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    
                    @if(session('login_error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('login_error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="loginEmail" name="email" value="{{ old('email') }}" 
                                   placeholder="email@example.com" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="loginPassword" name="password" placeholder="Masukkan password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="loginRole" class="form-label">Login sebagai</label>
                        <select class="form-select @error('role') is-invalid @enderror" 
                                id="loginRole" name="role" required>
                            <option value="" disabled selected>Pilih role</option>
                            <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member/Pelanggan</option>
                            <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Penjual</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                    
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </div>
                    
                    <div class="text-center">
                        <p class="mb-0">Belum punya akun? 
                            <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">
                                Daftar di sini
                            </a>
                        </p>
                        <p class="mt-2">
                            <a href="#" class="text-muted small">Lupa password?</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
