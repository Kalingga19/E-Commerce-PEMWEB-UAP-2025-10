<!-- resources/views/partials/modals/topup.blade.php -->
<div class="modal fade" id="topupModal" tabindex="-1" aria-labelledby="topupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="topupModalLabel">
                    <i class="bi bi-wallet2"></i> Topup Saldo
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('wallet.topup.process') }}" method="POST">
                    @csrf
                    
                    <div class="alert alert-info mb-3">
                        <div class="d-flex">
                            <i class="bi bi-info-circle me-2"></i>
                            <div>
                                <small>Saldo saat ini: <strong>Rp {{ number_format(auth()->user()->balance) }}</strong></small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Jumlah Topup</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="amount" 
                                   id="topup-amount" min="10000" step="1000" 
                                   placeholder="Minimal Rp 10.000" required>
                        </div>
                        <small class="text-muted">Minimum topup: Rp 10.000</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Pilih Nominal Cepat</label>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-primary amount-btn" data-amount="10000">
                                Rp 10.000
                            </button>
                            <button type="button" class="btn btn-outline-primary amount-btn" data-amount="50000">
                                Rp 50.000
                            </button>
                            <button type="button" class="btn btn-outline-primary amount-btn" data-amount="100000">
                                Rp 100.000
                            </button>
                            <button type="button" class="btn btn-outline-primary amount-btn" data-amount="200000">
                                Rp 200.000
                            </button>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select class="form-select" name="payment_method" required>
                            <option value="" selected disabled>Pilih metode pembayaran</option>
                            <option value="va_bca">BCA Virtual Account</option>
                            <option value="va_bni">BNI Virtual Account</option>
                            <option value="va_mandiri">Mandiri Virtual Account</option>
                            <option value="va_bri">BRI Virtual Account</option>
                        </select>
                    </div>
                    
                    <div class="alert alert-warning">
                        <div class="d-flex">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <div>
                                <small>Virtual Account akan dibuat setelah Anda mengkonfirmasi. 
                                Silakan lakukan pembayaran dalam waktu 24 jam.</small>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-credit-card"></i> Buat Virtual Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>