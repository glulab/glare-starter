<div class="content-block content-block-columns-two">
    <div class="row">
        <div class="col-12 col-md-6 column column-left">
            <x-site.line-splitter class="title" :text="$rep->left_title"/>
            <div class="text">{!! $rep->left_text !!}</div>
        </div>
        <div class="col-12 col-md-6 column column-right">

            <x-site.line-splitter class="title" :text="$rep->right_title"/>
            <div class="text">{!! $rep->right_text !!}</div>
        </div>
    </div>
</div>
