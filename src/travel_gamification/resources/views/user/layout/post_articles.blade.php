@extends('user.master')
@section('content')
<div style="padding-top: 75px">
    @if(isset($stepsType) && $stepsType === 'utility')
        {{-- 3 bước: Tạo địa điểm -> Tạo tiện ích -> Đăng bài --}}
        <div class="progress-steps-wrapper" style="margin: 0 auto; max-width: 600px; padding-top: 30px;">
            <div class="progress-steps">
                <div class="step {{ $step == 1 ? 'active' : '' }}">
                    <div class="circle">1</div>
                    <div class="label">Tạo địa điểm</div>
                </div>
                <div class="line"></div>
                <div class="step {{ $step == 2 ? 'active' : '' }}">
                    <div class="circle">2</div>
                    <div class="label">Tạo tiện ích</div>
                </div>
                <div class="line"></div>
                <div class="step {{ $step == 3 ? 'active' : '' }}">
                    <div class="circle">3</div>
                    <div class="label">Đăng bài</div>
                </div>
            </div>
        </div>
    @else
        {{-- 2 bước: Tạo địa điểm -> Đăng bài --}}
        <div class="progress-steps-wrapper" style="margin: 0 auto; max-width: 500px; padding-top: 30px;">
            <div class="progress-steps">
                <div class="step {{ $step == 1 ? 'active' : '' }}">
                    <div class="circle">1</div>
                    <div class="label">Tạo địa điểm</div>
                </div>
                <div class="line"></div>
                <div class="step {{ $step == 2 ? 'active' : '' }}">
                    <div class="circle">2</div>
                    <div class="label">Đăng bài</div>
                </div>
            </div>
        </div>
    @endif

    <style>
    .progress-steps-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .progress-steps {
        display: flex;
        align-items: center;
        gap: 32px;
    }
    .progress-steps .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 90px;
    }
    .progress-steps .circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e0e0e0;
        color: #888;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 6px;
        transition: background 0.3s, color 0.3s;
        border: 2px solid #e0e0e0;
    }
    .progress-steps .step.active .circle {
        background: #007bff;
        color: #fff;
        border: 2px solid #007bff;
        box-shadow: 0 0 8px #007bff55;
    }
    .progress-steps .label {
        font-size: 15px;
        color: #333;
        font-weight: 500;
        text-align: center;
    }
    .progress-steps .line {
        flex: 1;
        height: 3px;
        background: linear-gradient(90deg, #e0e0e0 0%, #007bff 100%);
        min-width: 40px;
        border-radius: 2px;
    }
    </style>
    @if($postType === 'utility')
        {{-- FORM ĐĂNG BÀI TIỆN ÍCH --}}
        <section class="submit-section" id="submit-section-utility">
            <h2>Đăng bài tiện ích</h2>
            <form class="submit-form" method="POST" action="{{ route('post_articles.store') }}">
                @csrf
                <input type="hidden" name="post_type" value="utility">
                <div class="form-group">
                    <label for="utility_title" class="form-label">Tiêu đề tiện ích</label>
                    <input type="text" id="utility_title" name="title" class="form-control" placeholder="Tiêu đề tiện ích" required />
                </div>
                <div class="form-group">
                    <label for="utility_content" class="form-label">Nội dung tiện ích</label>
                    <textarea id="utility_content" name="content" class="form-control" rows="6" placeholder="Mô tả tiện ích..."></textarea>
                </div>
                <div class="form-group">
                    <label for="utility" class="form-label">Chọn tiện ích</label>
                    <select id="utility" name="utility_id" class="form-control" required disabled>
                        <option value="">Chọn tiện ích</option>
                        @foreach($utilities as $utility)
                            <option value="{{ $utility->id }}" {{ isset($selectedUtility) && $selectedUtility == $utility->id ? 'selected' : '' }}>
                                {{ $utility->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price" class="form-label">Giá</label>
                    <input type="text" id="price" name="price" class="form-control" placeholder="Nhập giá (ví dụ: 100.000đ, Miễn phí...)" />
                </div>
                <div class="form-group">
                    <label for="opening_hours" class="form-label">Giờ phục vụ</label>
                    <input type="text" id="opening_hours" name="opening_hours" class="form-control" placeholder="Nhập giờ phục vụ (ví dụ: 8:00 - 22:00)" />
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="number" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại liên hệ" />
                </div>
                <button type="submit" class="btn-submit">Đăng tiện ích</button>
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
        {{-- FORM ĐĂNG BÀI ĐỊA ĐIỂM DU LỊCH --}}
        <section class="submit-section" id="submit-section-destination">
            <h2>Đăng bài chia sẻ của bạn</h2>
            <form class="submit-form" method="POST" action="{{ route('post_articles.store') }}">
                @csrf
                <input type="hidden" name="post_type" value="destination">
                <div class="form-group">
                    <label for="title" class="form-label">Tiêu đề bài viết</label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Tiêu đề bài viết" required />
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">Nội dung bài viết</label>
                    <textarea id="content" name="content" class="form-control" rows="6" placeholder="Nội dung bài viết ngắn gọn..." ></textarea>
                </div>

                <div class="form-group">
                    <label for="location" class="form-label">Địa điểm</label>
                    <select id="location" name="location" class="form-control" required disabled>
                        <option value="">Chọn địa điểm</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->id }}"
                                {{ (isset($selectedDestination) && $selectedDestination == $destination->id) ? 'selected' : '' }}>
                                {{ $destination->name }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label for="cost" class="form-label">Chi phí</label>
                    <input type="text" id="cost" name="cost" class="form-control" placeholder="Chi phí (ví dụ: Miễn phí, 1-3 triệu...)" />
                </div>

                <button type="submit" class="btn-submit">Đăng bài</button>
            </form>
        </section>
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor.create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}'
                },
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'underline', 'strikethrough', 'link', '|',
                    'alignment', '|', 'bulletedList', 'numberedList', '|', 'indent', 'outdent', '|',
                    'imageUpload', 'blockQuote', 'insertTable', '|', 'mediaEmbed', 'undo', 'redo', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|', 'highlight'
                ],
                image: {
                    toolbar: [
                        'imageTextAlternative', 'imageStyle:full', 'imageStyle:side'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn', 'tableRow', 'mergeTableCells'
                    ]
                }
            })
            .catch(error => {
                console.error('CKEditor error:', error);
            });

            document.querySelector("form").addEventListener("submit", function (e) {
                // Sử dụng instance của CKEditor 5
                const content = editorInstance.getData();
                if (content.trim() === "") {
                    e.preventDefault();
                    alert("Vui lòng nhập nội dung bài viết.");
                }
            });
        </script>
    @endif
</div>
@endsection