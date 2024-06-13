<!-- resources/views/components/select-and-table.blade.php -->
<script>
    const userRole = "{{ auth()->user()->getRoleNames()->first() }}";
    const urlBase = "{{ $baseUrl }}"; 
</script>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>
        <p class="card-description">{{ $description }}</p>
        <div class="home-tab">
            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                @if (auth()->user()->getRoleNames()->first() != "admin")
                @if ($baseUrl != "lapsit")
                <div class="dropdown">
                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih status
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                        <a class="dropdown-item" href="#" data-status="">All</a>
                        @foreach ($statuses as $status)
                            <a class="dropdown-item" href="#" data-status="{{ $status }}">{{ $status }}</a>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="btn-wrapper ms-auto">
                    <a href="{{ $createRoute }}" class="btn btn-primary text-white me-0">
                        <i class="icon-download"></i> Tambah Data
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div>
            <div class="table-responsive pt-3">
                <table class="table table-bordered" id="data-table">
                    <thead>
                        <tr>
                            @foreach ($tableHeaders as $header)
                                <th>{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table data will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Bootstrap JS for table styling (optional) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- Custom JS -->
<script src="{{ asset('assets/js/select-and-table.js') }}"></script>