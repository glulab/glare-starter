@extends('page.show')

@section('content')

    <x-site.page-title :page="$page" class="page-title"/>
    <x-site.line-splitter class="page-description" :text="$page->description ?? ''"/>
    <x-site.format-model class="page-text" :model="$page" :nl2br="false"/>
    <x-site.contact-full class="in-contact"/>
    <x-site.galleries :feed="$page->galleries"/>

@endsection

@section('bottom-fluid')
    <x-site.contact-form/>
@endsection
