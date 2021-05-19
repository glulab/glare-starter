<div class="row justify-content-md-around my-5" itemscope itemtype="https://schema.org/Organization">
    <div class="col-12 col-md-4 mb-5">
        <div class="contact-address d-flex flex-column align-items-center text-center">
            <img class="mb-3 icon icon-address" src="{!! asset('images/icons/page-contact/address.png') !!}" alt="">
            <div class="address">
                {{-- <div class="logo in-address"><img itemprop="image" src="{!! asset('images/logo.png') !!}" alt="logo" /></div> --}}
                @if(!empty($settings->site_address_name))<div itemprop="name" class="site-address-name">{!! nl2br($settings->site_address_name) !!}</div>@endif
                @if(!empty($settings->site_address_description))<div class="site-address-description" itemprop="description">{!! nl2br($settings->site_address_description) !!}</div>@endif
                <div class="site-address" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                    @if(!empty($settings->site_address_street))<div class="site-address-street" itemprop="streetAddress">{!! $settings->site_address_street !!}</div>@endif
                    @if(!empty($settings->site_address_code) || !empty($settings->site_address_city))
                        <div class="site-address-code-and-city">
                            @if(!empty($settings->site_address_code))<span class="site-address-code" itemprop="postalCode">{!! $settings->site_address_code !!}</span>@endif
                            @if(!empty($settings->site_address_city))<span class="site-address-city" itemprop="addressLocality">{!! $settings->site_address_city !!}</span>@endif
                        </div>
                    @endif
                    @if(!empty($settings->site_address_region))<div class="site-address-region" itemprop="addressRegion">{!! $settings->site_address_region !!}</div>@endif
                    @if(!empty($settings->site_address_info))<div class="site-address-info">{!! nl2br($settings->site_address_info) !!}</div>@endif
                </div>
                <div class="company">
                    @if(!empty($settings->bank_account))
                    <div class="bank">
                        @if(!empty($settings->bank_name))<span class="bank-name">{!! $settings->bank_name !!}:</span>@endif @if(!empty($settings->bank_account))<span class="bank-account">{!! $settings->bank_account !!}</span>@endif
                    </div>
                    @endif
                    @if(!empty($settings->tax_number))<div class="tax-number"><span class="item-key">{!! __('keys.tax_number') !!}:</span>&nbsp;<span class="item-value">{!! $settings->tax_number !!}</span></div>@endif
                    @if(!empty($settings->company_id))<div class="company-id"><span class="item-key">{!! __('keys.company_id') !!}:</span>&nbsp;<span class="item-value">{!! $settings->company_id !!}</span></div>@endif
                    @if(!empty($settings->national_court_register))<div class="national-court-register"><span class="item-key">{!! __('keys.national_court_register') !!}:</span>&nbsp;<span class="item-value">{!! $settings->national_court_register !!}</span></div>@endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 mb-5">
        <div class="contact-telephone d-flex flex-column align-items-center text-center">
            <img class="mb-3 icon icon-address" src="{!! asset('images/icons/page-contact/telephone.png') !!}" alt="">
            <div class="contact contact-telephone">
                @if(!empty($settings->site_telephone))<div class="site-telephone"><span class="item-key">{!! __('keys.telephone') !!}:</span>&nbsp;<a class="item-value" itemprop="telephone" href="tel:{!! str_replace(' ', '', $settings->site_telephone) !!}">{!! $settings->site_telephone !!}</a></div>@endif
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 mb-5">
        <div class="contact-email d-flex flex-column align-items-center text-center">
            <img class="mb-3 icon icon-address" src="{!! asset('images/icons/page-contact/email.png') !!}" alt="">
            <div class="contact contact-email">
                @if(!empty($settings->site_email))<div class="site-email"><span class="item-key">{!! __('keys.email') !!}:</span> <a class="item-value" itemprop="email" href="mailto:{!! $settings->site_email !!}">{!! $settings->site_email !!}</a></div>@endif
            </div>
        </div>
    </div>
</div>
