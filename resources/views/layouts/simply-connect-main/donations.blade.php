@extends('app')
@section('title', 'Donations')

@section('content')
  <div class="container py-3 py-md-4">
    <div class="p-4">
      <div class="row">
        <div class="col-md-12">
          <h2><i class="fas fa-comments-dollar"></i> Donations</h2>
          <p class="lead mb-5">We are a voluntary, not-for-profit organisation, that fulfills a role to provide a structured, hands-on educational environment for aspiring pilots using any flight sim. Donations are very much welcome to keep this community active and growing.</p>
          <div class="list-group">
            <a class="list-group-item list-group-item-action" href="https://www.youtube.com/c/InsideAgameR/membership" target="_blank">
              Provide support by joinning the membership on our YouTube channel.
            </a>
            <a class="list-group-item list-group-item-action" href="https://www.paypal.com/paypalme/InsideAgameR" target="_blank">
              Or make a donation via PayPal.
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection