@extends('backend/layout')
@section('content')
<section class="content-header">
    <h1>Company</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ $company->page_title }}</li>
    </ol>
</section>
<!-- Main content -->
<section id="main-content" class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $company->page_title }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{ Form::open(array('route' => $company->form_action, 'method' => 'POST', 'files' => true, 'id' => 'user-form')) }}
                    {{ Form::hidden('id', $company->id, array('id' => 'company_id')) }}
                    <div id="form-companyname" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Name</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            @if($company->page_type == 'create')
                            {{ Form::text('name', $company->name, array('class' => 'form-control validate[required, regex[/^[\w-]*$/], alpha_num, maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                            @else
                            {{ Form::text('name', $company->name, array('readonly' => 'readonly', 'class' => 'form-control validate[required, regex[/^[\w-]*$/], alpha_num, maxSize[255]]')) }}
                            @endif
                        </div>
                    </div>

                    <div id="form-display-name" class="form-group {{ $company->page_type == 'edit'?'hide':'' }}">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Email</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('email', $company->email, array('placeholder' => '', 'class' => 'form-control validate[required, maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    <div id="app">
                        <div id="form-display-name" class="form-group {{ $company->page_type == 'edit'?'hide':'' }}">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                <span class="label label-danger label-required">Required</span>
                                <strong class="field-title">Postcode</strong>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                {{ Form::text('postcode', $company->postcode, array('v-model'=>"postcode",'placeholder' => '', 'class' => 'form-control validate[required, maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                            <button type="button" @click="onClick" class="btn btn-primary">search</button>
                            </div>
                        </div>

                        <div id="form-display-name" class="form-group {{ $company->page_type == 'edit'?'hide':'' }}">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                <span class="label label-danger label-required">Required</span>
                                <strong class="field-title">Prefecture</strong>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                {{ Form::text('prefecture', $company->prefecture, array('placeholder' => '', 'class' => 'form-control validate[required, maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11','v-model'=>"prefecture")) }}
                            </div>
                        </div>

                        <div id="form-display-name" class="form-group {{ $company->page_type == 'edit'?'hide':'' }}">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                <span class="label label-danger label-required">Required</span>
                                <strong class="field-title">City</strong>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content" >
                                {{ Form::text('city', $company->city, array('placeholder' => '', 'class' => 'form-control validate[required, maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11', 'v-model'=>"city")) }}
                            </div>
                        </div>

                        <div id="form-display-name" class="form-group {{ $company->page_type == 'edit'?'hide':'' }}">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                                <span class="label label-danger label-required">Required</span>
                                <strong class="field-title">Local</strong>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                                {{ Form::text('local', $company->local, array('placeholder' => '', 'class' => 'form-control validate[required, maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11', 'v-model'=>"local")) }}
                            </div>
                        </div>
                    </div>


                    <div id="form-display-name" class="form-group {{ $company->page_type == 'edit'?'hide':'' }}">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Street address</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('street_address', $company->street_address, array('placeholder' => '', 'class' => 'form-control validate[ maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                      <div id="form-display-name" class="form-group {{ $company->page_type == 'edit'?'hide':'' }}">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Business Hour</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('business_hour', $company->business_hour, array('placeholder' => '', 'class' => 'form-control validate[maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                      <div id="form-display-name" class="form-group {{ $company->page_type == 'edit'?'hide':'' }}">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Regular Holiday</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('regular_holiday', $company->regular_holiday, array('placeholder' => '', 'class' => 'form-control validate[maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                      <div id="form-display-name" class="form-group {{ $company->page_type == 'edit'?'hide':'' }}">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Phone</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('phone', $company->phone, array('placeholder' => '', 'class' => 'form-control validate[maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                      <div id="form-display-name" class="form-group {{ $company->page_type == 'edit'?'hide':'' }}">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">Fax</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('fax', $company->fax, array('placeholder' => '', 'class' => 'form-control validate[maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                      <div id="form-display-name" class="form-group {{ $company->page_type == 'edit'?'hide':'' }}">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">URL</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('url', $company->url, array('placeholder' => '', 'class' => 'form-control validate[maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                      <div id="form-display-name" class="form-group {{ $company->page_type == 'edit'?'hide':'' }}">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <strong class="field-title">License Number</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::text('license_number', $company->license_number, array('placeholder' => '', 'class' => 'form-control validate[maxSize[100]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>

                    {{-- パスワード --}}
                    {{-- @if($company->page_type == 'create')
                    <div id="form-password" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <strong class="field-title">Password</strong>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-content">
                            {{ Form::password('password', array('placeholder' => ' ', 'class' => 'form-control validate[required, minSize[6], maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11')) }}
                        </div>
                    </div>
                    @else
                    <div id="form-password-confirm" class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-header">
                            <span class="label label-danger label-required">Required</span>
                            <i class="fa fa-question-circle tooltip-img" data-toggle="tooltip" data-placement="right" title="Please input only when changing the password."></i>
                            <strong class="field-title">Password</strong>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-1 col-lg-1 col-content">
                            <button type="button" name="reset" id="reset-button" class="btn btn-primary">Change</button>
                        </div>
                        <div id="reset-field" class="col-xs-10 col-sm-10 col-md-8 col-lg-9 col-content hide">
                            {{ Form::password('password', array('id' => 'password', 'placeholder' => 'Please input only when changing password', 'class' => 'form-control validate[minSize[6], maxSize[255]]', 'data-prompt-position' => 'bottomLeft:0,11', 'style' => 'margin-top:5px')) }}
                            <label for="show-password"><input id="show-password" type="checkbox" name="show-password" value="1"> Show Password</label>
                        </div>
                    </div>
                    @endif --}}

                    <div id="form-button" class="form-group no-border">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top: 20px;">
                            <button type="submit" name="submit" id="send" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script>

    new Vue({
        el: '#app',
        data: {
            postcode: '',
            prefecture: '',
            city: '',
            local: '',
        },
        methods: {
            onClick: function() {

                const url = '/ajax/postal_search?'+ [
                    'postcode='+ this.postcode,
                ];

                axios.get(url).then((response) => {

                    this.prefecture = response.data.prefecture;
                    this.city = response.data.city;
                    this.local = response.data.local;
                });

            }
        }
    });

</script>
@endsection

@section('title', 'User | ' . env('APP_NAME',''))

@section('body-class', 'custom-select')

@section('css-scripts')
@endsection

@section('js-scripts')
<script src="{{ asset('bower_components/bootstrap/js/tooltip.js') }}"></script>
<!-- validationEngine -->
<script src="{{ asset('js/3rdparty/validation-engine/jquery.validationEngine-en.js') }}"></script>
<script src="{{ asset('js/3rdparty/validation-engine/jquery.validationEngine.js') }}"></script>
<script src="{{ asset('js/backend/users/form.js') }}"></script>
@endsection
