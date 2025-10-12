<!-- Donate Modal -->
<div class="modal fade" id="donate{{ $row->id }}" tabindex="-1" aria-labelledby="donateLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #0f172a; color: #fff; border: none; border-radius: 10px;">
      <div class="modal-body text-center py-5">
        <h4 class="fw-bold mb-2">Donate USDT on TRON</h4>
        <p class="text-secondary mb-4" style="font-size: 0.95rem;">{{ $row->project }}</p>

        <form method="POST" action="{{ route('donation.store', $row->id) }}">
          @csrf
          <div class="mb-3 text-start">
            <label for="amount{{ $row->id }}" class="form-label text-white-50">Donation Amount (USDT)*</label>
            <input type="number" step="0.01" class="form-control dark-input" id="amount{{ $row->id }}" name="amount" placeholder="0.00" required>
          </div>

          <div class="mb-3 text-start">
            <label for="name{{ $row->id }}" class="form-label text-white-50">Your name *</label>
            <input type="text" class="form-control dark-input" id="name{{ $row->id }}" name="name" placeholder="Enter your name" required>
          </div>

          <div class="mb-3 text-start">
            <label for="email{{ $row->id }}" class="form-label text-white-50">Contact Email *</label>
            <input type="email" class="form-control dark-input" id="email{{ $row->id }}" name="email" placeholder="your.email@example.com" required>
          </div>

          <div class="mb-3 text-start">
            <label for="message{{ $row->id }}" class="form-label text-white-50">Message (Optional)</label>
            <textarea id="message{{ $row->id }}" name="message" class="form-control dark-input" rows="3" placeholder="Leave a message for the project team..."></textarea>
          </div>

          <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal" style="width: 48%;">Back</button>
            <button type="submit" class="btn" style="width: 48%; background: linear-gradient(to right, #97fb24ff, #16f93cff); color: #fff; border: none;">Submit Donation</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Confirm Payment Modal - TRON USDT -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #0f172a; color: #fff; border: none; border-radius: 10px;">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold" id="confirmLabel">
          <i class="fab fa-ethereum me-2" style="color: #51c4d1;"></i>Confirm Your Donation
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body text-center py-4">
        <p class="text-secondary mb-4" style="font-size: 0.95rem;">Your contribution helps us make a difference ❤️</p>

        <div class="alert mb-3" style="background-color: #1e293b; border: 1px solid #51c4d1; border-radius: 8px;">
          <p class="mb-2 text-secondary small">Donation Amount</p>
          <h3 class="fw-bold mb-0" style="color: #51c4d1;" id="displayAmount">0.00 USDT</h3>
        </div>

        <h5 class="fw-bold mb-3 mt-4">Send USDT to this TRON Wallet:</h5>
        <div class="alert mb-3" style="background-color: #1e293b; border: 1px solid #51c4d1; border-radius: 8px;">
          <p class="mb-2 text-secondary small">Wallet Address</p>
          <p class="mb-2 fw-bold text-break" style="color: #51c4d1; font-size: 0.85rem;">
            TVU4bo6USqcNc7Ln9gLQCCQYvfRX7osnTq
          </p>
          <small class="text-secondary d-block">⚠️ Only send USDT (TRC-20) to this address</small>
        </div>

        <h5 class="fw-bold mb-3">Scan QR Code:</h5>
        <div class="mb-4">
          <img id="qrCodeImg" src="" alt="TRON Wallet QR Code" class="img-fluid" 
               style="max-width: 250px; border: 3px solid #51c4d1; border-radius: 10px; padding: 10px; background: #fff;">
        </div>

        <div class="alert mb-4" style="background-color: #1e293b; border: 1px solid #fbbf24; border-radius: 8px; color: #fbbf24; text-align: left;">
          <small class="d-block mb-2">
            <i class="fas fa-info-circle me-2"></i><strong>Steps:</strong>
          </small>
          <small class="d-block">1. Open your TRON wallet (TronLink, TrustWallet, etc.)</small>
          <small class="d-block">2. Select USDT (TRC-20)</small>
          <small class="d-block">3. Send to the wallet address above</small>
          <small class="d-block">4. Copy the transaction hash</small>
          <small class="d-block">5. Paste hash below and verify</small>
        </div>

        <div class="mb-3">
          <label for="txHash" class="form-label text-white-50 text-start d-block">Transaction Hash (After sending)</label>
          <input type="text" class="form-control dark-input" id="txHash" placeholder="Paste your transaction hash here" 
                 style="font-size: 0.85rem;">
          <small class="text-secondary d-block mt-2">Find your hash on <a href="https://nileex.io" target="_blank" 
                                                                         style="color: #51c4d1; text-decoration: none;">Nile Tronscan</a></small>
        </div>

        <div class="d-flex justify-content-between mt-4 gap-2">
          <button type="button" id="btnBack" class="btn btn-outline-light" style="flex: 1;" data-bs-dismiss="modal">Back</button>
          <button type="button" id="btnVerify" class="btn" style="flex: 1; background: linear-gradient(to right, #97fb24ff, #16f93cff); color: #fff; border: none;">
            <i class="fas fa-check me-2"></i>Verify
          </button>
        </div>

        <button type="button" id="btnCopyAddress" class="btn btn-sm btn-secondary mt-3 w-100">
          <i class="fas fa-copy me-2"></i>Copy Wallet Address
        </button>
      </div>
    </div>
  </div>
</div>

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const walletAddress = "TVU4bo6USqcNc7Ln9gLQCCQYvfRX7osnTq";
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';
    let isVerifying = false;
    let alertShown = false; // Prevent multiple alerts

    function generateQRCode(data) {
        return "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" + encodeURIComponent(data);
    }

    const qrCodeImg = document.getElementById('qrCodeImg');
    if (qrCodeImg) {
        qrCodeImg.src = generateQRCode(walletAddress);
    }

    @if(session('confirmDonationId'))
        const donationId = "{{ session('confirmDonationId') }}";
        const donationAmount = "{{ session('donationAmount') }}";
        
        if (document.getElementById('displayAmount')) {
            document.getElementById('displayAmount').textContent = donationAmount + ' USDT';
        }
        
        setTimeout(function() {
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            confirmModal.show();
        }, 500);
    @endif

    const copyBtn = document.getElementById('btnCopyAddress');
    if (copyBtn) {
        copyBtn.addEventListener('click', function() {
            navigator.clipboard.writeText(walletAddress).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'Wallet address copied to clipboard',
                    theme: 'dark',
                    timer: 2000,
                    showConfirmButton: false,
                });
            }).catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to copy address',
                    theme: 'dark',
                });
            });
        });
    }

    const verifyBtn = document.getElementById('btnVerify');
    if (verifyBtn) {
        verifyBtn.addEventListener('click', async function() {
            // Prevent multiple clicks and alerts
            if (isVerifying || alertShown) {
                return;
            }

            const txHash = document.getElementById('txHash').value.trim();
            const donationId = "{{ session('confirmDonationId') }}";

            if (!txHash) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please enter your transaction hash',
                    theme: 'dark',
                });
                return;
            }

            if (!donationId) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Donation ID not found',
                    theme: 'dark',
                });
                return;
            }

            // Set verifying state
            isVerifying = true;
            alertShown = true;
            const originalText = verifyBtn.innerHTML;
            verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Verifying...';
            verifyBtn.disabled = true;

            try {
                const response = await fetch(`/donation/verify/${donationId}/${txHash}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Close modal
                    const modalElement = document.getElementById('confirmModal');
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    if (modal) {
                        modal.hide();
                    }

                    // Show single success alert
                    await Swal.fire({
                        icon: 'success',
                        title: 'Donation Confirmed!',
                        html: 'Your donation has been verified successfully.<br><strong>A confirmation email has been sent to your email address.</strong>',
                        theme: 'dark',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false,
                    });

                    // Redirect after alert closes
                    window.location.href = '/home';
                } else {
                    // Show single error alert
                    await Swal.fire({
                        icon: 'error',
                        title: 'Verification Failed',
                        text: data.message || 'Could not verify transaction. Please check the hash and try again.',
                        theme: 'dark',
                    });

                    // Reset button
                    verifyBtn.innerHTML = originalText;
                    verifyBtn.disabled = false;
                    isVerifying = false;
                    alertShown = false;
                }
            } catch (error) {
                console.error('Error:', error);
                await Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while verifying the transaction. Please try again.',
                    theme: 'dark',
                });

                // Reset button
                verifyBtn.innerHTML = originalText;
                verifyBtn.disabled = false;
                isVerifying = false;
                alertShown = false;
            }
        });
    }
});
</script>
@endpush