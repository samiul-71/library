<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        {{--<meta name="author" content="@yield('meta_author', 'Anthony Rappa')">--}}
        <meta name="author" content="">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        @langRTL
            {{ Html::style(getRtlCss(mix('css/backend.css'))) }}
        @else
            {{ Html::style(mix('css/backend.css')) }}
        @endif

        {{ Html::style('plugins/DataTables/datatables.min.css') }}

        {{--{{ Html::script('https://code.jquery.com/jquery-1.12.4.min.js') }}--}}
        {{ Html::style('plugins/MultiSelect/jquery.dropdown.css') }}
        {{ Html::script('plugins/MultiSelect/jquery.dropdown.js') }}


        {{--<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>--}}

        {{--<script src="/public/plugins/MultiSelect/jquery.dropdown.js"></script>--}}

        <!-- Select2 Style added here -->
        {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css') }}

        @yield('after-styles')

        <!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        {{ Html::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
        {{ Html::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}
        <![endif]-->

        {{ Html::script('https://code.jquery.com/jquery-3.2.1.js') }}
        {{ Html::script('https://code.jquery.com/jquery-3.2.1.min.js') }}


        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
        </script>
    </head>
    <body class="skin-{{ config('backend.theme') }} {{ config('backend.layout') }}">
        @include('includes.partials.logged-in-as')

        <div class="wrapper">
            @include('backend.includes.header')
            @include('backend.includes.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('page-header')

                    {{-- Change to Breadcrumbs::render() if you want it to error to remind you to create the breadcrumbs for the given route --}}
                    {!! Breadcrumbs::renderIfExists() !!}
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="loader" style="display: none;">
                        <div class="ajax-spinner ajax-skeleton"></div>
                    </div><!--loader-->

                    @include('includes.partials.messages')
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            @include('backend.includes.footer')
        </div><!-- ./wrapper -->

        <!-- JavaScripts -->
        @yield('before-scripts')
        {{ Html::script(mix('js/backend.js')) }}
        {{ Html::script('plugins/DataTables/datatables.min.js') }}

        <!-- Select2 Script added here -->
        {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js') }}

        @yield('after-scripts')
    </body>
</html>