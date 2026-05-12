@extends('layouts.mainlayout') @section('content') <div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Create Subscription</h3>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Subscriptions</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card-header d-flex justify-content-end py-2">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubscriptionModal"> Create Subscription </button>
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
            <th>Customer</th>
            <th>Subscription ID</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody> @foreach($subscriptions as $bk) <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $bk->phone_number }}</td>
            <td>{{ $bk->plan_name }}</td>
            <td>{{ $bk->start_date }}</td>
            <td>{{ $bk->end_date }}</td>
            <td>
              <button type="button" class="btn btn-sm btn-primary editsubscription" data-id="{{ $bk->id }}" data-cus-id="{{ $bk->cus_id }}" data-subscription-id="{{ $bk->subscription_id }}" data-start-date="{{ $bk->start_date }}" data-end-date="{{ $bk->end_date }}"> Edit </button>
            </td>
          </tr> @endforeach </tbody>
      </table>
      {{-- Add Subscription Modal --}}
      <div class="modal fade" id="addSubscriptionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form action="{{ route('storesubscription') }}" method="POST"> @csrf <div class="modal-header">
                <h5 class="modal-title">Create Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Select Customer</label>
                    <select name="cus_id" class="form-control" required>
                      <option value="">Select Customer</option> @foreach($customers as $customer) <option value="{{ $customer->id }}">
                        {{ $customer->phone_number }}
                      </option> @endforeach
                    </select>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Subscription Plan</label>
                    <select name="subscription_id" class="form-control" required>
                      <option value="">Select Subscription Plan</option> @foreach($subplans as $plan) <option value="{{ $plan->id }}">
                        {{ $plan->plan_name }}
                      </option> @endforeach
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
                <button type="submit" class="btn btn-primary"> Create Subscription </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- Edit Subscription Modal --}}
      <div class="modal fade" id="editsubscriptionmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form method="POST" action="{{ url('subscriptionedit') }}" name="subscriptioneditform"> @csrf <div class="modal-header">
                <h5 class="modal-title">Edit Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" id="subscriptionid" value="">
                <div class="row">
                  {{-- Customer Dropdown --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Select Customer </label>
                    <select name="cus_id" id="subscription_cus_id" class="form-control" required>
                      <option value=""> Select Customer </option> @foreach($customers as $customer) <option value="{{ $customer->id }}">
                        {{ $customer->phone_number }}
                      </option> @endforeach
                    </select>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Subscription Plan</label>
                    <select name="subscription_id" id="subscription_plan_id" class="form-control" required>
                      <option value="">Select Subscription Plan</option> @foreach($subplans as $plan) <option value="{{ $plan->id }}">
                        {{ $plan->plan_name }}
                      </option> @endforeach
                    </select>
                  </div>
                  {{-- Start Date --}}
                  <div class="col-md-6 mb-3">
                    <label class="form-label"> Start Date </label>
                    <input type="date" name="start_date" id="subscription_start_date" class="form-control" required>
                  </div>
                  {{-- End Date --}}
                  <div class="col-md-6 mb-3">
                    <label class="form-label"> End Date </label>
                    <input type="date" name="end_date" id="subscription_end_date" class="form-control" required>
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
    document.querySelectorAll('.editsubscription').forEach(function(button) {
      button.addEventListener('click', function() {
        document.getElementById('subscriptionid').value = this.dataset.id;
        document.getElementById('subscription_cus_id').value = this.dataset.cusId;
        document.getElementById('subscription_plan_id').value = this.dataset.subscriptionId;
        document.getElementById('subscription_start_date').value = this.dataset.startDate;
        document.getElementById('subscription_end_date').value = this.dataset.endDate;
        var modal = new bootstrap.Modal(document.getElementById('editsubscriptionmodal'));
        modal.show();
      });
    });
  });
</script> @endsection