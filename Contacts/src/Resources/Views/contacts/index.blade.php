{{-- pageHeader --}}
@section('pageHeader')
<div id="breadcrumbHolder">
    <div class="page-header page-header-block2">
        <div class="page-header-section">
            <!-- Toolbar -->
            <div class="toolbar2 col-md-8">
                @yield('breadcrumbs')
            </div>
            <!--/ Toolbar -->
            <!-- Toolbar -->
            <div class="toolbar col-md-4">
                @yield('languagesSelector')
            </div>
            <!--/ Toolbar -->
        </div>
    </div>
</div>
<div id="pageHeaderHolder">
    <!-- Page Header -->
    <div class="page-header page-header-block">
        <div class="page-header-section">
            <!-- Toolbar -->
            <div class="toolbar2 pl15">
                <h4 class="title semibold">{{$title}}</h4>
            </div>
            <!--/ Toolbar -->
        </div>
        <div class="page-header-section">
            <!-- Toolbar -->
            <div class="toolbar right">
                <a href="javascript:void(0)" class="btn btn-default" id="btnBack"><i class="ico-long-arrow-left"></i> {{trans('admin/global.Back')}}</a>
                @if(Auth::user()->can('contacts_create') || Auth::user()->can('contacts_manage'))
                <a href="{{$routes['export']}}" class="btn btn-success btnAdd" ><i class="ico-plus"></i> Export</a>
                @endif
            </div>
            <!--/ Toolbar -->
        </div>
    </div>
    <!-- Page Header -->
</div>
@stop

{{-- Content --}}
@section('content')
<div class="row">
    <div class="col-md-12">
        {!! Notification::showSuccess() !!}
        {!! Notification::showError() !!}
    </div>
    <div class="col-md-12">
        <div id="mainPanel">
            <div id="filterHolder"></div>
            <!-- panel toolbar wrapper -->
            <div class="panel panel-default">
            <div class="panel-heading pl0 pt10 pb10">
                <div class="panel-toolbar pl10">
                    <div class="checkbox custom-checkbox pull-left">
                        <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#table1">
                        <label for="customcheckbox-one0">&nbsp;&nbsp;{{trans('admin/global.Select all')}}</label>
                    </div>
                </div>
                <div class="panel-toolbar pl10">
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Plus <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:void(0);" id="btnBatchPublish">{{trans('admin/global.Publish')}}</a></li>
                            <li><a href="javascript:void(0);" id="btnBatchUnPublish">{{trans('admin/global.Unpublish')}}</a></li>
                        </ul>
                    </div>
                    @if(Auth::user()->can('contacts_delete') || Auth::user()->can('contacts_manage'))
                    <a class="btn btn-danger" id="btnDeleteMultiModals" href="javascript:void(0);">
                        <i class="fa fa-trash-o fa-lg"></i> {{trans('admin/global.Delete')}}
                    </a>
                    @endif
                </div>

                </div>
                <div class="clearfix"></div>
            </div>

            <!--/ panel toolbar wrapper -->
            <div id="listHolder"></div>
            <!-- panel toolbar wrapper -->
            <div class="panel-toolbar-wrapper pl0 pt5 pb5">
                <div class="clearfix mb5"></div>
                <div class="col-sm-12">
                    <div class="panel-toolbar">
                        <div class="panel-toolbar pull-right">
                            {!! $models->appends(array('sortBy' => Input::get('sortBy','id'),'sortDirection' => Input::get('sortDirection','desc'),'limit' => Input::get('limit',10)))->render() !!}
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!--/ panel toolbar wrapper -->
             </div>
            <div id="deleteModalHolder"></div>
            <div id="quickEditModalHolder"></div>
        </div>
    </div>
</div>
@stop

{{-- Templates --}}
@section('templates')
@include('contacts.tpl.list')
@include('contacts.tpl.modals.delete')
@include('contacts.tpl.modals.quickEdit')
@stop

{{-- Scripts --}}
@section('scripts')
<script type="text/javascript" src="assets/admin/js/modules/contacts.js"></script>
<script type="text/javascript">
    $(function () {
        // custom select
        // ================================
    });
</script>
@stop