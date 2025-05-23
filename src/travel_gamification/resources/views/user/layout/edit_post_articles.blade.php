@extends('user.master')
@section('content')
<div style="padding-top: 75px">
    @if($postType === 'utility')
        {{-- FORM SỬA BÀI TIỆN ÍCH --}}
        <section class="submit-section" id="submit-section-utility">
            <h2>🧰 Sửa bài tiện ích</h2>
            <form class="submit-form" method="POST" action="{{ route('post.update', $post->id) }}">
                @csrf
                <input type="hidden" name="post_type" value="utility">
                <div class="form-group">
                    <label for="utility_title" class="form-label">Tiêu đề tiện ích</label>
                    <input type="text" id="utility_title" name="title" class="form-control" value="{{ old('title', $post->title) }}" required />
                </div>
                <div class="form-group">
                    <label for="utility_content" class="form-label">Nội dung tiện ích</label>
                    <textarea id="utility_content" name="content" class="form-control" rows="6" placeholder="Mô tả tiện ích...">{{ old('content', $post->content) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="utility" class="form-label">Chọn tiện ích</label>
                    <select id="utility" name="utility_id" class="form-control" required>
                        <option value="">Chọn tiện ích</option>
                        @foreach($utilities as $utility)
                            <option value="{{ $utility->id }}" {{ (old('utility_id', $post->utility_id) == $utility->id) ? 'selected' : '' }}>
                                {{ $utility->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price" class="form-label">Giá</label>
                    <input type="text" id="price" name="price" class="form-control" value="{{ old('price', $post->price) }}" />
                </div>
                <div class="form-group">
                    <label for="opening_hours" class="form-label">Giờ phục vụ</label>
                    <input type="text" id="opening_hours" name="opening_hours" class="form-control" value="{{ old('opening_hours', $post->opening_hours) }}" />
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $post->phone) }}" />
                </div>
                <button type="submit" class="btn-submit">Cập nhật tiện ích</button>
            </form>
        </section>
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

        <script>
            ClassicEditor.create(document.querySelector('#utility_content'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}'
                },
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'link',
                    'bulletedList', 'numberedList', 'blockQuote', '|',
                    'insertTable', 'uploadImage', 'undo', 'redo'
                ]
            })
            .catch(error => {
                console.error('CKEditor error:', error);
            });
        </script>
    @else
        {{-- FORM SỬA BÀI ĐỊA ĐIỂM --}}
        <section class="submit-section" id="submit-section-destination">
            <h2>📝 Sửa bài chia sẻ của bạn</h2>
            <form class="submit-form" method="POST" action="{{ route('post.update', $post->id) }}">
                @csrf
                <input type="hidden" name="post_type" value="destination">
                <div class="form-group">
                    <label for="title" class="form-label">Tiêu đề bài viết</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}" required />
                </div>
                <div class="form-group">
                    <label for="content" class="form-label">Nội dung bài viết</label>
                    <textarea id="content" name="content" class="form-control" rows="6">{{ old('content', $post->content) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="location" class="form-label">Địa điểm</label>
                    <select id="location" name="location" class="form-control" required>
                        <option value="">Chọn địa điểm</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ (old('location', $post->destination_id) == $destination->id) ? 'selected' : '' }}>
                                {{ $destination->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cost" class="form-label">Chi phí</label>
                    <input type="text" id="cost" name="cost" class="form-control" value="{{ old('cost', $post->price) }}" />
                </div>
                <button type="submit" class="btn-submit">Cập nhật bài viết</button>
            </form>
        </section>
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor.create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}'
                },
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'link',
                    'bulletedList', 'numberedList', 'blockQuote', '|',
                    'insertTable', 'uploadImage', 'undo', 'redo'
                ]
            })
            .catch(error => {
                console.error('CKEditor error:', error);
            });
        </script>
    @endif
</div>
@endsection