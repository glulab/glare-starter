@extends('layouts.app')

@php
$seoTitle = !empty($page->meta_title) ? $page->meta_title : ($page->title . ' | ' . $settings->site_name);
$seoDescription = !empty($page->meta_description) ? $page->meta_description : (!empty($page->description) ? $page->description : '');
$seoUrl = $page->urlByType;
$seoImage = optional(optional($page)->image)->getUrl('preview') ?? optional(optional(optional(optional(optional(head($products))['items'])[0])->pictures)->first())->getUrl('preview');
@endphp

@section('content')

    <h1 class="page-title">{!! $page->title !!}</h1>
    <x-site.format-model :model="$page" :nl2br="false"/>{{-- <x-site.format-page :text="$page->text" :images="$page->images" :nl2br="false"/> --}}

    @include('blocks.page-offer-products', ['products' => $products])

@endsection

<x-site.page-is-active :page="$page"/>
