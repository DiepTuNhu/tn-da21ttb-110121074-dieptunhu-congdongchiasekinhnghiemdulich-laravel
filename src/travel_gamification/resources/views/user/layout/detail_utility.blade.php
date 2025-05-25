@extends('user.master')
@section('content')
<div class="container-utility" style="padding-top: 75px;">
  <div class="place-header">
    <div class="place-left">
      <img src="{{ $utility->image ? asset('storage/utility_image/' . $utility->image) : asset('default.png') }}"
           alt="{{ $utility->name }}"
           style="width: 565px; height: 440px; object-fit: cover; border-radius: 8px;" />
    </div>
    <div class="place-right">
      <div class="place-info">
        <h2>{{ $utility->name }}</h2>
        <p><strong>Vị trí:</strong> {{ $utility->address }}</p>
        <p><strong>Giờ mở cửa:</strong> {{ $utility->time }}</p>
        @if($utility->price)
            <p><strong>Giá:</strong> {{ $utility->price }}</p>
        @endif
        @if($utility->utility_types)
            <p><strong>Loại tiện ích:</strong> {{ $utility->utility_types->name }}</p>
        @endif
        @if($utility->status)
            <p><strong>Trạng thái:</strong> {{ $utility->status }}</p>
        @endif
      </div>
      @if($utility->latitude && $utility->longitude)
      <iframe
          src="https://www.google.com/maps?q={{ urlencode($utility->name . ', ' . $utility->address) }}&hl=vi&z=16&output=embed"
          allowfullscreen=""
          loading="lazy">
      </iframe>
      @endif
    </div>
  </div>

  <h3 class="section-title">Thông tin mô tả</h3>
  <div class="description">
    {!! $utility->description ?? 'Thông tin đang được cập nhật.' !!}
  </div>

  {{-- <h3 class="section-title">Tiện ích liên quan</h3>
  <div class="related-grid">
    @foreach($relatedUtilities as $item)
    <div class="related-card">
      <img src="{{ asset($item->image ?? 'default.png') }}" alt="{{ $item->name }}" />
      <div class="card-body">
        <h4>{{ $item->name }}</h4>
        <p> {{ $item->description }}</p>
      </div>
    </div>
    @endforeach
  </div> --}}

  <h3 class="section-title">Địa điểm gần tiện ích này</h3>
  <div class="related-grid">
    @forelse($nearbyDestinations as $destination)
        <a href="{{ route('destination.detail', $destination->id) }}" class="related-card" style="text-decoration:none; color:inherit;">
                       @if ($destination->destinationImages && $destination->destinationImages->isNotEmpty())
              <img src="{{ $destination->destinationImages->first()->image_url }}" alt="{{ $destination->name }}" />
            @else
              <img src="default-image.png" alt="Default Image" />
            @endif
              <div class="card-body" style="text-align: center">
                <h4>{{ $destination->name }}</h4>
                {{-- <p>{{ $destination->address }}</p> --}}
                @if($destination->pivot && $destination->pivot->distance)
                    <p><strong>Khoảng cách:</strong> {{ number_format($destination->pivot->distance, 2) }} km</p>
                @endif
            </div>
        </a>
    @empty
        <p>Không có địa điểm nào gần tiện ích này.</p>
    @endforelse
  </div>
</div>
@endsection