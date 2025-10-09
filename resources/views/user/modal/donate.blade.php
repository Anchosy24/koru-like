<!-- Donate Modal -->
<div class="modal fade" id="donate{{ $row->id }}" tabindex="-1" aria-labelledby="donateLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #0f172a; color: #fff; border: none; border-radius: 10px;">
      <div class="modal-body text-center py-5">

        <!-- Title -->
        <h4 class="fw-bold mb-2">Donate USDT</h4>
        <p class="text-secondary mb-4" style="font-size: 0.95rem;">{{ $row->project}}</p>

        <!-- Form -->
        <form method="POST" action="{{ route('donation.store', $row->id) }}">
          @csrf
          <div class="mb-3 text-start">
            <label for="amount" class="form-label text-white-50">Donation Amount (USDT)*</label>
            <input type="number" step="0.01" class="form-control dark-input" id="amount" name="amount" placeholder="0.00" required>
          </div>

          <div class="mb-3 text-start">
            <label for="name" class="form-label text-white-50">Your name *</label>
            <input type="text" class="form-control dark-input" id="name" name="name" placeholder="Enter your name" required>
          </div>

          <div class="mb-3 text-start">
            <label for="email" class="form-label text-white-50">Contact Email *</label>
            <input type="email" class="form-control dark-input" id="email" name="email" placeholder="your.email@example.com" required>
          </div>

          <div class="mb-3 text-start">
            <label for="message" class="form-label text-white-50">Message (Optional)</label>
            <textarea id="message" name="message" class="form-control dark-input" rows="5" placeholder="Leave a message for the project team..."></textarea>
          </div>

          <!-- Buttons -->
          <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal" style="width: 48%;">Back</button>
            <button type="submit" class="btn" style="width: 48%; background: linear-gradient(to right, #97fb24ff, #16f93cff); color: #fff; border: none;">Submit Donation</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Confirm Payment Modal -->
<!-- <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #0f172a; color: #fff; border: none; border-radius: 10px;">
      <div class="modal-body text-center py-5">
        <h4 class="fw-bold mb-2">Confirm Your Donation</h4>
        <p class="text-secondary mb-4" style="font-size: 0.95rem;">Your contribution helps us make a difference ❤️</p>

        <h4 class="fw-bold mb-2">Scan to Pay with PayPal</h4>
        <p class="text-secondary mb-4">Amount: <strong>${{ number_format($donation->amount ?? 0, 2) }} USD</strong></p>

        QR Code
        <img src="{{ session('paypalQRUrl') }}" alt="PayPal QR Code" class="img-fluid mb-3" style="max-width: 250px;">

        <p class="text-secondary mb-4" style="font-size: 0.9rem;">After payment, we’ll confirm automatically.</p>

        <form id="confirmForm" method="POST">
          @csrf
          @method('PUT')
          <div class="d-flex justify-content-between mt-4">
            <button type="button" id="btnBack" class="btn btn-outline-light" style="width: 48%;">Back</button>
            <button type="submit" class="btn" style="width: 48%; background: linear-gradient(to right, #97fb24ff, #16f93cff); color: #fff; border: none;">
              Confirm Payment
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> -->

<!-- Confirm Payment Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #0f172a; color: #fff; border: none; border-radius: 10px;">
      <div class="modal-body text-center py-5">
        <h4 class="fw-bold mb-2">Confirm Your Donation</h4>
        <p class="text-secondary mb-4" style="font-size: 0.95rem;">Your contribution helps us make a difference ❤️</p>

        <h4 class="fw-bold mb-2">Scan to Pay with PayPal</h4>
        <p class="text-secondary mb-4">Amount: <strong>${{ number_format(session('donationAmount', 0), 2) }} USD</strong></p>

        <!-- QR Code -->
        <div class="mb-4">
          <img src="{{ session('paypalQRUrl') }}" alt="PayPal QR Code" class="img-fluid" style="max-width: 250px; border: 3px solid #fff; border-radius: 10px;">
        </div>

        <div class="alert alert-info mb-4" style="background-color: #1e293b; border: none; color: #fff;">
          <small>
            <i class="fas fa-info-circle me-2"></i>
            Scan the QR code with your phone to complete the payment via PayPal
          </small>
        </div>

        <p class="text-secondary mb-4" style="font-size: 0.9rem;">After payment, click "Confirm Payment" to complete your donation.</p>

        <form id="confirmForm" method="POST">
          @csrf
          @method('PUT')
          <div class="d-flex justify-content-between mt-4">
            <button type="button" id="btnBack" class="btn btn-outline-light" style="width: 48%;" data-bs-dismiss="modal">Back</button>
            <button type="submit" class="btn" style="width: 48%; background: linear-gradient(to right, #97fb24ff, #16f93cff); color: #fff; border: none;">
              Confirm Payment
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('script')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Auto-refresh QR code if needed
    const qrImg = document.querySelector('#confirmModal img[alt="PayPal QR Code"]');
    if (qrImg) {
      // Add timestamp to prevent caching issues
      const timestamp = new Date().getTime();
      qrImg.src = qrImg.src + '&t=' + timestamp;
    }
  });
</script>
@endpush