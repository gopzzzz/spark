@extends('layouts.mainlayout') @section('content') <div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Create banners</h3>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Banners</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    
    <div class="card-header d-flex justify-content-end py-2">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBannerModal"> Create Banner </button>
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
            <th>Image</th>
            <th>Link</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody> @foreach($banners as $bk) <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
              <img src="{{ asset('uploads/banners/' . $bk->image) }}" width="100" class="rounded">
            </td>
            <td> @if($bk->link) <a href="{{ $bk->link }}" target="_blank">{{ $bk->link }}</a> @else No Link @endif </td>
            <td>
              <button type="button" class="btn btn-sm btn-primary editbanner" data-id="{{ $bk->id }}" data-link="{{ $bk->link }}" data-image="{{ asset('uploads/banners/' . $bk->image) }}"> Edit </button>
            </td>
          </tr> @endforeach </tbody>
      </table>
      {{-- Add Banner Modal --}}
      <div class="modal fade" id="addBannerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form action="{{ route('storebanner') }}" method="POST" enctype="multipart/form-data"> @csrf <div class="modal-header">
                <h5 class="modal-title">Create Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body"> @if ($errors->any()) <div class="alert alert-danger">
                  <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                </div> @endif <div class="row">
                  {{-- Banner Image --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Banner Image</label>
                    <input type="file" class="form-control" name="image" required />
                  </div>
                  {{-- Banner Link --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Banner Link</label>
                    <input type="url" class="form-control" placeholder="https://example.com" name="link" value="{{ old('link') }}" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
                <button type="submit" class="btn btn-primary"> Create Banner </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- Edit Banner Modal --}}
      <div class="modal fade" id="editbannermodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form method="POST" action="{{ url('banneredit') }}" enctype="multipart/form-data" name="bannereditform"> @csrf <div class="modal-header">
                <h5 class="modal-title">Edit Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" id="bannerid" value=""> @if ($errors->any()) <div class="alert alert-danger">
                  <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                </div> @endif <div class="row">
                  {{-- Current Banner --}}
                  <div class="col-md-12 mb-3 text-center">
                    <label class="form-label d-block">Current Banner</label>
                    <img id="banner_preview" src="" width="200" class="img-fluid rounded border">
                  </div>
                  {{-- Banner Image --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Change Banner Image</label>
                    <input type="file" class="form-control" name="image" />
                  </div>
                  {{-- Banner Link --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Banner Link</label>
                    <input type="url" class="form-control" id="banner_link" placeholder="https://example.com" name="link" />
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
    document.querySelectorAll('.editbanner').forEach(function(button) {
      button.addEventListener('click', function() {
        document.getElementById('bannerid').value = this.dataset.id;
        document.getElementById('banner_link').value = this.dataset.link;
        document.getElementById('banner_preview').src = this.dataset.image;
        var modal = new bootstrap.Modal(document.getElementById('editbannermodal'));
        modal.show();
      });
    });
  });
</script> @endsection