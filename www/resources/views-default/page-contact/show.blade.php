@extends('page.show')

@section('content')

    <div class="page-title">{!! $page->title !!}</div>
    <x-site.line-splitter class="page-description" :text="$page->description ?? ''"/>
    <x-site.format-model class="page-text" :model="$page" :nl2br="false"/>{{-- <x-site.format-page :text="$page->text" :images="$page->images" :nl2br="false"/> --}}
    <x-site.contact-full class="in-contact"/>
    <x-site.galleries :feed="$page->galleries"/>

@endsection

@section('bottom-fluid')
    <x-site.contact-form/>
@endsection
