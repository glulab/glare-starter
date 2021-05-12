@extends('page.show')

@section('content')

    <div class="page-title">{!! $page->title !!}</div>
    <x-site.format-model class="page-text" :model="$page" :nl2br="false"/>{{-- <x-site.format-page :text="$page->text" :images="$page->images" :nl2br="false"/> --}}
    <x-site.galleries :feed="$page->galleries"/>

    <x-site.gallery-index :title="$page->title"/>

@endsection
