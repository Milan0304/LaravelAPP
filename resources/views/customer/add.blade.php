@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Customer</h3>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ url('/customer') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}"
                                       placeholder="Your name">
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea name="address" cols="5" rows="5"
                                          class="form-control {{ $errors->has('address') ? 'is-invalid':'' }}"
                                          placeholder="Your address"></textarea>
                                <p class="text-danger">{{ $errors->first('address') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" name="phone"
                                       class="form-control {{ $errors->has('phone') ? 'is-invalid':'' }}"
                                       placeholder="Your phone">
                                <p class="text-danger">{{ $errors->first('phone') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email"
                                       class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}"
                                       placeholder="Your email">
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger btn-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
