@extends('layouts.mainlayout') @section('content') <div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Create Subscription Plan</h3>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Subscription Plan</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card-header d-flex justify-content-end py-2">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubplanModal"> Create Subscription Plan </button>
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
            <th>Plan Name</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody> @foreach($subplans as $bk) <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $bk->plan_name }}</td>
            <td>{{ $bk->description }}</td>
            <td>{{ $bk->amount }}</td>
            <td> @if($bk->images) <img src="{{ asset('uploads/subplans/' . $bk->images) }}" width="100" class="rounded"> @else No Image @endif </td>
            <td>
              <button type="button" class="btn btn-sm btn-primary editsubplan" data-id="{{ $bk->id }}" data-plan-name="{{ $bk->plan_name }}" data-description="{{ $bk->description }}" data-amount="{{ $bk->amount }}" data-image="{{ asset('uploads/subplans/' . $bk->images) }}"> Edit </button>
            </td>
          </tr> @endforeach </tbody>
      </table>
      {{-- Add Sub Plan Modal --}}
      <div class="modal fade" id="addSubplanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form action="{{ route('storesubplan') }}" method="POST" enctype="multipart/form-data"> @csrf <div class="modal-header">
                <h5 class="modal-title">Create Sub Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Plan Name</label>
                    <input type="text" name="plan_name" class="form-control" placeholder="Enter plan name" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Enter description"></textarea>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" class="form-control" placeholder="Enter amount" step="0.01" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="images" class="form-control">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
                <button type="submit" class="btn btn-primary"> Create Sub Plan </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- Edit Sub Plan Modal --}}
      <div class="modal fade" id="editsubplanmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form method="POST" action="{{ url('subplanedit') }}" enctype="multipart/form-data" name="subplaneditform"> @csrf <div class="modal-header">
                <h5 class="modal-title">Edit Sub Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" id="subplanid" value="">
                <div class="row">
                  {{-- Current Image --}}
                  <div class="col-md-12 mb-3 text-center">
                    <label class="form-label d-block"> Current Image </label>
                    <img id="subplan_preview" src="" width="200" class="img-fluid rounded border">
                  </div>
                  {{-- Plan Name --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Plan Name </label>
                    <input type="text" name="plan_name" id="subplan_name" class="form-control" placeholder="Enter plan name" required>
                  </div>
                  {{-- Description --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Description </label>
                    <textarea name="description" id="subplan_description" class="form-control" rows="4" placeholder="Enter description"></textarea>
                  </div>
                  {{-- Amount --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Amount </label>
                    <input type="number" name="amount" id="subplan_amount" class="form-control" step="0.01" placeholder="Enter amount" required>
                  </div>
                  {{-- Change Image --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Change Image </label>
                    <input type="file" name="images" class="form-control">
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
    document.querySelectorAll('.editsubplan').forEach(function(button) {
      button.addEventListener('click', function() {
        document.getElementById('subplanid').value = this.dataset.id;
        document.getElementById('subplan_name').value = this.dataset.planName;
        document.getElementById('subplan_description').value = this.dataset.description;
        document.getElementById('subplan_amount').value = this.dataset.amount;
        document.getElementById('subplan_preview').src = this.dataset.image;
        var modal = new bootstrap.Modal(document.getElementById('editsubplanmodal'));
        modal.show();
      });
    });
  });
</script> @endsection