<div class="block-contact is-basic {!! $class ?? 'in-footer' !!}">
    @if(!empty($settings->site_phone))<div class="site-phone"><span class="prefix">tel.:</span> <a itemprop="telephone" href="tel:{!! str_replace(' ', '', $settings->site_phone) !!}">{!! $settings->site_phone !!}</a></div>@endif
    @if(!empty($settings->site_email))<div class="site-email"><span class="prefix">e-mail:</span> <a itemprop="email" href="mailto:{!! $settings->site_email !!}">{!! $settings->site_email !!}</a></div>@endif
</div>
