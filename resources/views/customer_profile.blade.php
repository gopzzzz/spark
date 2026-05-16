```blade
@extends('layouts.mainlayout')

@section('content')

<div class="page-heading">

    <div class="page-title">
        <h3>
            Customer Profile
        </h3>
    </div>

    <section class="section">

        {{-- Customer Details --}}
        <div class="card">

            <div class="card-header">
                <h4>Profile Details</h4>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3">

                        <img
                            src="{{ asset('uploads/customers/' . $customer->image) }}"
                            class="img-fluid rounded">

                    </div>

                    <div class="col-md-9">

                        <p>
                            <strong>Name:</strong>
                            {{ $customer->name ?? 'N/A' }}
                        </p>

                        <p>
                            <strong>Phone:</strong>
                            {{ $customer->phone_number }}
                        </p>

                        <p>
                            <strong>Qualification:</strong>
                            {{ $customer->qualification ?? 'N/A' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- Subscription Details --}}
        <div class="card">

            <div class="card-header">
                <h4>Subscription Details</h4>
            </div>

            <div class="card-body">

                <table class="table table-striped">

                    <thead>
                        <tr>

                            <th>Plan</th>
                            <th>Amount</th>
                            <th>Start Date</th>
                            <th>End Date</th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach($subscriptions as $sub)

                        <tr>

                            <td>{{ $sub->plan_name }}</td>

                            <td>{{ $sub->amount }}</td>

                            <td>{{ $sub->start_date }}</td>

                            <td>{{ $sub->end_date }}</td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        {{-- Watch History --}}
        <div class="card">

            <div class="card-header">
                <h4>Watch History</h4>
            </div>

            <div class="card-body">

                <table class="table table-striped">

                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Video</th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach($watchhistory as $watch)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $watch->video_title }}</td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        {{-- Favorites --}}
        <div class="card">

            <div class="card-header">
                <h4>Favorite Videos</h4>
            </div>

            <div class="card-body">

                <table class="table table-striped">

                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Video</th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach($favorites as $fav)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $fav->video_title }}</td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

@endsection
```
