@extends('page.show')

@section('content')

    <h1 class="page-title">{!! $page->title !!}</h1>
    <x-site.format-model class="page-text" :model="$page" :nl2br="false"/>{{-- <x-site.format-page :text="$page->text" :images="$page->images" :nl2br="false"/> --}}
    <x-site.galleries :feed="$page->galleries"/>
    {{-- @include('blocks.page-offer-products', ['products' => $products]) --}}

@endsection

<x-site.page-is-active :page="$page"/>
