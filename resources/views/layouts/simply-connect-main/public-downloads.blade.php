@extends('app')
@section('title', 'Public Downloads')

@section('content')
  <div class="container py-3 py-md-4">
    <div class="p-4">
      <div class="row">
        <div class="col-md-12">
          <h2><i class="fas fa-file-download"></i> Downloads</h2>
          <p class="lead mb-5">Lorem ipsum dolor sit amet.</p>

          <div class="row">

            @foreach ([
                0 => [
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'image' => 'https://via.placeholder.com/200x200?text=200x200',
                    'link' => 'https://example.com',
                    'title' => 'File 1'
                ],
                1 => [
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'image' => 'https://via.placeholder.com/200x200?text=200x200',
                    'link' => 'https://example.com',
                    'title' => 'File 2'
                ],
                2 => [
                    'description' => 'Lorem ipsum dolor sit amet.',
                    'image' => 'https://via.placeholder.com/200x200?text=200x200',
                    'link' => 'https://example.com',
                    'title' => 'File 3'
                ]
            ] as $v)
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-sm-2">
                    <img alt="{{ htmlspecialchars($v['title']) }}" src="{{ $v['image'] }}">
                  </div>
                  <div class="col-sm-10">
                    <h4 class="mt-0">
                      {{ $v['title'] }}
                    </h4>
                    <p>
                      {{ $v['description'] }}
                    </p>
                    <p>
                      <a class="btn btn-primary" href="{{ $v['link'] }}" role="button" target="_blank">Download</a>
                    </p>
                  </div>
                </div>
              </div>
            @endforeach

          </div>

        </div>
      </div>
    </div>
  </div>
@endsection