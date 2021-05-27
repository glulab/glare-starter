@extends('page.show')

@section('content')

    <x-site.breadcrumb-array :segments="['home', 'route|offer.index', 'page']" :page="$page"/>
    <x-site.page-title :page="$page" class="page-title" {{-- :prefix="['a' => ['text' => __('site::breadcrumbs.offer.index'), 'href' => route('offer.index')]]" --}}/>
    <x-site.format-model class="page-text" :model="$page" :nl2br="false"/>
    <x-site.galleries :feed="$page->galleries"/>
    {{-- @include('blocks.page-offer-products', ['products' => $products]) --}}

@endsection

<x-site.page-is-active :page="$page"/>
