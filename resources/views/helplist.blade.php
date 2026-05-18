
@extends('layouts.mainlayout')

@section('content')

<div class="page-heading">

    <div class="page-title">

        <div class="row">

            <div class="col-12 col-md-6 order-md-1 order-last">

                <h3>Create Help</h3>

            </div>

            <div class="col-12 col-md-6 order-md-2 order-first">

                <nav
                    aria-label="breadcrumb"
                    class="breadcrumb-header float-start float-lg-end">

                    <ol class="breadcrumb">

                        <li class="breadcrumb-item">
                            <a href="index.html">
                                Dashboard
                            </a>
                        </li>

                        <li
                            class="breadcrumb-item active"
                            aria-current="page">

                            Help

                        </li>

                    </ol>

                </nav>

            </div>

        </div>

    </div>

    <section class="section">


        <div class="card">

            @if(session('success'))

                <div
                    class="alert alert-success alert-dismissible"
                    role="alert">

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                    </button>

                </div>

            @endif

            @if ($errors->any())

                <div class="alert alert-warning">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

        </div>

        <div class="card-body">

            <table class="table table-striped" id="table1">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Customer</th>

                        <th>Request</th>

                        <th>Answer</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($helps as $bk)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $bk->phone_number }}
                        </td>

                        <td>
                            {{ $bk->request }}
                        </td>

                        <td>
                            {{ $bk->answer }}
                        </td>

                        <td>

                            <button
                                type="button"
                                class="btn btn-sm btn-primary edithelp"

                                data-id="{{ $bk->id }}"
                                data-cus-id="{{ $bk->cus_id }}"
                                data-request="{{ $bk->request }}"
                                data-answer="{{ $bk->answer }}">

                                Edit

                            </button>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

            {{-- Edit Help Modal --}}
            <div
                class="modal fade"
                id="edithelpmodal"
                tabindex="-1"
                aria-hidden="true">

                <div
                    class="modal-dialog modal-lg modal-dialog-centered">

                    <div class="modal-content">

                        <form
                            method="POST"
                            action="{{ url('helpedit') }}"
                            name="helpeditform">

                            @csrf

                            <div class="modal-header">

                                <h5 class="modal-title">
                                    Edit Help
                                </h5>

                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close">
                                </button>

                            </div>

                            <div class="modal-body">

                                <input
                                    type="hidden"
                                    name="id"
                                    id="helpid"
                                    value="">

                                <div class="row">

                                    <div class="col-md-12 mb-3">

                                        <label class="form-label">
                                            Select Customer
                                        </label>

                                        <select
                                            name="cus_id"
                                            id="help_cus_id"
                                            class="form-control"
                                            required>

                                            <option value="">
                                                Select Customer
                                            </option>

                                            @foreach($customers as $customer)

                                                <option
                                                    value="{{ $customer->id }}">

                                                    {{ $customer->phone_number }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="col-md-12 mb-3">

                                        <label class="form-label">
                                            Request
                                        </label>

                                        <textarea
                                            name="request"
                                            id="help_request"
                                            class="form-control"
                                            rows="4"></textarea>

                                    </div>

                                    <div class="col-md-12 mb-3">

                                        <label class="form-label">
                                            Answer
                                        </label>

                                        <textarea
                                            name="answer"
                                            id="help_answer"
                                            class="form-control"
                                            rows="4"></textarea>

                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">

                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">

                                    Close

                                </button>

                                <button
                                    type="submit"
                                    class="btn btn-primary">

                                    Save Changes

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<script>

document.addEventListener('DOMContentLoaded', function() {

    document.querySelectorAll('.edithelp').forEach(function(button) {

        button.addEventListener('click', function() {

            document.getElementById('helpid').value =
                this.dataset.id;

            document.getElementById('help_cus_id').value =
                this.dataset.cusId;

            document.getElementById('help_request').value =
                this.dataset.request;

            document.getElementById('help_answer').value =
                this.dataset.answer;

            var modal = new bootstrap.Modal(
                document.getElementById('edithelpmodal')
            );

            modal.show();

        });

    });

});

</script>

@endsection