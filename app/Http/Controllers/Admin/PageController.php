<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::withCount('sections')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        $page->load('sections');
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $page->update($validated);

        return redirect()->back()
            ->with('success', 'Page updated successfully.');
    }

    public function storeSection(Request $request, Page $page)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:hero,text,image,cta,featured_products,contact_info',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $page->sections()->max('order') + 1;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('pages', 'public');
        }

        $page->sections()->create($validated);

        return redirect()->back()
            ->with('success', 'Section added successfully.');
    }

    public function updateSection(Request $request, PageSection $section)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($section->image) {
                Storage::disk('public')->delete($section->image);
            }
            $validated['image'] = $request->file('image')->store('pages', 'public');
        }

        $section->update($validated);

        return redirect()->back()
            ->with('success', 'Section updated successfully.');
    }

    public function destroySection(PageSection $section)
    {
        if ($section->image) {
            Storage::disk('public')->delete($section->image);
        }

        $section->delete();

        return redirect()->back()
            ->with('success', 'Section deleted successfully.');
    }

    public function reorderSections(Request $request, Page $page)
    {
        $validated = $request->validate([
            'sections' => 'required|array',
            'sections.*' => 'integer|exists:page_sections,id',
        ]);

        foreach ($validated['sections'] as $order => $sectionId) {
            PageSection::where('id', $sectionId)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }
}
