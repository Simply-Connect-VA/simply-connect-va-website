@extends('app')
@section('title', trans_choice('common.pilot', 2))

@section('content')
  <div class="container py-3 py-md-4">
    <div class="p-4">
      <div class="row">
        <div class="col-md-12">
          <h2><i class="fas fa-fighter-jet"></i> {{ trans_choice('common.pilot', 2) }}</h2>
          <p class="lead mb-5">Lorem ipsum dolor sit amet.</p>
          @include('users.table')
          {{ $users->links('pagination.default') }}
        </div>
      </div>
    </div>
  </div>
@endsection
