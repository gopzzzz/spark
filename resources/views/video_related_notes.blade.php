@extends('layouts.mainlayout')

@section('content')

<div class="page-heading">

    <div class="page-title">
        <h3>
            Related Notes - {{ $video->title }}
        </h3>
    </div>

    <section class="section">

        <div class="card">

            <div class="card-body">

                <table class="table table-striped">

                
<thead>
    <tr>

        <th>#</th>

        <th>Files</th>

        <th>Video</th>

    </tr>
</thead>

<tbody>

    @foreach($relatednotes as $note)

    <tr>

        <td>
            {{ $loop->iteration }}
        </td>

        <td>

            @php
                $files = explode(',', $note->related_notes);
            @endphp

            @foreach($files as $file)

                <a
                    href="{{ asset('related_notes/' . trim($file)) }}"
                    target="_blank">

                    View File

                </a>

                <br>

            @endforeach

        </td>

        <td>

            {{ $note->video_title }}

        </td>

    </tr>

    @endforeach

</tbody>


                </table>

            </div>

        </div>

    </section>

</div>

@endsection