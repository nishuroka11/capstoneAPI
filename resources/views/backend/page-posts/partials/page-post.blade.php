@if(!empty($pagePost))
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <p><b>Name:</b> {{$pagePost->page_post_name}}</p>
            </div>
            <div class="col-md-6">
                <p><b>Slug:</b> {{$pagePost->page_post_slug}}</p>
            </div>
            <div class="col-md-12">
                <p><b>Description:</b> {!! $pagePost->page_post_description !!}</p>
            </div>
        </div>
    </div>
@endif
