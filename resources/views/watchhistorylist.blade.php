@extends('layouts.mainlayout') @section('content') <div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Create Watch History</h3>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Watch History</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card-header d-flex justify-content-end py-2">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addWatchHistoryModal"> Create Watch History </button>
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
            <th>Video</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody> @foreach($watchhistory as $bk) <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $bk->phone_number }}</td>
            <td>{{ $bk->video_title }}</td>
            <td>
              <button type="button" class="btn btn-sm btn-primary editwatchhistory" data-id="{{ $bk->id }}" data-cus-id="{{ $bk->cus_id }}" data-video-id="{{ $bk->video_id }}"> Edit </button>
            </td>
          </tr> @endforeach </tbody>
      </table>
      {{-- Add Watch History Modal --}}
      <div class="modal fade" id="addWatchHistoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form action="{{ route('storewatchhistory') }}" method="POST"> @csrf <div class="modal-header">
                <h5 class="modal-title">Create Watch History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body"> @if ($errors->any()) <div class="alert alert-danger">
                  <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                </div> @endif <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Select Customer</label>
                    <select name="cus_id" class="form-control" required>
                      <option value="">Select Customer</option> @foreach($customers as $customer) <option value="{{ $customer->id }}">
                        {{ $customer->phone_number }}
                      </option> @endforeach
                    </select>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Select Video</label>
                    <select name="video_id" class="form-control" required>
                      <option value="">Select Video</option> @foreach($videos as $video) <option value="{{ $video->id }}">
                        {{ $video->title }}
                      </option> @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
                <button type="submit" class="btn btn-primary"> Create Watch History </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- Edit Watch History Modal --}}
      <div class="modal fade" id="editwatchhistorymodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form method="POST" action="{{ url('watchhistoryedit') }}" name="watchhistoryeditform"> @csrf <div class="modal-header">
                <h5 class="modal-title">Edit Watch History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" id="watchhistoryid" value=""> @if ($errors->any()) <div class="alert alert-danger">
                  <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                </div> @endif <div class="row">
                  {{-- Customer Dropdown --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Select Customer </label>
                    <select name="cus_id" id="edit_cus_id" class="form-control" required>
                      <option value=""> Select Customer </option> @foreach($customers as $customer) <option value="{{ $customer->id }}">
                        {{ $customer->phone_number }}
                      </option> @endforeach
                    </select>
                  </div>
                  {{-- Video Dropdown --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Select Video </label>
                    <select name="video_id" id="edit_video_id" class="form-control" required>
                      <option value=""> Select Video </option> @foreach($videos as $video) <option value="{{ $video->id }}">
                        {{ $video->title }}
                      </option> @endforeach
                    </select>
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
    document.querySelectorAll('.editwatchhistory').forEach(function(button) {
      button.addEventListener('click', function() {
        document.getElementById('watchhistoryid').value = this.dataset.id;
        document.getElementById('edit_cus_id').value = this.dataset.cusId;
        document.getElementById('edit_video_id').value = this.dataset.videoId;
        var modal = new bootstrap.Modal(document.getElementById('editwatchhistorymodal'));
        modal.show();
      });
    });
  });
</script> @endsection