@extends('page.show')

@section('content')

    <x-site.breadcrumb-array :segments="['home', 'route|gallery.index', 'basic|' . $gallery->title]" :page="$page"/>
    <x-site.page-title :page="['title' => $gallery->title, 'title_tag' => 'div']" class="page-title" {{-- :prefix="['a' => ['text' => $page->title, 'href' => route('gallery.index')]]" --}}/>
    <x-site.format-model class="page-text" :model="$page" :nl2br="false"/>
    <x-site.galleries :feed="$page->galleries"/>

    <div class="galleries">
        <x-site.gallery :gallery="$gallery" :class="$class ?? ''"/>
    </div>

@endsection
