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
          <div class="utility-action-group">
<a href="{{ route('post_articles', ['id' => $utility->id, 'postType' => 'utility']) }}" class="btn-utility btn-utility-primary">
    <i class="fa fa-pen"></i> Thêm bài viết
</a>
          <a href="{{ route('page.community', [
              'destination_id' => $utility->destination_id,
              'utility_type_id' => $utility->utility_type_id
          ]) }}" class="btn-utility btn-utility-outline">
              <i class="fa fa-book-open"></i> Xem bài viết
          </a>
      </div>
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

<style>
.utility-action-group {
    display: flex;
    gap: 16px;
    margin-bottom: 10px;
    justify-content: flex-start; /* hoặc center nếu muốn căn giữa */
    flex-wrap: wrap;
}
.btn-utility {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: background 0.18s, color 0.18s, box-shadow 0.18s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    border: none;
    outline: none;
    cursor: pointer;
}
.btn-utility-primary {
    background: #007bff;
    color: #fff;
}
.btn-utility-primary:hover {
    background: #0056b3;
    color: #fff;
}
.btn-utility-outline {
    background: #fff;
    color: #007bff;
    border: 2px solid #007bff;
}
.btn-utility-outline:hover {
    background: #eaf6ff;
    color: #0056b3;
    border-color: #0056b3;
}
.btn-utility i {
    font-size: 17px;
}
</style>
@endsection