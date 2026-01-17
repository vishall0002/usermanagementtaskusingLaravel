@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                <h4 class="mb-0">Users</h4>
                <div class="d-flex gap-2">
                    <select id="filter-trashed" class="form-select w-auto">
                        <option value="0">Active Users</option>
                        <option value="1">Trash Users</option>
                    </select>
                    <button type="button" class="btn btn-primary" id="btn-add-user">
                        Add New User
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <input type="text" id="search-user" class="form-control" placeholder="Search by name, email or mobile...">
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="user-table-body">
                            @include('users.partials.table_rows', ['users' => $users])
                        </tbody>
                    </table>
                </div>

                <div id="pagination-links" class="d-flex justify-content-end mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Container -->
<div id="modal-container"></div>
@endsection

@push('scripts')
<script src="{{ asset('js/user-management.js') }}"></script>
@endpush
