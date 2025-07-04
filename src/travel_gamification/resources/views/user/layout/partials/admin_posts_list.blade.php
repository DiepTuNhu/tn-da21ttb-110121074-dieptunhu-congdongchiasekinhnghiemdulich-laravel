<div class="posts" id="admin-posts">
  @if($destinations->count())
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
          <h4 style="text-align: center">{{ $destination->name }}</h4>

          {{-- Hiển thị đặc điểm nổi bật --}}
          <p class="post-excerpt" style="text-align: justify">
            {{ strip_tags($destination->highlights) }}
          </p>

          {{-- Hiển thị địa chỉ và giá --}}
          <div class="post-info-block">
            <div class="info-row">
              <i class="fas fa-location-dot"></i>
              <span>
                    {{
                        collect(explode(',', $destination->address))
                            ->slice(-2)
                            ->implode(',')
                    }}
              </span>
            </div>
            {{-- <div class="info-row">
              <i class="fas fa-dollar-sign"></i>
              <span>{{ $destination->price }}</span>
            </div> --}}

            <hr class="info-divider" style="margin: 0;"/>

            {{-- Footer thông tin --}}
            <div class="info-footer">
              <span><i class="fas fa-calendar-alt"></i> {{ $destination->updated_at->format('d/m/Y') }}</span>
              {{-- <span><i class="fas fa-heart" style="color: #e74c3c"></i> 135 lượt thích</span> --}}
            </div>
          </div>
        </div>
      </a>
    @endforeach
  @else
    <div class="alert alert-warning" style="margin-top: 30px;">
        Không tìm thấy địa điểm phù hợp.
    </div>
  @endif
</div>