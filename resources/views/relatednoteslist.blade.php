@extends('layouts.mainlayout') @section('content') <div class="page-heading">
  <div class="page-title">
    <div class="row">
      <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Create Related Note</h3>
      </div>
      <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Related Notes</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card-header d-flex justify-content-end py-2">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRelatedNoteModal"> Create Related Notes </button>
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
            <th>Video</th>
            <th>Related Notes</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody> @foreach($relatednotes as $bk) <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $bk->video_title }}</td>
            <td>
              @php $files = explode(',', $bk->related_notes);@endphp @foreach($files as $file) <a href="{{ asset('related_notes/'.$file) }}" target="_blank"> View File
        </a><br>
    @endforeach
</td>
            <td>
              <button type="button" class="btn btn-sm btn-primary editrelatednote" data-id="{{ $bk->id }}" data-video-id="{{ $bk->video_id }}" data-related-notes="{{ $bk->related_notes }}"> Edit </button>
            </td>
          </tr> @endforeach </tbody>
      </table>
      {{-- Add Related Note Modal --}}
      <div class="modal fade" id="addRelatedNoteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form action="{{ route('storerelatednote') }}" method="POST"  enctype="multipart/form-data"> @csrf <div class="modal-header">
                <h5 class="modal-title">Create Related Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body"> @if ($errors->any()) <div class="alert alert-danger">
                  <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                </div> @endif <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Select Video</label>
                    <select name="video_id" class="form-control" required>
                      <option value="">Select Video</option> @foreach($videos as $video) <option value="{{ $video->id }}">
                        {{ $video->title }}
                      </option> @endforeach
                    </select>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label">Related Notes</label>
                    <input type="file" name="related_notes[]" class="form-control" multiple accept=".pdf,image/*">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
                <button type="submit" class="btn btn-primary"> Create Related Note </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- Edit Related Note Modal --}}
      <div class="modal fade" id="editrelatednotemodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <form method="POST" action="{{ url('relatednoteedit') }}" name="relatednoteeditform" enctype="multipart/form-data"> @csrf <div class="modal-header">
                <h5 class="modal-title">Edit Related Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id" id="relatednoteid" value=""><input type="hidden" name="existing_files" id="existing_files_input"> @if ($errors->any()) <div class="alert alert-danger">
                
                <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                </div> @endif <div class="row">
                  {{-- Video Dropdown --}}
                  <div class="col-md-12 mb-3">
                    <label class="form-label"> Select Video </label>
                    <select name="video_id" id="edit_video_id" class="form-control" required>
                      <option value=""> Select Video </option> @foreach($videos as $video) <option value="{{ $video->id }}">
                        {{ $video->title }}
                      </option> @endforeach
                    </select>
                  </div>
                 {{-- Related Notes --}}
                 <div class="col-md-12 mb-3">
                  <label class="form-label"> Related Notes </label>
                  <input type="file" class="form-control" id="edit_related_notes" name="related_notes[]" multiple accept=".pdf,image/*"></div>
                  <div class="mt-3"><label class="form-label"> Existing Files</label> <div id="existing_files"></div></div>
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

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.editrelatednote').forEach(function(button) {

        button.addEventListener('click', function() {

            document.getElementById('relatednoteid').value =
                this.dataset.id;

            document.getElementById('edit_video_id').value =
                this.dataset.videoId;

            let files =
                this.dataset.relatedNotes.split(',');

            let html = '';

            files.forEach(function(file, index) {

                html += `
                    <div class="mb-2 file-item">

                        <a href="/related_notes/${file}"
                           target="_blank">

                            ${file}

                        </a>

                        <button
                            type="button"
                            class="btn btn-sm btn-danger ms-2 remove-file"
                            data-file="${file}"
                        >
                            Remove
                        </button>

                    </div>
                `;
            });

            document.getElementById('existing_files').innerHTML = html;

            document.getElementById('existing_files_input').value =
                this.dataset.relatedNotes;

            // remove file
            document.querySelectorAll('.remove-file').forEach(function(btn){

                btn.addEventListener('click', function(){

                    let fileToRemove = this.dataset.file;

                    let currentFiles =
                        document.getElementById('existing_files_input')
                        .value
                        .split(',');

                    currentFiles =
                        currentFiles.filter(file =>
                            file !== fileToRemove
                        );

                    document.getElementById('existing_files_input').value =
                        currentFiles.join(',');

                    this.parentElement.remove();

                });

            });

            var modal = new bootstrap.Modal(
                document.getElementById('editrelatednotemodal')
            );

            modal.show();

        });

    });

});

</script> @endsection