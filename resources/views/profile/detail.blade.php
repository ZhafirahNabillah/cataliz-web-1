@extends('layouts.layoutVerticalMenu')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-profile.css') }}">
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /*custom font*/
    @import url(https://fonts.googleapis.com/css?family=Montserrat);

    /*basic reset*/
    * {
        margin: 0;
        padding: 0;
    }


    body {
        font-family: montserrat, arial, verdana;
        background: transparent;
    }

    h5 {
        text-align: left;
    }

    /*form styles*/
    #msform {
        text-align: center;
        position: relative;
        margin-top: 30px;
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
        padding: 20px 30px;
        box-sizing: border-box;
        width: 80%;
        margin: 0 10%;

        /*stacking fieldsets above each other*/
        position: relative;
    }

    /*Hide all except first fieldset*/
    #msform fieldset:not(:first-of-type) {
        display: none;
    }

    /*inputs*/




    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #ee0979;
        outline-width: 0;
        transition: All 0.5s ease-in;
        -webkit-transition: All 0.5s ease-in;
        -moz-transition: All 0.5s ease-in;
        -o-transition: All 0.5s ease-in;
    }

    /*buttons*/
    #msform .action-button {
        width: 100px;
        background: #ee0979;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 25px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px;
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #ee0979;
    }

    #msform .action-button-previous {
        width: 100px;
        background: #7367F0;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 25px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px;
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #C5C5F1;
    }

    /*headings*/
    .fs-title {
        font-size: 18px;
        text-transform: uppercase;
        color: #2C3E50;
        margin-bottom: 10px;
        letter-spacing: 2px;
        font-weight: bold;
    }

    .fs-subtitle {
        font-weight: normal;
        font-size: 13px;
        color: #666;
        margin-bottom: 20px;
    }

    /*progressbar*/
    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        /*CSS counters to number the steps*/
        counter-reset: step;
    }

    #progressbar li {
        list-style-type: none;
        color: black;
        text-transform: uppercase;
        font-size: 9px;
        width: 12%;
        float: left;
        position: relative;
        letter-spacing: 1px;
    }

    #progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 24px;
        height: 24px;
        line-height: 26px;
        display: block;
        font-size: 12px;
        color: #333;
        background: white;
        border-radius: 25px;
        margin: 0 auto 10px auto;
    }

    /*progressbar connectors*/
    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: white;
        position: absolute;
        left: -50%;
        top: 9px;
        z-index: -1;
        /*put it behind the numbers*/
    }

    #progressbar li:first-child:after {
        /*connector not needed before the first step*/
        content: none;
    }

    /*marking active/completed steps green*/
    /*The number of the step and the connector before it = green*/
    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #7367F0;
        color: white;
    }


    /* Not relevant to this form */
    .dme_link {
        margin-top: 30px;
        text-align: center;
    }

    .dme_link a {
        background: #FFF;
        font-weight: bold;
        color: #ee0979;
        border: 0 none;
        border-radius: 25px;
        cursor: pointer;
        padding: 5px 25px;
        font-size: 12px;
    }

    .dme_link a:hover,
    .dme_link a:focus {
        background: #C5C5F1;
        text-decoration: none;
    }


    /* Hiding the checkbox, but allowing it to be focused */
    .badgebox {
        opacity: 0;
    }

    .badgebox+.badge {
        /* Move the check mark away when unchecked */
        text-indent: -999999px;
        /* Makes the badge's width stay the same checked and unchecked */
        width: 27px;
    }

    .badgebox:focus+.badge {
        /* Set something to make the badge looks focused */
        /* This really depends on the application, in my case it was: */

        /* Adding a light border */
        box-shadow: inset 0px 0px 5px;
        /* Taking the difference out of the padding */
    }

    .badgebox:checked+.badge {
        /* Move the check mark back when checked */
        text-indent: 0;
    }

    .btn .badge {
        color: black;
        background-color: white;
        border: 1px solid black;
    }
</style>
@endpush

@section('title','Profil')

@section('content')

@include('panels.navbar')

@include('panels.sidemenu')

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Profile
                            <img class="align-text  width=" 15" height="15"" src="
                                {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap"
                                data-toggle="popover" data-placement="top"
                                data-content="Pada halaman ini, ditampilkan detail profile dari pemilik akun. Pada halaman ini pula, pengguna dapat mengubah kata sandi dan detail informasi akunnya." />
                        </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">Profile</a>
                                </li>
                                <li class="breadcrumb-item active">{{$user->name}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <!-- MultiStep Form -->
            <div class="row justify-content-center">
                <div class="col-md-9 col-md-offset-3 ">
                    <form id="msform">
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active">Category</li>
                            <li>Expertise</li>
                            <li>Education</li>
                            <li>Employment</li>
                            <li>Languages</li>
                            <li>Overview</li>
                            <li>Address</li>
                            <li>Review</li>
                        </ul>
                        <!-- fieldsets -->
                        <fieldset>
                            <h2 class="fs-title">Tell us about the work you do!</h2>
                            <h5 class="text-left">Select Category</h5>
                            <div class="text-center">
                                @foreach ($category as $ctg)
                                <label for="primary{{$loop->iteration}}"
                                    class="btn btn-outline-dark text-left">{{$ctg->category}}
                                    <input name="category" type="checkbox" id="primary{{$loop->iteration}}"
                                        class="badgebox" value="{{$ctg->category}}">
                                    <span class="badge" id="checked{{$loop->iteration}}">&check;</span>
                                </label>
                                @endforeach
                            </div>

                            <br>
                            <div class="form-group text-left">
                                <label class="form-label" for="register-username">Others</label>
                                <select class="category-select form-control @error('category') is-invalid @enderror"
                                    name="category" id="category-select">
                                    @foreach ($other_category as $ctg)
                                    <option></option>
                                    <option>{{ $ctg->category }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="text-left ">
                                <a class="card-text" href="#"><small class="text-muted">Skip this step</small></a>
                            </div>

                            <input type="button" name="next" class="next action-button " value="Next" />
                        </fieldset>

                        <fieldset>
                            <h2 class="fs-title">What is your skill?</h2>

                            <br>
                            <h5>Select skill</h5>
                            <div class="form-group">
                                <select id="skill-select"
                                    class="livesearch-plans form-control @error('category') is-invalid @enderror"
                                    name="skill" multiple>
                                    @foreach ($all_skills as $all_skill)
                                    <option id="skill-{{$all_skill->id}}">{{ $all_skill->skill_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-left ">
                                <a class="card-text" href="#"><small class="text-muted">Skip this
                                        step</small></a>
                            </div>
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>

                        <fieldset>
                            <h2 class="fs-title">Add the schools you attended, areas of study, and degrees earned!</h2>
                            <br>
                            <h5>School</h5>
                            <div class="form-group">
                                <input class="form-control" id="school" type="text" name="school"
                                    placeholder="ex. Oxford University" aria-describedby="" value="" autocomplete=""
                                    autofocus tabindex="1" />
                            </div>
                            <h5>Field of study</h5>
                            <div class="form-group">
                                <input class="form-control" id="field_of_study" type="text" name="field_of_study"
                                    placeholder="ex. Information System" aria-describedby="" value="" autocomplete=""
                                    autofocus tabindex="1" />
                            </div>
                            <h5>Degree</h5>
                            <div class="form-group">
                                <input class="form-control" id="degree" type="text" name="degree"
                                    placeholder="ex. Bachelor Degree" aria-describedby="" value="" autocomplete=""
                                    autofocus tabindex="1" />
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5>Start Year</h5>

                                    <div class="form-group">
                                        <select class="form-control" name="provinsi" id="start_year">
                                            <option disabled selected> Pilih </option>
                                            <?php for ($i = 1950; $i < date('Y'); $i++) {

                                                echo '<option value=' . $i . ' >' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5>End Year(or expected)</h5>
                                    <div class="form-group">
                                        <select class="form-control" name="provinsi" id="end_year">
                                            <option disabled selected> Pilih </option>
                                            <?php for ($i = 1950; $i < date('Y') + 5; $i++) {

                                                echo '<option value=' . $i . ' >' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>

                        <fieldset>
                            <h2 class="fs-title">Add your past work experience</h2>
                            <br>
                            <h5>Are you beginner?</h5>

                            <div class="form-group text-left" id="beginner_form">
                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Yes">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>

                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="No">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>

                            <h5>Add Employment</h5>
                            <hr>
                            <h5>Company</h5>
                            <div class="form-group">
                                <input class="form-control" id="company" type="text" name=""
                                    placeholder="ex. PT. Wahana Integra Nusantara" aria-describedby="" value=""
                                    autocomplete="" autofocus tabindex="1" />
                            </div>
                            <h5>Location</h5>
                            <div class="form-group">
                                <input class="form-control" id="location" type="text" name=""
                                    placeholder="ex. Street name, City, Province, Nation" aria-describedby="" value=""
                                    autocomplete="" autofocus tabindex="1" />
                            </div>
                            <h5>Current Position</h5>
                            <div class="form-group">
                                <input class="form-control" id="current_position" type="text" name=""
                                    placeholder="ex. Manager" aria-describedby="" value="" autocomplete="" autofocus
                                    tabindex="1" />
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h5>Entry</h5>
                                    <div class="form-group">
                                        <select class="form-control" name="bulan" id="entry_month">
                                            <option disabled selected> Select month </option>
                                            <option value='January'>January</option>
                                            <option value='February'>February</option>
                                            <option value='March'>March</option>
                                            <option value='April'>April</option>
                                            <option value='May'>May</option>
                                            <option value='June'>June</option>
                                            <option value='July'>July</option>
                                            <option value='August'>August</option>
                                            <option value='September'>September</option>
                                            <option value='October'>October</option>
                                            <option value='November'>November</option>
                                            <option value='December'>December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <h5>&nbsp;</h5>
                                    <div class="form-group">
                                        <select class="form-control" name="year" id="entry_year">
                                            <option disabled selected> Select year </option>
                                            <?php for ($i = 1950; $i < date('Y') + 5; $i++) {

                                                echo '<option value=' . $i . ' >' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <h5>Out</h5>
                                    <div class="form-group">
                                        <select class="form-control" name="bulan" id="out_month">
                                            <option disabled selected> Select month </option>
                                            <option value='January'>January</option>
                                            <option value='February'>February</option>
                                            <option value='March'>March</option>
                                            <option value='April'>April</option>
                                            <option value='May'>May</option>
                                            <option value='June'>June</option>
                                            <option value='July'>July</option>
                                            <option value='August'>August</option>
                                            <option value='September'>September</option>
                                            <option value='October'>October</option>
                                            <option value='November'>November</option>
                                            <option value='December'>December</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="n_form">
                                        <input class="form-check-input" type="radio" name="n_radio"
                                            id="flexRadioDefault1" value="Yes">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            No, I currently work here
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <h5>&nbsp;</h5>
                                    <div class="form-group">
                                        <select class="form-control" name="year" id="out_year">
                                            <option disabled selected> Select year </option>
                                            <?php for ($i = 1950; $i < date('Y'); $i++) {

                                                echo '<option value=' . $i . ' >' . $i . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <h5>Description (Optional)</h5>
                            <div class="form-group">
                                <textarea class="form-control" id="description" type="text" name="" aria-describedby=""
                                    value="" autocomplete="" autofocus tabindex="1"> </textarea>
                            </div>

                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>

                        <fieldset>
                            <!-- <h2 class="fs-title">TRIP Information</h2> -->
                            <h5>What is your English proficiency?</h5>
                            <div class="form-group text-left" id="ep_form">
                                <input type="radio" name="ep_radio" id="inlineRadio1" value="Basic">
                                <label class="form-check-label" for="inlineRadio1">Basic</label>

                                <input type="radio" name="ep_radio" id="inlineRadio1" value="Good">
                                <label class="form-check-label" for="inlineRadio1">Good</label>

                                <input type="radio" name="ep_radio" id="inlineRadio1" value="Fluent">
                                <label class="form-check-label" for="inlineRadio1">Fluent</label>

                                <input type="radio" name="ep_radio" id="inlineRadio1" value="Native">
                                <label class="form-check-label" for="inlineRadio1">Native</label>
                            </div>

                            <h5>What other languages do you speak?</h5>
                            <h5>Language</h5>
                            <div class="form-group">
                                <input class="form-control" id="other_language" type="text" name=""
                                    placeholder="ex. Arabian" aria-describedby="" value="" autocomplete="" autofocus
                                    tabindex="1" />
                            </div>
                            <h5>Proficiency</h5>
                            <div class="form-group text-left" id="p_form">
                                <input type="radio" name="p_radio" id="inlineRadio1" value="Basic">
                                <label class="form-check-label" for="inlineRadio1">Basic</label>

                                <input type="radio" name="p_radio" id="inlineRadio1" value="Good">
                                <label class="form-check-label" for="inlineRadio1">Good</label>

                                <input type="radio" name="p_radio" id="inlineRadio1" value="Fluent">
                                <label class="form-check-label" for="inlineRadio1">Fluent</label>

                                <input type="radio" name="p_radio" id="inlineRadio1" value="Native">
                                <label class="form-check-label" for="inlineRadio1">Native</label>

                            </div>
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>

                        <fieldset>
                            <h2 class="fs-title">Write a great profile or description about your skills in your
                                category!</h2>

                            <h5>Title</h5>
                            <div class="form-group">
                                <input class="form-control" id="title" type="text" name="" placeholder="Enter tittle"
                                    aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                            </div>
                            <h5>Overview</h5>
                            <div class="form-group">
                                <textarea class="form-control" id="overview" type="text" name="" aria-describedby=""
                                    value="" autocomplete="" autofocus tabindex="1"> </textarea>
                            </div>

                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>

                        <fieldset>
                            <h2 class="fs-title">Where are you based?</h2>
                            <h5>Street</h5>
                            <div class="form-group">
                                <input class="form-control" id="street" type="text" name=""
                                    placeholder="ex. 1234 Main Street, Apartment 101" aria-describedby="" value=""
                                    autocomplete="" autofocus tabindex="1" />
                            </div>
                            <h5>City</h5>
                            <div class="form-group">
                                <input class="form-control" id="city" type="text" name="" placeholder="ex. Malang"
                                    aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                            </div>
                            <h5>Country</h5>
                            <div class="form-group">
                                <input class="form-control" id="country" type="text" name="" placeholder="ex. Indonesia"
                                    aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                            </div>
                            <h5>Postal Code</h5>
                            <div class="form-group">
                                <input class="form-control" id="postal_code" type="text" name=""
                                    placeholder="ex. 098811" aria-describedby="" value="" autocomplete="" autofocus
                                    tabindex="1" />
                            </div>

                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>

                        <fieldset>
                            <h2 class="fs-title">Review Profile</h2>

                            <br>

                            <div class="collapse-icon">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div id="headingCollapse1" class="card-header" id="headingOne"
                                            data-toggle="collapse" role="button" data-target="#collapse1"
                                            aria-expanded="false" aria-controls="collapse1">
                                            <span class="lead collapse-title"><b>Category</b></span>
                                        </div>
                                        <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1"
                                            class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body text-left">
                                                <h5 id="category_review_wrapper"></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingCollapse2" class="card-header" data-toggle="collapse"
                                            role="button" data-target="#collapse2" aria-expanded="false"
                                            aria-controls="collapse2">
                                            <span class="lead collapse-title"><b>Expertise</b></span>
                                        </div>
                                        <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2"
                                            class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <h5 id="skill_new"></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingCollapse3" class="card-header" data-toggle="collapse"
                                            role="button" data-target="#collapse3" aria-expanded="false"
                                            aria-controls="collapse3">
                                            <span class="lead collapse-title"><b>Education</b></span>
                                        </div>
                                        <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3"
                                            class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>School </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="school_new">: -</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Field of Study </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="field_of_study_new">: -</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Degree </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="degree_new">: -</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Start Year </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="start_year_new">: -</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>End Year </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="end_year_new">: -</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingCollapse4" class="card-header" data-toggle="collapse"
                                            role="button" data-target="#collapse4" aria-expanded="false"
                                            aria-controls="collapse4">
                                            <span class="lead collapse-title"><b>Employment</b></span>
                                        </div>
                                        <div id="collapse4" role="tabpanel" aria-labelledby="headingCollapse4"
                                            class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Beginner Status </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="beginner_status_new">: -</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Company </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="company_new">: -</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Location : </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="location_new">: -</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Current Position </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="current_position_new">: -</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Entry </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="entry_month_year_new">: -</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Out </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="out_month_year_new">: -</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Description </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="description_new">: -</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Currently Work? </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="n_new">: -</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingCollapse5" class="card-header" data-toggle="collapse"
                                            role="button" data-target="#collapse5" aria-expanded="false"
                                            aria-controls="collapse5">
                                            <span class="lead collapse-title"><b>Languages</b></span>
                                        </div>
                                        <div id="collapse5" role="tabpanel" aria-labelledby="headingCollapse5"
                                            class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>English Proficiency </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="english_proficiency_new"></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Other Languages </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="other_language_new"></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Proficiency </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="proficiency_new"></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingCollapse6" class="card-header" data-toggle="collapse"
                                            role="button" data-target="#collapse6" aria-expanded="false"
                                            aria-controls="collapse6">
                                            <span class="lead collapse-title"><b>Overview</b></span>
                                        </div>
                                        <div id="collapse6" role="tabpanel" aria-labelledby="headingCollapse6"
                                            class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Title </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="title_new"></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Overview </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="overview_new"></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div id="headingCollapse7" class="card-header" data-toggle="collapse"
                                            role="button" data-target="#collapse7" aria-expanded="false"
                                            aria-controls="collapse7">
                                            <span class="lead collapse-title"><b>Address</b></span>
                                        </div>
                                        <div id="collapse7" role="tabpanel" aria-labelledby="headingCollapse7"
                                            class="collapse" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Street </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="street_new"></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>City </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="city_new"></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Country </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="country_new"></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h5><b>Postal Code </b></h5>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 id="postal_code_new"></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="submit" name="submit" class="submit action-button" value="Submit" />
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- END: Content-->
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $('.category-select').select2({
        placeholder: 'Type category that match on you ...',
        tags: true
    });

    $("#skill-select").select2({
        placeholder: 'Type skill that match on you ...',
        ajax: {
            url: "{{route('skill.search')}}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
              return {
                q: $.trim(params.term)
              };
            },
            processResults: function(data) {
              return {
                results: $.map(data, function(item) {
                  // console.log(item)
                  return {
                    text: item.skill_name,
                    id: item.id,
                    // client_id: item.client_id,
                  }
                })
              };
            },
            cache: true
        }
    });

    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function() {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50) + "%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });
                next_fs.css({
                    'left': left,
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".previous").click(function() {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'left': left
                });
                previous_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'opacity': opacity
                });
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    // $(".next").first().click(function() {
    //     for (i = 1; i <= $('.badgebox').length; i++){
    //         if($('#checked1').html() == '&check;') {
    //             console.log('ok');
    //         } else {
    //             console.log('not ok');
    //         }
    //         // console.log($('#primary'+i).val());
    //     }
    // });

    $(".next").last().click(function() {
        console.log($('#skill').val());
        // CATEGORY FIELD 
        $("#category_review_wrapper").empty();
        $('input[name="category"]:checked').each(function() {
           $("#category_review_wrapper").append('<div class="col-12"><ul><li>'+this.value+'</li></ul></div>');
        });
        $('#category-select option:selected').each(function() {
           $("#category_review_wrapper").append('<div class="col-12"><ul><li>'+this.text+'</li></ul></div>');
        });

        // EXPERTISE FIELD
        $('#skill-select option:selected').each(function() {
           $("#skill_new").append('<div class="col-12"><ul><li>'+this.text+'</li></ul></div>');
        });

        // EDUCATION FIELD
        $("h5#school_new").html(': ' + $('#school').val());
        $("h5#field_of_study_new").html(': ' + $('#field_of_study').val());
        $("h5#degree_new").html(': ' + $('#degree').val());
        $("h5#start_year_new").html(': ' + $('#start_year').val());
        $("h5#end_year_new").html(': ' + $('#end_year').val());

        // EMPLOYMENT FIELD
        $("h5#beginner_status_new").empty();
        $('input[name="inlineRadioOptions"]:checked', '#beginner_form').each(function() {
           $("h5#beginner_status_new").append(': '+this.value);
        });
        $("h5#company_new").html(': ' + $('#company').val());
        $("h5#location_new").html(': ' + $('#location').val());
        $("h5#current_position_new").html(': ' + $('#current_position').val());
        $("h5#entry_month_year_new").html(': ' + $('#entry_month').val() + '-' + $('#entry_year').val());
        $("h5#out_month_year_new").html(': ' + $('#out_month').val() + '-' + $('#out_year').val());
        $("h5#description_new").html(': ' + $('#description').val());
        $('input[name="n_radio"]:checked', '#n_form').each(function() {
           $("h5#n_new").append(': '+this.value);
        });

        // LANGUAGES FIELD
        $('input[name="ep_radio"]:checked', '#ep_form').each(function() {
           $("h5#english_proficiency_new").append(': '+this.value);
        });
        $("h5#other_language_new").html(': ' + $('#other_language').val());
        $('input[name="p_radio"]:checked', '#ep_form').each(function() {
           $("h5#proficiency_new").append(': '+this.value);
        });

        // OVERVIEW FIELD
        $("h5#title_new").html(': ' + $('#title').val());
        $("h5#overview_new").html(': ' + $('#overview').val());

        // ADDRESS FIELD
        $("h5#street_new").html(': ' + $('#street').val());
        $("h5#city_new").html(': ' + $('#city').val());
        $("h5#country_new").html(': ' + $('#country').val());
        $("h5#postal_code_new").html(': ' + $('#postal_code').val());
    });

    $(".submit").click(function() {
        return false;
    })


    //method for validating phone number
    $.validator.addMethod("phoneNumber", function(value, element) {
        return this.optional(element) || /^[1-9][0-9]/.test(value);
    }, '<strong class="text-danger">Please enter a valid phone number!</strong>');
    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param * 1000000)
    }, '<strong class="text-danger">File must be less than {0}MB!</strong>');
    //submit edit profile and validation
    $('#saveBtn1').click(function(e) {
        console.log('masuk');
        $('#ClientForm').validate({
            rules: {
                'phone': {
                    required: true,
                    'phoneNumber': true,
                    minlength: 9,
                    maxlength: 12
                },
                'name': {
                    required: true
                }
            },
            messages: {
                'phone': {
                    required: '<strong class="text-danger">Phone is required!</strong>',
                    minlength: '<strong class="text-danger">Phone number at least contains 9 digits!</strong>',
                    maxlength: '<strong class="text-danger">Phone number maximum contains 13 digits!</strong>'
                },
                'name': {
                    required: '<strong class="text-danger">Name is required!</strong>'
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "phone") {
                    error.appendTo("#phone-error");
                } else if (element.attr("name") == "name") {
                    error.appendTo("#name-error");
                }
            },
            //submit Handler
            submitHandler: function(form) {
                form.submit();
                Swal.fire({
                    icon: 'success',
                    title: 'Updated succesfully!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
        $('#modals_profil').modal('hide');
    });
    $('#saveProfileCoacheeBtn').click(function(e) {
        console.log('masuk');
        $('#formEditProfileCoachee').validate({
            rules: {
                'phone': {
                    required: true,
                    'phoneNumber': true,
                    minlength: 9,
                    maxlength: 12
                },
                'name': {
                    required: true
                }
            },
            messages: {
                'phone': {
                    required: '<strong class="text-danger">Phone is required!</strong>',
                    minlength: '<strong class="text-danger">Phone number at least contains 9 digits!</strong>',
                    maxlength: '<strong class="text-danger">Phone number maximum contains 13 digits!</strong>'
                },
                'name': {
                    required: '<strong class="text-danger">Name is required!</strong>'
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "phone") {
                    error.appendTo("#phone-error");
                } else if (element.attr("name") == "name") {
                    error.appendTo("#name-error");
                }
            },
            //submit Handler
            submitHandler: function(form) {
                form.submit();
                Swal.fire({
                    icon: 'success',
                    title: 'Updated succesfully!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
        $('#modals_profil').modal('hide');
    });
    //submit edit profile picture and validation
    $('#saveProfilePictureBtn').click(function(e) {
        console.log('masuk');
        $('#formProfilePicture').validate({
            rules: {
                'profil_picture': {
                    required: true,
                    accept: 'image/*',
                    filesize: 2
                }
            },
            messages: {
                'profil_picture': {
                    required: '<strong class="text-danger">Profile Picture is required!</strong>',
                    accept: '<strong class="text-danger">Profile Picture must be an image file!</strong>',
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "profil_picture") {
                    error.appendTo("#profil_picture-error");
                }
            },
            //submit Handler
            submitHandler: function(form) {
                form.submit();
                Swal.fire({
                    icon: 'success',
                    title: 'Updated succesfully!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });
    //submit edit background picture and validation
    $('#saveBackgroundPictureBtn').click(function(e) {
        console.log('masuk');
        $('#formBackgroundPicture').validate({
            rules: {
                'background_picture': {
                    required: true,
                    accept: 'image/*',
                    filesize: 2
                }
            },
            messages: {
                'background_picture': {
                    required: '<strong class="text-danger">Background Picture is required!</strong>',
                    accept: '<strong class="text-danger">Background Picture must be an image file!</strong>',
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "background_picture") {
                    error.appendTo("#background_picture-error");
                }
            },
            //submit Handler
            submitHandler: function(form) {
                form.submit();
                Swal.fire({
                    icon: 'success',
                    title: 'Updated succesfully!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    });
    $('#datepicker').datepicker({
        minViewMode: 'years',
        autoclose: true,
        format: 'yyyy'
    });
    // modal edit
    $('body').on('click', '#edit_profil', function() {
        console.log('edit');
    });


    // multistep
</script>
@endpush