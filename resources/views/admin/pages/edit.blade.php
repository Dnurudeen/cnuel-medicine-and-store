@extends('layouts.admin')

@section('title', 'Edit ' . $page->title)
@section('header', 'Edit Page: ' . $page->title)

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Page Settings -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Page Settings</h2>

                <form action="{{ route('admin.pages.update', $page) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Page Title</label>
                            <input type="text" name="title" id="title" value="{{ $page->title }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>

                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">Meta
                                Description</label>
                            <textarea name="meta_description" id="meta_description" rows="3"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">{{ $page->meta_description }}</textarea>
                        </div>

                        <div>
                            <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-1">Meta
                                Keywords</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" value="{{ $page->meta_keywords }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>

                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ $page->is_active ? 'checked' : '' }}
                                class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-2 text-gray-700">Active</span>
                        </label>

                        <button type="submit"
                            class="w-full bg-primary-500 text-white py-2 rounded-lg hover:bg-primary-600 transition">
                            Save Settings
                        </button>
                    </div>
                </form>

                <hr class="my-6">

                <!-- Add Section -->
                <h3 class="font-semibold text-gray-800 mb-3">Add New Section</h3>
                <form action="{{ route('admin.pages.sections.store', $page) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Section Type</label>
                            <select name="type" id="type" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                                <option value="hero">Hero Banner</option>
                                <option value="text">Text Content</option>
                                <option value="image">Image</option>
                                <option value="cta">Call to Action</option>
                                <option value="featured_products">Featured Products</option>
                                <option value="contact_info">Contact Info</option>
                            </select>
                        </div>

                        <div>
                            <label for="section_title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" name="title" id="section_title"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>

                        <div>
                            <label for="section_content"
                                class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                            <textarea name="content" id="section_content" rows="3"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500"></textarea>
                        </div>

                        <div>
                            <label for="section_image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                            <input type="file" name="image" id="section_image" accept="image/*"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>

                        <div>
                            <label for="button_text" class="block text-sm font-medium text-gray-700 mb-1">Button
                                Text</label>
                            <input type="text" name="button_text" id="button_text"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>

                        <div>
                            <label for="button_link" class="block text-sm font-medium text-gray-700 mb-1">Button
                                Link</label>
                            <input type="text" name="button_link" id="button_link"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>

                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" checked
                                class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-2 text-gray-700">Active</span>
                        </label>

                        <button type="submit"
                            class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-900 transition">
                            <i class="fas fa-plus mr-2"></i> Add Section
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sections -->
        <div class="lg:col-span-2">
            <div class="space-y-4" id="sections-list">
                @forelse($page->sections as $section)
                    <div class="bg-white rounded-lg shadow" data-section-id="{{ $section->id }}">
                        <div class="px-6 py-4 border-b flex justify-between items-center cursor-move">
                            <div class="flex items-center">
                                <i class="fas fa-grip-vertical text-gray-400 mr-3"></i>
                                <span
                                    class="font-medium text-gray-800">{{ ucfirst(str_replace('_', ' ', $section->type)) }}</span>
                                @if ($section->title)
                                    <span class="ml-2 text-gray-500">- {{ $section->title }}</span>
                                @endif
                            </div>
                            <div class="flex items-center space-x-2">
                                @if (!$section->is_active)
                                    <span class="text-xs text-red-500">Hidden</span>
                                @endif
                                <button type="button" onclick="toggleSection({{ $section->id }})"
                                    class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            </div>
                        </div>

                        <div id="section-content-{{ $section->id }}" class="hidden px-6 py-4">
                            <form action="{{ route('admin.sections.update', $section) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                        <input type="text" name="title" value="{{ $section->title }}"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>

                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                                        <textarea name="content" rows="4"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">{{ $section->content }}</textarea>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                                        @if ($section->image)
                                            <img src="{{ asset('storage/' . $section->image) }}" alt=""
                                                class="w-24 h-16 object-cover rounded mb-2">
                                        @endif
                                        <input type="file" name="image" accept="image/*"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                                        <input type="text" name="button_text" value="{{ $section->button_text }}"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Button Link</label>
                                        <input type="text" name="button_link" value="{{ $section->button_link }}"
                                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>

                                    <div class="flex items-center">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="is_active" value="1"
                                                {{ $section->is_active ? 'checked' : '' }}
                                                class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                                            <span class="ml-2 text-gray-700">Active</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-4 flex justify-between">
                                    <button type="submit"
                                        class="bg-primary-500 text-white px-4 py-2 rounded-lg hover:bg-primary-600 transition">
                                        <i class="fas fa-save mr-1"></i> Save
                                    </button>
                                    <button type="button" onclick="deleteSection({{ $section->id }})"
                                        class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </div>
                            </form>

                            <form id="delete-section-{{ $section->id }}"
                                action="{{ route('admin.sections.destroy', $section) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow p-12 text-center">
                        <i class="fas fa-layer-group text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">No sections yet. Add your first section from the sidebar.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.pages.index') }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left mr-2"></i> Back to Pages
        </a>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleSection(id) {
            const content = document.getElementById('section-content-' + id);
            content.classList.toggle('hidden');
        }

        function deleteSection(id) {
            if (confirm('Are you sure you want to delete this section?')) {
                document.getElementById('delete-section-' + id).submit();
            }
        }

        // Drag and drop reordering
        new Sortable(document.getElementById('sections-list'), {
            animation: 150,
            handle: '.cursor-move',
            onEnd: function() {
                const sections = [];
                document.querySelectorAll('#sections-list > div').forEach(el => {
                    if (el.dataset.sectionId) {
                        sections.push(el.dataset.sectionId);
                    }
                });

                fetch('{{ route('admin.pages.sections.reorder', $page) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        sections: sections
                    })
                });
            }
        });
    </script>
@endpush
