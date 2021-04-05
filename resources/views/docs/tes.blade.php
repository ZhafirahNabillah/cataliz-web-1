@extends('layouts.layoutVerticalMenu')

@section('title','Home')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')

<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-header row"></div>
        <div class="content-body">
            <section class="navbar">
                <div class="dropdown">
                    <label for="fp-default">Versions</label>
                    <select class="form-control" aria-label=".form-select-lg example" name="session">
                        <option selected value hidden>Select versions</option>
                        <option value="1.0">1.0</option>
                        <option value="2.0">2.0</option>
                        <option value="3.0">3.0</option>
                    </select>
                </div>
            </section>
            <section class="sidebar-left"></section>
            <section class="sidebar-right"></section>
            <section class="main">
                <div>
                    <form action="" method="post">
                        <div class="form-group">
                            <textarea name="" id="MyID" cols="30" rows="10"
                                placeholder="Input Your Docs Here....."></textarea>
                            <Button type="submit" class="btn btn-primary">Submit</Button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        @push('scripts')

        <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
        <script type="text/javascript">
            var simplemde = new SimpleMDE({
                element: document.getElementById('MyID'),
                initialValue: '## Stuff.... '
                });
        </script>
        @endpush