{{--This is only included for backwards compatibility. It will be removed at a future stage.--}}
@if (config('hessam.search.search_enabled') )
    @include('hessam::sitewide.search_form')
@endif