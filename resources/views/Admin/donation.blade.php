@extends('layouts.dashboard')

@push('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('#tableDonation').dataTable();
	});

    function confirmStatus(event) {
            event.preventDefault(); // Prevent form submission

            Swal.fire({
                title: 'Confirmation!',
                text: "Is it true that the donation has been received?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Find the parent form of the clicked checkbox and submit it
                    const form = event.target.closest('form'); // Locate the closest form element
                    form.submit(); // Submit the form
                }
            });
        }
</script>
@endpush

@section('content')
<div class="container my-5">

    {{-- headline + stats --}}
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold text-primary mb-0">Donation History</h2>
            <p class="text-muted">Manage and confirm every donation in one place.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <span class="badge bg-light text-dark fs-6 me-2">
                Total: <span class="fw-bold">{{ $donation->count() }}</span>
            </span>
            <span class="badge bg-warning text-dark fs-6 me-2">
                Pending: <span class="fw-bold">{{ $donation->where('status','pending')->count() }}</span>
            </span>
            <span class="badge bg-success fs-6">
                Done: <span class="fw-bold">{{ $donation->where('status','done')->count() }}</span>
            </span>
        </div>
    </div>

    {{-- card table --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient bg-primary text-white">
            <h5 class="mb-0">Donation List</h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0" id="tableDonation">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Donator</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Confirm</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($donation as $key => $row)
                        <tr>
                            <td class="text-center align-middle">{{ $key + 1 }}</td>
                            <td class="fw-semibold text-center align-middle">{{ $row->name }}</td>
                            <td class="text-center align-middle">{{ optional($row->type)->project ?? '-' }}</td>
                            <td class="fw-bold text-success text-center align-middle">
                                ${{ number_format($row->amount, 2, '.', ',') }}
                            </td>
                            <td class="text-center align-middle">
                                @if($row->status == 'pending')
                                    <span class="badge bg-secondary">Pending</span>
                                @else
                                    <span class="badge bg-success shadow-success px-3">Done</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <form action="{{ route('donation.confirm', $row->id) }}" method="POST">
                                    @csrf
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               role="switch"
                                               style="cursor:pointer;transform:scale(1.3)"
                                               @if($row->status == 'done') disabled checked
                                               @else onclick="confirmStatus(event)"
                                               @endif >
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
