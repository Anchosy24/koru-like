@extends('layouts.dashboard')

@push('script')
<script>
$(function () {
    $('.table-contribution').DataTable({
        paging  : true,
        searching: true,
        info   : true,
        lengthMenu: [5, 10, 25, 50],
        language: { searchPlaceholder: "Search..." }
    });
});
</script>
@endpush

@section('content')
<div class="container my-5">

    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold text-primary mb-0">All Contributions</h2>
            <p class="text-muted">Funds, Designs, Code & Ideas submitted by users.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <span class="badge bg-light text-dark fs-6">Funds: <b>{{ $fund->count() }}</b></span>
            <span class="badge bg-light text-dark fs-6">Designs: <b>{{ $design->count() }}</b></span>
            <span class="badge bg-light text-dark fs-6">Code: <b>{{ $code->count() }}</b></span>
            <span class="badge bg-light text-dark fs-6">Ideas: <b>{{ $idea->count() }}</b></span>
        </div>
    </div>

    {{-- Funds --}}
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="bi bi-currency-dollar me-2"></i>Fund Projects</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-contribution">
                    <thead class="table-light">
                        <tr class="text-center text-nowrap">
                            <th class="text-center align-middle">#</th><th class="text-center align-middle">Title</th><th class="text-center align-middle">Description</th><th class="text-center align-middle">Amount</th><th class="text-center align-middle">Email</th><th class="text-center align-middle">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fund as $k => $f)
                        <tr class="text-center align-middle">
                            <td class="text-center align-middle">{{ $k+1 }}</td>
                            <td class="fw-semibold">{{ $f->title }}</td>
                            <td class="text-center align-middle"><span class="d-inline-block text-truncate" style="max-width:200px;">{{ $f->description }}</span></td>
                            <td class="text-success fw-bold">Rp {{ number_format($f->amount, 2, ',', '.') }}</td>
                            <td class="text-center align-middle">{{ $f->email }}</td>
                            <td class="text-center align-middle">{{ $f->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Designs --}}
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="bi bi-palette me-2"></i>Design Submissions</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-contribution">
                    <thead class="table-light">
                        <tr class="text-center text-nowrap">
                            <th class="text-center align-middle">#</th><th class="text-center align-middle">Title</th><th class="text-center align-middle">Description</th><th class="text-center align-middle">File</th><th class="text-center align-middle">Email</th><th class="text-center align-middle">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($design as $k => $d)
                        <tr class="text-center align-middle">
                            <td class="text-center align-middle">{{ $k+1 }}</td>
                            <td class="fw-semibold">{{ $d->title }}</td>
                            <td class="text-center align-middle"><span class="d-inline-block text-truncate" style="max-width:200px;">{{ $d->description }}</span></td>
                            <td class="text-center align-middle">
                                @if(!empty($d->file_path))
                                    <a href="{{ asset('design/' . $d->file_path) }}" class="btn btn-primary" target="_blank">File</a>
                                @else
                                    <p style="color: red;">File can't be found.</p>
                                @endif
                            </td>
                            <td class="text-center align-middle">{{ $d->email }}</td>
                            <td class="text-center align-middle">{{ $d->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Code --}}
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="bi bi-code-slash me-2"></i>Code Contributions</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-contribution">
                    <thead class="table-light">
                        <tr class="text-center text-nowrap">
                            <th class="text-center align-middle">#</th><th class="text-center align-middle">Title</th><th class="text-center align-middle">Description</th><th class="text-center align-middle">File</th><th class="text-center align-middle">Email</th><th class="text-center align-middle">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($code as $k => $c)
                        <tr class="text-center align-middle">
                            <td class="text-center align-middle">{{ $k+1 }}</td>
                            <td class="fw-semibold">{{ $c->title }}</td>
                            <td class="text-center align-middle"><span class="d-inline-block text-truncate" style="max-width:200px;">{{ $c->description }}</span></td>
                            <td class="text-center align-middle">
                                @if(!empty($c->file_path))
                                    <a href="{{ asset('code/' . $c->file_path) }}" class="btn btn-primary" target="_blank">File</a>
                                @else
                                    <p style="color: red;">File can't be found.</p>
                                @endif
                            </td>
                            <td class="text-center align-middle">{{ $c->email }}</td>
                            <td class="text-center align-middle">{{ $c->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Ideas --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="bi bi-lightbulb me-2"></i>Shared Ideas</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 table-contribution">
                    <thead class="table-light">
                        <tr class="text-center text-nowrap">
                            <th class="text-center align-middle">#</th><th class="text-center align-middle">Title</th><th class="text-center align-middle">Description</th><th class="text-center align-middle">Email</th><th class="text-center align-middle">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($idea as $k => $i)
                        <tr class="text-center align-middle">
                            <td class="text-center align-middle">{{ $k+1 }}</td>
                            <td class="fw-semibold">{{ $i->title }}</td>
                            <td class="text-center align-middle"><span class="d-inline-block text-truncate" style="max-width:250px;">{{ $i->description }}</span></td>
                            <td class="text-center align-middle">{{ $i->email }}</td>
                            <td class="text-center align-middle">{{ $i->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection