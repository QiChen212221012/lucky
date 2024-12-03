<x-app-layout>
    <div class="container my-5 form-container">
        <!-- 表单标题 -->
        <h1 class="text-center mb-4 form-title">
            <i class="fas fa-book"></i> Create a New Blog Post
        </h1>

        <!-- 错误提示框 -->
        @if ($errors->any())
            <div class="alert alert-danger error-box">
                <i class="fas fa-exclamation-circle"></i>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 表单 -->
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- 标题 -->
            <div class="form-group">
                <label for="title">Title</label>
                <div class="input-with-icon">
                    <i class="fas fa-heading"></i>
                    <input type="text" id="title" name="title" placeholder="Enter the title here..." value="{{ old('title') }}" required>
                </div>
            </div>

            <!-- 内容 -->
            <div class="form-group">
                <label for="content">Content</label>
                <div class="input-with-icon">
                    <i class="fas fa-pen"></i>
                    <textarea id="content" name="content" rows="6" placeholder="Write your content here..." required>{{ old('content') }}</textarea>
                </div>
            </div>

            <!-- 标签选择（Tag Cloud） -->
            <div class="form-group">
                <label for="tags">Tags</label>
                <div class="tags-container">
                    @foreach ($tags as $tag)
                        <span class="tag" data-tag-id="{{ $tag->id }}">{{ $tag->name }}</span>
                    @endforeach
                    <input type="hidden" name="tags" id="selected-tags" value="">
                </div>
            </div>

            <!-- 图片上传 -->
            <div class="form-group">
                <label for="images">Upload Images (optional)</label>
                <input type="file" id="images" name="images[]" multiple>
                <div id="selected-files" class="selected-files"></div>
            </div>

            <!-- 提交按钮 -->
            <div class="text-center">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-rocket"></i> Submit
                </button>
            </div>
        </form>
    </div>

    <style>
        /* 图片上传输入框样式 */
        input[type="file"] {
            border: 2px solid #cce7ff;
            border-radius: 8px;
            padding: 8px;
            font-size: 1rem;
            width: 100%;
            transition: border-color 0.3s ease;
        }

        input[type="file"]:focus {
            border-color: #00bfa5;
            outline: none;
        }

        /* 已选择文件名展示容器 */
        .selected-files {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #333;
        }

        .selected-files span {
            display: block;
            padding: 5px;
            border-bottom: 1px solid #eee;
        }

        /* 标签样式 */
        .tag {
            display: inline-block;
            margin: 5px;
            padding: 5px 10px;
            background-color: #e0f7fa;
            color: #00796b;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .tag:hover {
            background-color: #80deea;
        }

        .tag.selected {
            background-color: #00bfa5;
            color: #ffffff;
        }

        /* 提交按钮样式 */
        .btn-submit {
            background-color: #00796b;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #004d40;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 标签选择逻辑
            const tags = document.querySelectorAll('.tag'); // 获取所有标签元素
            const selectedTagsInput = document.getElementById('selected-tags'); // 获取隐藏的输入框

            tags.forEach(tag => {
                tag.addEventListener('click', function () {
                    this.classList.toggle('selected'); // 切换选中样式
                    updateSelectedTags(); // 更新隐藏输入框的值
                });
            });

            function updateSelectedTags() {
                const selectedTags = Array.from(document.querySelectorAll('.tag.selected')) // 筛选出选中的标签
                    .map(tag => tag.dataset.tagId); // 获取每个选中标签的 data-tag-id
                selectedTagsInput.value = selectedTags.join(','); // 将选中标签ID拼接成字符串
            }

            // 图片上传逻辑
            const imagesInput = document.getElementById('images');
            const selectedFilesContainer = document.getElementById('selected-files');

            imagesInput.addEventListener('change', function () {
                selectedFilesContainer.innerHTML = ''; // 清空之前的文件列表
                Array.from(this.files).forEach(file => {
                    const fileNameElement = document.createElement('span');
                    fileNameElement.textContent = file.name;
                    selectedFilesContainer.appendChild(fileNameElement);
                });
            });
        });
    </script>
</x-app-layout>
