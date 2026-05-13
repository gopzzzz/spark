@extends('layouts.mainlayout') @section('content') <div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Create Video</h3>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Videos</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card-header d-flex justify-content-end py-2">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVideoModal"> Create Video </button>
    </div>
    <div class="card"> @if(session('success')) <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> @endif @if ($errors->any()) <div class="alert alert-warning">
        <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
      </div> @endif </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table align-middle" id="table1">
          <thead>
            <tr>
              <th>#</th>
              <th>Video</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody> @foreach($videos as $bk) <tr>
              <td>{{ $loop->iteration }}</td>
              {{-- YouTube Style Video Column --}}
              <td>
                <div class="d-flex align-items-start gap-3">
                  {{-- Thumbnail --}}
                  <div>
                    <video width="160" height="90" class="rounded" controls style="object-fit: cover;">
                      <source src="{{ asset('uploads/videos/' . $bk->video) }}" type="video/mp4">
                    </video>
                  </div>
                  {{-- Video Details --}}
                  <div>
                    <h6 class="mb-1 fw-bold">
                      {{ $bk->title }}
                    </h6>
                    <small class="text-muted d-block mb-2"> Category : {{ $bk->category_name ?? 'N/A' }}
                    </small>
                    <p class="text-muted small mb-0">
                      {{ Str::limit($bk->description, 100) }}
                    </p>
                  </div>
                </div>
              </td>
              {{-- Status --}}
              <td> @if($bk->status == 1) <span class="badge bg-success"> Active </span> @else <span class="badge bg-danger"> Inactive </span> @endif </td>
              {{-- Action --}}
              <td>
                <button type="button" class="btn btn-sm btn-primary editvideo" data-id="{{ $bk->id }}" data-title="{{ $bk->title }}" data-category-id="{{ $bk->category_id }}" data-description="{{ $bk->description }}" data-status="{{ $bk->status }}" data-thumbnail="{{ asset('uploads/thumbnails/' . $bk->thumbnail) }}" data-video="{{ asset('uploads/videos/' . $bk->video) }}"> Edit </button>
              </td>
            </tr> @endforeach </tbody>
        </table>
      </div>
      {{-- Add Video Modal --}}
      <div class="modal fade" id="addVideoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <form action="{{ route('storevideo') }}" method="POST" enctype="multipart/form-data"> @csrf <div class="modal-header">
                <h5 class="modal-title"> Create Video </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body"> @if ($errors->any()) <div class="alert alert-danger">
                  <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                </div> @endif <div class="row">
                  {{-- Video Title --}}
                  <div class="col-md-6 mb-3">
                    <label class="form-label"> Video Title </label>
                    <input type="text" class="form-control" name="title" placeholder="Enter video title" value="{{ old('title') }}" required />
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Select Category</label>
                    <select name="category_id" class="form-control" required>
                      <option value="">Select Category</option> @foreach($categories as $category) <option value="{{ $category->id }}">{{ $category->category_name }}</option>@endforeach
                    </select>
                  </div>
                  {{-- Status --}}
                  <div class="col-md-6 mb-3">
                    <label class="form-label"> Status </label>
                    <select name="status" class="form-control" required>
                      <option value="1"> Active </option>
                      <option value="0"> Inactive </option>
                    </select>
                  </div>
                  {{-- Description --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Description </label>
                    <textarea class="form-control" name="description" rows="4" placeholder="Enter description">{{ old('description') }}</textarea>
                  </div>
                  {{-- Upload Video --}}
                  <div class="col-md-6 mb-3">
                    <label class="form-label"> Upload Video </label>
                    <input type="file" class="form-control" name="video" required />
                  </div>
                  {{-- Thumbnail --}}
                  <div class="col-md-6 mb-3">
                    <label class="form-label"> Thumbnail Image </label>
                    <input type="file" class="form-control" name="thumbnail" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
                <button type="submit" class="btn btn-primary"> Create Video </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- Edit Video Modal --}}
      <div class="modal fade" id="editvideomodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <form method="POST" action="{{ url('videoedit') }}" enctype="multipart/form-data" name="videoeditform"> @csrf <div class="modal-header">
                <h5 class="modal-title">Edit Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" id="videoid" value="">
                <div class="row">
                  <div class="col-md-12 mb-3 text-center">
                    <label class="form-label d-block">Current Thumbnail</label>
                    <img id="video_thumbnail_preview" src="" width="200" class="img-fluid rounded border">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Video Title</label>
                    <input type="text" class="form-control" id="video_title" name="title" placeholder="Enter video title" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Select Category</label>
                    <select name="category_id" id="edit_category_id" class="form-control" required>
                      <option value="">Select Category </option> @foreach($categories as $category) <option value="{{ $category->id }}"> {{ $category->category_name }}</option> @endforeach
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" id="video_status" class="form-control" required>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" id="video_description" name="description" rows="4" placeholder="Enter description"></textarea>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Change Video</label>
                    <input type="file" class="form-control" name="video">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Change Thumbnail</label>
                    <input type="file" class="form-control" name="thumbnail">
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
    document.querySelectorAll('.editvideo').forEach(function(button) {
      button.addEventListener('click', function() {
        document.getElementById('videoid').value = this.dataset.id;
        document.getElementById('video_title').value = this.dataset.title;
        document.getElementById('edit_category_id').value = this.dataset.categoryId;
        document.getElementById('video_description').value = this.dataset.description;
        document.getElementById('video_status').value = this.dataset.status;
        document.getElementById('video_thumbnail_preview').src = this.dataset.thumbnail;
        var modal = new bootstrap.Modal(document.getElementById('editvideomodal'));
        modal.show();
      });
    });
  });
</script>@endsection