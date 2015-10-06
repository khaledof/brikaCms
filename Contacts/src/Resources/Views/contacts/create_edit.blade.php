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
            <div class="toolbar2">
                <h4 class="title semibold">
                    @if($action == 'add')
                        {{trans('moduleGroups::global.New')}}
                    @elseif($action == 'edit')
                        @if($action=='edit' && $model){!!$model->name!!}@endif
                    @endif
                </h4>
            </div>
            <!--/ Toolbar -->
        </div>
        <div class="page-header-section">
            <!-- Toolbar -->
            <div class="toolbar right">
                <a href="javascript:void(0)" class="btn btn-default" id="btnBack"><i class="ico-long-arrow-left"></i> {{trans('admin/global.Back')}}</a>
                <a href="javascript:void(0)" onclick="$('#addEditForm').submit();" class="btn btn-primary  btnSave ladda-button" data-style="expand-left"><i class="ico-save"></i> {{trans('admin/global.Save')}}</a>
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
    <div id="mainAddEditPanel">
        <div class="row">
            <div class="col-md-12">
                {!! Notification::showSuccess() !!}
                {!! Notification::showError() !!}
                @if ($errors->has())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                    @endforeach
                </div>
                @endif
            </div>
            <!-- START Left Side -->
            <div class="col-md-12">
                <form name="addEditForm" id="addEditForm" class="form-horizontal form-bordered" action="{{$uriModule}}" method="post">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                <div class="col-md-12"><h5>Nom du Groupe</h5></div>
                                <div class="col-md-12">
                                    <div class="mb10">
                                        <input type="text" class="form-control input-lg" name="name" id="name" value="@if($action=='edit' && $model){{$model->name}}@else{{Input::old('name')}}@endif">
                                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <div class="col-md-12"><h5>Description</h5></div>
                                <div class="col-md-12">
                                    <div class="mb10">
                                        <textarea class="form-control" name="description" id="description" rows="5">@if($action=='edit' && $model){{$model->description}}@else{{Input::old('description')}}@endif</textarea>
                                        @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>
                </form>
                <!--/ END form panel -->
            </div>
            <!--/ END Left Side -->
        </div>
        </div>
    </div>
</div>
</div>
@stop

{{-- Templates --}}
@section('templates')
@stop

{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
    $(function () {

    });
</script>
@stop
