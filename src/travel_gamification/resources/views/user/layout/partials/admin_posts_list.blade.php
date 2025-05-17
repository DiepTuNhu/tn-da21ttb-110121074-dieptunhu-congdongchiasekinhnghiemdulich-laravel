<div class="posts" id="admin-posts">
      @foreach ($destinations as $destination)
        <a href="{{ route('destination.detail', ['id' => $destination->id]) }}" style="text-decoration:none; color:inherit;" >
          <div class="post-card admin-post">
            {{-- Kiểm tra nếu có hình ảnh --}}
            @if ($destination->destinationImages && $destination->destinationImages->isNotEmpty())
              <img src="{{ $destination->destinationImages->first()->image_url }}" alt="{{ $destination->name }}" />
            @else
              <img src="default-image.png" alt="Default Image" />
            @endif

            {{-- Hiển thị tên địa điểm --}}
            <h3 style="text-align: center">{{ $destination->name }}</h3>

            {{-- Hiển thị đặc điểm nổi bật --}}
            <p class="post-excerpt" style="text-align: justify">
              {{ strip_tags($destination->highlights) }}
            </p>

            {{-- Hiển thị địa chỉ và giá --}}
            <div class="post-info-block">
              <div class="info-row">
                <i class="fas fa-location-dot"></i>
                <span>{{ $destination->address }}</span>
              </div>
              <div class="info-row">
                <i class="fas fa-dollar-sign"></i>
                <span>{{ $destination->price }}</span>
              </div>

              <hr class="info-divider" />

              {{-- Footer thông tin --}}
              <div class="info-footer">
                <span><i class="fas fa-calendar-alt"></i> {{ $destination->updated_at->format('d/m/Y') }}</span>
                <span><i class="fas fa-heart" style="color: #e74c3c"></i> 135 lượt thích</span>
              </div>
            </div>
          </div>
        </a>
      @endforeach
    </div>