@extends('layouts.dashboard')

@push('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('#tableUser').dataTable();
	});
</script>
@endpush

@section('content')
<div class="container my-5">

    {{-- headline + counters --}}
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold text-primary mb-0">User Management</h2>
            <p class="text-muted">Quick overview of every account.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <span class="badge bg-light text-dark fs-6 me-2">
                Total: <span class="fw-bold">{{ $user->count() }}</span>
            </span>
            <span class="badge bg-success fs-6 me-2">
                Active: <span class="fw-bold">{{ $user->where('status','active')->count() }}</span>
            </span>
            <span class="badge bg-warning fs-6">
                Not Verified: <span class="fw-bold">{{ $user->where('status','verify')->count() }}</span>
            </span>
        </div>
    </div>

    {{-- card table --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-gradient bg-primary text-white">
            <h5 class="mb-0">User List</h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 text-center" id="tableUser">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($user as $key => $u)
                        <tr>
                            <td class="text-center align-middle">{{ $key + 1 }}</td>
                            <td class="fw-semibold">{{ $u->name }}</td>
                            <td class="text-center align-middle">{{ $u->email }}</td>

                            {{-- Active badge --}}
                            <td class="text-center align-middle">
                                @if($u->status == 'active')
                                    <span class="badge bg-success px-3">Active</span>
                                @else
                                    <span class="badge bg-secondary px-3">Inactive</span>
                                @endif
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
