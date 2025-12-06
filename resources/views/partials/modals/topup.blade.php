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

                    {{-- SALDO SAAT INI --}}
                    <div class="alert alert-info mb-3">
                        <div class="d-flex">
                            <i class="bi bi-info-circle me-2"></i>
                            <div>
                                <small>
                                    Saldo saat ini:
                                    <strong>
                                        Rp {{ number_format(auth()->user()->balance->balance ?? 0) }}
                                    </strong>
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- INPUT JUMLAH TOPUP --}}
                    <div class="mb-3">
                        <label class="form-label">Jumlah Topup</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input 
                                type="number" 
                                class="form-control" 
                                name="amount" 
                                id="topup-amount"
                                min="10000" 
                                step="1000"
                                placeholder="Minimal Rp 10.000"
                                required
                            >
                        </div>
                        <small class="text-muted">Minimum topup: Rp 10.000</small>
                    </div>

                    {{-- PILIH NOMINAL CEPAT --}}
                    <div class="mb-3">
                        <label class="form-label">Pilih Nominal Cepat</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach([10000, 50000, 100000, 200000] as $nominal)
                                <button type="button" 
                                        class="btn btn-outline-primary amount-btn" 
                                        data-amount="{{ $nominal }}">
                                    Rp {{ number_format($nominal) }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- CATATAN --}}
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <small>
                            Setelah Anda klik "Buat Virtual Account", sistem akan membuat VA topup.
                            Silakan lakukan pembayaran di halaman Pembayaran.
                        </small>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-credit-card"></i> Buat Virtual Account Topup
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.amount-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('topup-amount').value = btn.dataset.amount;
    });
});
</script>
