@extends('layouts.mainlayout') @section('content') <div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Create Category</h3>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card-header d-flex justify-content-end py-2">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal"> Create Category </button>
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
            <th>Category Name</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody> @foreach($categories as $bk) <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
              {{ $bk->category_name }}
            </td>
            <td>
              <img src="{{ asset('uploads/category/' . $bk->image) }}" width="100" class="rounded">
            </td>
            <td>
              <button type="button" class="btn btn-sm btn-primary editcategory" data-id="{{ $bk->id }}" data-name="{{ $bk->category_name }}" data-image="{{ asset('uploads/category/' . $bk->image) }}"> Edit </button>
            </td>
          </tr> @endforeach </tbody>
      </table>
      {{-- Add Category Modal --}}
      <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form action="{{ route('storecategory') }}" method="POST" enctype="multipart/form-data"> @csrf <div class="modal-header">
                <h5 class="modal-title">Create Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body"> @if ($errors->any()) <div class="alert alert-danger">
                  <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                </div> @endif <div class="row">
                  {{-- Category Name --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" class="form-control" name="category_name" placeholder="Enter category name" value="{{ old('category_name') }}" required />
                  </div>
                  {{-- Category Image --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Category Image</label>
                    <input type="file" class="form-control" name="image" required />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
                <button type="submit" class="btn btn-primary"> Create Category </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- Edit Category Modal --}}
      <div class="modal fade" id="editcategorymodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form method="POST" action="{{ url('categoryedit') }}" enctype="multipart/form-data" name="categoryeditform"> @csrf <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" id="categoryid" value=""> @if ($errors->any()) <div class="alert alert-danger">
                  <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                </div> @endif <div class="row">
                  {{-- Current Category Image --}}
                  <div class="col-md-12 mb-3 text-center">
                    <label class="form-label d-block"> Current Category Image </label>
                    <img id="category_preview" src="" width="200" class="img-fluid rounded border">
                  </div>
                  {{-- Category Name --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Category Name </label>
                    <input type="text" class="form-control" id="category_name" placeholder="Enter category name" name="category_name" required />
                  </div>
                  {{-- Change Category Image --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Change Category Image </label>
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
    document.querySelectorAll('.editcategory').forEach(function(button) {
      button.addEventListener('click', function() {
        document.getElementById('categoryid').value = this.dataset.id;
        document.getElementById('category_name').value = this.dataset.name;
        document.getElementById('category_preview').src = this.dataset.image;
        var modal = new bootstrap.Modal(document.getElementById('editcategorymodal'));
        modal.show();
      });
    });
  });
</script>@endsection