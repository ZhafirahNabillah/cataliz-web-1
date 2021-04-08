@extends('layouts.layoutVerticalMenu')

@section('title','Documentations')

@section('content')

  @include('panels.navbar')
  @include('panels.sidemenuDocs')
  <div class="app-content content ">
    <div class="content-wrapper">
        <!-- Vertical Tabs start -->
        <section id="vertical-tabs">
          <div class="row match-height">
            <!-- Vertical Left Tabs start -->

            @if ($documentations->isEmpty())
              <span>{{ $active_category }} Documentation not yet available</span>
            @else
              <div class="Col-sm-12 col-md-12">
                <div class="nav-vertical">
                  <ul class="nav nav-tabs nav-left flex-column col-sm-12 col-md-2" role="tablist">
                    @foreach ($documentations as $documentation)
                      <li class="nav-item">
                        <a class="nav-link @if ($loop->first) active @endif" id="{{ $documentation->id }}-tab" data-toggle="tab" href="#{{ $documentation->category.'-'.$documentation->id }}" role="tab"
                          >{{ ucfirst($documentation->title) }}</a>
                        </li>
                      @endforeach
                    </ul>
                    <div class="card col-sm-12 col-md-auto">
                      <div class="card-body">
                        <div class="tab-content">
                          @foreach ($documentations as $documentation)
                            <div class="tab-pane @if ($loop->first) active @endif" id="{{ $documentation->category.'-'.$documentation->id }}" aria-labelledby="coach-tab" role="tabpanel">
                              {!! $documentation->description !!}
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            @endif

            <!-- Vertical Left Tabs ends -->
          </div>
        </section>
    </div>
  </div>

@endsection
