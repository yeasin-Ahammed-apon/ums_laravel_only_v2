<!-- Content Header (Page header) -->
{{-- superAdmin / admin /list  here is structure given --}}
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $title ?? 'Super admin Pages' }}</h1>
            </div>
            @isset($links)
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @foreach ($links as $link)
                            @if ($link['enable'] === true)
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                            @else
                                <li class="breadcrumb-item active">{{ $link['title'] }}</li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            @endisset

        </div>
    </div><!-- /.container-fluid -->
</section>