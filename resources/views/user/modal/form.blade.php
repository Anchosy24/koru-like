<!-- Share Ideas Modal -->
<div class="modal fade" id="shareIdeas" tabindex="-1" aria-labelledby="shareIdeasLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #0f172a; color: #fff; border: none; border-radius: 10px;">
      <div class="modal-body text-center py-5">
        
        <!-- Icon -->
        <div class="mb-3">
          <div style="background-color: #fbbf24; width: 60px; height: 60px; border-radius: 15px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-lightbulb-fill" style="font-size: 30px; color: #fff;"></i>
          </div>
        </div>

        <!-- Title -->
        <h4 class="fw-bold mb-2">Share Ideas</h4>
        <p class="text-secondary mb-4" style="font-size: 0.95rem;">Contribute innovative concepts and solutions</p>

        <!-- Form -->
        <form method="POST" action="{{ route('idea.store') }}">
          @csrf
          <div class="mb-3 text-start">
            <label for="title" class="form-label text-white-50">Title *</label>
            <input type="text" class="form-control dark-input" id="title" name="title" placeholder="Give your contribution a clear title" required>
          </div>

          <div class="mb-3 text-start">
            <label for="description" class="form-label text-white-50">Description *</label>
            <textarea id="description" name="description" class="form-control dark-input" rows="5" placeholder="Describe your contribution in detail" required></textarea>
          </div>

          <div class="mb-3 text-start">
            <label for="email" class="form-label text-white-50">Contact Email *</label>
            <input type="email" class="form-control dark-input" id="email" name="email" placeholder="your.email@example.com" required>
          </div>

          <!-- Buttons -->
          <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal" style="width: 48%;">Back</button>
            <button type="submit" class="btn" style="width: 48%; background: linear-gradient(to right, #fbbf24, #f97316); color: #fff; border: none;">Submit Contribution</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Fund Project Modal -->
<div class="modal fade" id="fundProject" tabindex="-1" aria-labelledby="fundProjectLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #0f172a; color: #fff; border: none; border-radius: 10px;">
      <div class="modal-body text-center py-5">
        
        <!-- Icon -->
        <div class="mb-3">
          <div style="background-color: #0c9400ff; width: 60px; height: 60px; border-radius: 15px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-currency-dollar" style="font-size: 30px; color: #fff;"></i>
          </div>
        </div>

        <!-- Title -->
        <h4 class="fw-bold mb-2">Fund Projects</h4>
        <p class="text-secondary mb-4" style="font-size: 0.95rem;">Support amazing projects with financial backing</p>

        <!-- Form -->
        <form method="POST" action="{{ route('fund.store') }}">
          @csrf
          <div class="mb-3 text-start">
            <label for="title" class="form-label text-white-50">Title*</label>
            <input type="text" class="form-control dark-input" id="title" name="title" placeholder="Give your contribution a clear title" required>
          </div>

          <div class="mb-3 text-start">
            <label for="description" class="form-label text-white-50">Description*</label>
            <textarea id="description" name="description" class="form-control dark-input" rows="5" placeholder="Describe your contribution in detail" required></textarea>
          </div>

          <div class="mb-3 text-start">
            <label for="amount" class="form-label text-white-50">Amount ($)*</label>
            <input type="number" class="form-control dark-input" id="amount" name="amount" placeholder="0" required>
          </div>

          <div class="mb-3 text-start">
            <label for="email" class="form-label text-white-50">Contact Email*</label>
            <input type="email" class="form-control dark-input" id="email" name="email" placeholder="your.email@example.com" required>
          </div>

          <!-- Buttons -->
          <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal" style="width: 48%;">Back</button>
            <button type="submit" class="btn" style="width: 48%; background: linear-gradient(to right, #9efb24ff, #16f97cff); color: #fff; border: none;">Submit Contribution</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Submit Design Modal -->
<div class="modal fade" id="submitDesign" tabindex="-1" aria-labelledby="submitDesignLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #0f172a; color: #fff; border: none; border-radius: 10px;">
      <div class="modal-body text-center py-5">
        
        <!-- Icon -->
        <div class="mb-3">
          <div style="background-color: #b911cfff; width: 60px; height: 60px; border-radius: 15px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-palette" style="font-size: 30px; color: #fff;"></i>
          </div>
        </div>

        <!-- Title -->
        <h4 class="fw-bold mb-2">Submit Designs</h4>
        <p class="text-secondary mb-4" style="font-size: 0.95rem;">Share visual concepts, mockups, and creative assets</p>

        <!-- Form -->
        <form method="POST" action="{{ route('design.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="mb-3 text-start">
            <label for="title" class="form-label text-white-50">Title*</label>
            <input type="text" class="form-control dark-input" id="title" name="title" placeholder="Give your contribution a clear title" required>
          </div>

          <div class="mb-3 text-start">
            <label for="description" class="form-label text-white-50">Description*</label>
            <textarea id="description" name="description" class="form-control dark-input" rows="5" placeholder="Describe your contribution in detail" required></textarea>
          </div>

          <div class="mb-3 text-start">
            <label for="file_path" class="form-label text-white-50">Attach File</label>
            <input type="file" accept="image/*, .pdf" class="form-control dark-input" id="file_path" name="file_path" placeholder="Attach File">
          </div>

          <div class="mb-3 text-start">
            <label for="email" class="form-label text-white-50">Contact Email*</label>
            <input type="email" class="form-control dark-input" id="email" name="email" placeholder="your.email@example.com" required>
          </div>

          <!-- Buttons -->
          <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal" style="width: 48%;">Back</button>
            <button type="submit" class="btn" style="width: 48%; background: linear-gradient(to right, #ff61d7ff, #ec30fdff); color: #fff; border: none;">Submit Contribution</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Code Contribution Modal -->
<div class="modal fade" id="codeContribute" tabindex="-1" aria-labelledby="codeContributeLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background-color: #0f172a; color: #fff; border: none; border-radius: 10px;">
      <div class="modal-body text-center py-5">
        
        <!-- Icon -->
        <div class="mb-3">
          <div style="background-color: #1199cfff; width: 60px; height: 60px; border-radius: 15px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-code-slash" style="font-size: 30px; color: #fff;"></i>
          </div>
        </div>

        <!-- Title -->
        <h4 class="fw-bold mb-2">Code Contributions</h4>
        <p class="text-secondary mb-4" style="font-size: 0.95rem;">Help build with technical implementations</p>

        <!-- Form -->
        <form method="POST" action="{{ route('code.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="mb-3 text-start">
            <label for="title" class="form-label text-white-50">Title*</label>
            <input type="text" class="form-control dark-input" id="title" name="title" placeholder="Give your contribution a clear title" required>
          </div>

          <div class="mb-3 text-start">
            <label for="description" class="form-label text-white-50">Description*</label>
            <textarea id="description" name="description" class="form-control dark-input" rows="5" placeholder="Describe your contribution in detail" required></textarea>
          </div>

          <div class="mb-3 text-start">
            <label for="file_path" class="form-label text-white-50">Attach File</label>
            <input type="file" class="form-control dark-input" id="file_path" name="file_path" placeholder="Attach File">
          </div>

          <div class="mb-3 text-start">
            <label for="email" class="form-label text-white-50">Contact Email*</label>
            <input type="email" class="form-control dark-input" id="email" name="email" placeholder="your.email@example.com" required>
          </div>

          <!-- Buttons -->
          <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal" style="width: 48%;">Back</button>
            <button type="submit" class="btn" style="width: 48%; background: linear-gradient(to right, #61dfffff, #3067fdff); color: #fff; border: none;">Submit Contribution</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>