@extends('layouts.mainlayout') @section('content') <div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Create Customer</h3>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Customers</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card-header d-flex justify-content-end py-2">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal"> Create Customer </button>
    </div>
    <div class="card"> @if(session('success')) <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> @endif @if ($errors->any()) <div class="alert alert-warning">
        <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
      </div> @endif </div>
    <div class="card-body">
      <table class="table table-striped" id="table1">
        <thead>
          <tr>
            <th>#</th>
            <th>Phone Number</th>
            <th>OTP</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody> @foreach($customers as $bk) <tr>
            <td>{{ $loop->iteration }}</td>
            {{-- Phone Number --}}
            <td>
              {{ $bk->phone_number }}
            </td>
            {{-- OTP --}}
            <td>
              {{ $bk->otp ?? 'N/A' }}
            </td>
            {{-- Image --}}
            <td> @if($bk->image) <img src="{{ asset('uploads/customers/' . $bk->image) }}" width="100" class="rounded"> @else No Image @endif </td>
            {{-- Action --}}
            <td>
              <button type="button" class="btn btn-sm btn-primary editcustomer" data-id="{{ $bk->id }}" data-phone="{{ $bk->phone_number }}" data-otp="{{ $bk->otp }}" data-image="{{ asset('uploads/customers/' . $bk->image) }}"> Edit </button>
            </td>
          </tr> @endforeach </tbody>
      </table>
      {{-- Add Customer Modal --}}
      <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form action="{{ route('storecustomer') }}" method="POST" enctype="multipart/form-data"> @csrf <div class="modal-header">
                <h5 class="modal-title"> Create Customer </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body"> @if ($errors->any()) <div class="alert alert-danger">
                  <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                </div> @endif <div class="row">
                  {{-- Phone Number --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Phone Number </label>
                    <input type="text" class="form-control" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number') }}" required />
                  </div>
                  {{-- OTP --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> OTP </label>
                    <input type="text" class="form-control" name="otp" placeholder="Enter OTP" value="{{ old('otp') }}" />
                  </div>
                  {{-- Customer Image --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Customer Image </label>
                    <input type="file" class="form-control" name="image" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
                <button type="submit" class="btn btn-primary"> Create Customer </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- Edit Customer Modal --}}
      <div class="modal fade" id="editcustomermodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form method="POST" action="{{ url('customeredit') }}" enctype="multipart/form-data" name="customereditform"> @csrf <div class="modal-header">
                <h5 class="modal-title"> Edit Customer </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" id="customerid" value=""> @if ($errors->any()) <div class="alert alert-danger">
                  <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                </div> @endif <div class="row">
                  {{-- Current Customer Image --}}
                  <div class="col-md-12 mb-3 text-center">
                    <label class="form-label d-block"> Current Customer Image </label>
                    <img id="customer_preview" src="" width="200" class="img-fluid rounded border">
                  </div>
                  {{-- Phone Number --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Phone Number </label>
                    <input type="text" class="form-control" id="customer_phone" placeholder="Enter phone number" name="phone_number" required />
                  </div>
                  {{-- OTP --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> OTP </label>
                    <input type="text" class="form-control" id="customer_otp" placeholder="Enter OTP" name="otp" />
                  </div>
                  {{-- Change Customer Image --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Change Customer Image </label>
                    <input type="file" class="form-control" name="image" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
                <button type="submit" class="btn btn-primary"> Save Changes </button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </section>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.editcustomer').forEach(function(button) {
      button.addEventListener('click', function() {
        document.getElementById('customerid').value = this.dataset.id;
        document.getElementById('customer_phone').value = this.dataset.phone;
        document.getElementById('customer_otp').value = this.dataset.otp;
        document.getElementById('customer_preview').src = this.dataset.image;
        var modal = new bootstrap.Modal(document.getElementById('editcustomermodal'));
        modal.show();
      });
    });
  });
</script>@endsection