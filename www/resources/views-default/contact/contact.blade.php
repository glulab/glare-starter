@extends('layouts.app')

@php
$seoTitle = !empty($page->meta_title) ? $page->meta_title : ($page->title . ' | ' . $settings->site_name);
$seoDescription = !empty($page->meta_description) ? $page->meta_description : (!empty($page->description) ? $page->description : '');
$seoUrl = $page->urlByType;
$seoImage = optional(optional($page)->image)->getUrl('preview');
@endphp

@section('content')
    <div class="page-title">{!! $page->title !!}</div>
    <x-site.format-page :text="$page->text" :images="$page->images" :nl2br="false"/>

    <div class="address" itemscope itemtype="https://schema.org/Organization">
        <div class="logo in-address"><img itemprop="image" src="{!! asset('images/logo.png') !!}" alt="logo" /></div>
        @if(!empty($settings->site_address_name))<div itemprop="name" class="site-address-name">{!! str_replace(['|', ' | '], '<br>', $settings->site_address_name) !!}</div>@endif
        @if(!empty($settings->site_address_description))<div class="site-address-description" itemprop="description">{!! $settings->site_address_description !!}</div>@endif
        <div class="site-address" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
            @if(!empty($settings->site_address_street))<div class="site-address-street" itemprop="streetAddress">{!! $settings->site_address_street !!}</div>@endif
            @if(!empty($settings->site_address_code) || !empty($settings->site_address_city))
                <div class="site-address-code-and-city">
                    @if(!empty($settings->site_address_code))<span class="site-address-code" itemprop="postalCode">{!! $settings->site_address_code !!}</span>@endif
                    @if(!empty($settings->site_address_city))<span class="site-address-city" itemprop="addressLocality">{!! $settings->site_address_city !!}</span>@endif
                </div>
            @endif
            @if(!empty($settings->site_address_region))<div class="site-address-region" itemprop="addressRegion">{!! $settings->site_address_region !!}</div>@endif
            @if(!empty($settings->site_address_info))<div class="site-address-info">{!! $settings->site_address_info !!}</div>@endif
        </div>
        @if(!empty($settings->site_phone))<div class="site-phone"><span class="prefix">tel.:</span> <a itemprop="telephone" href="tel:{!! str_replace(' ', '', $settings->site_phone) !!}">{!! $settings->site_phone !!}</a></div>@endif
        @if(!empty($settings->site_phone_1))<div class="site-phone-2"><span class="prefix">tel.:</span> <a itemprop="telephone" href="tel:{!! str_replace(' ', '', $settings->site_phone_1) !!}">{!! $settings->site_phone_1 !!}</a></div>@endif
        @if(!empty($settings->site_email))<div class="site-email"><span class="prefix">e-mail:</span> <a itemprop="email" href="mailto:{!! $settings->site_email !!}">{!! $settings->site_email !!}</a></div>@endif
        @if(!empty($settings->site_domain))<div class="site-domain"><span class="prefix">www:</span> <a itemprop="url" href="{!! url('/') !!}">{!! $settings->site_domain !!}</a></div>@endif
        @if(!empty($settings->site_contact_info))<div class="site-contact-info">{!! nl2br($settings->site_contact_info) !!}</div>@endif
    </div>

    <div class="company">
        @if(!empty($settings->bank_account))
        <div class="bank">
            @if(!empty($settings->bank_name))<span class="bank-name">{!! $settings->bank_name !!}:</span>@endif @if(!empty($settings->bank_account))<span class="bank-account">{!! $settings->bank_account !!}</span>@endif
        </div>
        @endif
        @if(!empty($settings->tax_number))<div class="tax-number"><span class="prefix">NIP:</span> {!! $settings->tax_number !!}</div>@endif
        @if(!empty($settings->company_id))<div class="company-id"><span class="prefix">REGON:</span> {!! $settings->company_id !!}</div>@endif
        @if(!empty($settings->national_court_register))<div class="national-court-register"><span class="prefix">KRS:</span> {!! $settings->national_court_register !!}</div>@endif
    </div>

@endsection

@section('bottom')
    <x-site.contact-form/>
@endsection
