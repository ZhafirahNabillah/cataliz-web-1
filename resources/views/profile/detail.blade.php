@extends('layouts.layoutVerticalMenu')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-profile.css') }}">
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
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
        background: #C5C5F1;
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
        background: blue;
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
                                <li class="breadcrumb-item"><a href="{{route('profil', $user->id)}}">Profile</a>
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
                            <li>Submit</li>
                        </ul>
                        <!-- fieldsets -->
                        <fieldset>
                            <h2 class="fs-title">Tell us about the work you do!</h2>
                            <h5 class="text-left">Select Category</h5>

                            <br>
                            <div class="form-group text-left">
                                <label class="form-label" for="register-username">Others</label>
                                <input class="form-control" id="" type="text" name=""
                                    placeholder="Type category that match on you ..." aria-describedby="" value=""
                                    autocomplete="" autofocus tabindex="1" />
                            </div>
                            <br>
                            <h5 class="text-left">Select Sub Category</h5>
                            <div class="form-group">
                                <select class="form-input form-control" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">Sub One</option>
                                    <option value="2">Sub Two</option>
                                    <option value="3">Sub Three</option>
                                </select>
                            </div>
                            <div class="text-left ">
                                <a class="card-text" href="#"><small class="text-muted">Skip this step</small></a>
                            </div>

                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>

                        <fieldset>
                            <h2 class="fs-title">What is your skill?</h2>

                            <br>
                            <h5>Select skill</h5>
                            <div class="form-group">
                                <select id="state" class="livesearch-plans form-control " name="#"
                                    placeholder="Type skill that match on you ..." multiple></select>
                                @error('')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
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
                                <input class="form-control" id="" type="text" name=""
                                    placeholder="ex. Oxford University" aria-describedby="" value="" autocomplete=""
                                    autofocus tabindex="1" />
                            </div>
                            <h5>Field of study</h5>
                            <div class="form-group">
                                <input class="form-control" id="" type="text" name=""
                                    placeholder="ex. Information System" aria-describedby="" value="" autocomplete=""
                                    autofocus tabindex="1" />
                            </div>
                            <h5>Degree</h5>
                            <div class="form-group">
                                <input class="form-control" id="" type="text" name="" placeholder="ex. Bachelor Degree"
                                    aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5>Start Year</h5>

                                    <div class="form-group">
                                        <select class="form-control" name="provinsi" id="provinsi">
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
                                        <select class="form-control" name="provinsi" id="provinsi">
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
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                    value="option1">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                    value="option2">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                            <h5>Add Employment</h5>
                            <hr>
                            <h5>Company</h5>
                            <div class="form-group">
                                <input class="form-control" id="" type="text" name=""
                                    placeholder="ex. PT. Wahana Integra Nusantara" aria-describedby="" value=""
                                    autocomplete="" autofocus tabindex="1" />
                            </div>
                            <h5>Location</h5>
                            <div class="form-group">
                                <input class="form-control" id="" type="text" name=""
                                    placeholder="ex. Street name, City, Province, Nation" aria-describedby="" value=""
                                    autocomplete="" autofocus tabindex="1" />
                            </div>
                            <h5>Current Position</h5>
                            <div class="form-group">
                                <input class="form-control" id="" type="text" name="" placeholder="ex. Manager"
                                    aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <h5>Entry</h5>
                                    <div class="form-group">
                                        <select class="form-control" name="bulan" id="bulan">
                                            <option disabled selected> Select month </option>
                                            <option value='01'>January</option>
                                            <option value='02'>February</option>
                                            <option value='03'>March</option>
                                            <option value='04'>April</option>
                                            <option value='05'>May</option>
                                            <option value='06'>June</option>
                                            <option value='07'>July</option>
                                            <option value='08'>August</option>
                                            <option value='09'>September</option>
                                            <option value='10'>October</option>
                                            <option value='11'>November</option>
                                            <option value='12'>December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <h5>&nbsp;</h5>
                                    <div class="form-group">
                                        <select class="form-control" name="year" id="year">
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
                                        <select class="form-control" name="bulan" id="bulan">
                                            <option disabled selected> Select month </option>
                                            <option value='01'>January</option>
                                            <option value='02'>February</option>
                                            <option value='03'>March</option>
                                            <option value='04'>April</option>
                                            <option value='05'>May</option>
                                            <option value='06'>June</option>
                                            <option value='07'>July</option>
                                            <option value='08'>August</option>
                                            <option value='09'>September</option>
                                            <option value='10'>October</option>
                                            <option value='11'>November</option>
                                            <option value='12'>December</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            No, I currently work here
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <h5>&nbsp;</h5>
                                    <div class="form-group">
                                        <select class="form-control" name="year" id="year">
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
                                <textarea class="form-control" id="" type="text" name="" aria-describedby="" value=""
                                    autocomplete="" autofocus tabindex="1"> </textarea>
                            </div>


                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>

                        <fieldset>
                            <!-- <h2 class="fs-title">TRIP Information</h2> -->
                            <h3 class="fs-subtitle">Your presence on the social network</h3>
                            <input type="text" name="twitter" placeholder="Twitter" />
                            <input type="text" name="facebook" placeholder="Facebook" />
                            <input type="text" name="gplus" placeholder="Google Plus" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>

                        <fieldset>
                            <h2 class="fs-title">Write a great profile or description about your skills in your
                                category!</h2>

                            <h5>Title</h5>
                            <div class="form-group">
                                <input class="form-control" id="" type="text" name="" placeholder="Enter tittle"
                                    aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                            </div>
                            <h5>Overview</h5>
                            <div class="form-group">
                                <textarea class="form-control" id="" type="text" name="" aria-describedby="" value=""
                                    autocomplete="" autofocus tabindex="1"> </textarea>
                            </div>

                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>

                        <fieldset>
                            <h2 class="fs-title">Where are you based?</h2>
                            <h5>Street</h5>
                            <div class="form-group">
                                <input class="form-control" id="" type="text" name=""
                                    placeholder="ex. 1234 Main Street, Apartment 101" aria-describedby="" value=""
                                    autocomplete="" autofocus tabindex="1" />
                            </div>
                            <h5>City</h5>
                            <div class="form-group">
                                <input class="form-control" id="" type="text" name="" placeholder="ex. Malang"
                                    aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                            </div>
                            <h5>Country</h5>
                            <div class="form-group">
                                <input class="form-control" id="" type="text" name="" placeholder="ex. Indonesia"
                                    aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                            </div>
                            <h5>Postal Code</h5>
                            <div class="form-group">
                                <input class="form-control" id="" type="text" name="" placeholder="ex. 098811"
                                    aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                            </div>


                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>

                        <fieldset>
                            <h2 class="fs-title">Review Profile</h2>
                            <h3 class="fs-subtitle">Fill in your credentials to authorize submission</h3>
                            <input type="text" name="email" placeholder="Username" />
                            <input type="password" name="pass" placeholder="Password" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                            <input type="submit" name="submit" class="submit action-button" value="Submit" />
                        </fieldset>
                    </form>

                </div>
            </div>
            <!-- /.MultiStep Form -->

            <!-- <div class="tab-content">
                {{-- home tab --}}
                <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                    <section id="profile-info">
                        <div class="row">
                            @if ($message = Session::get('success'))
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dissmisable">
                                    <h4 class="alert-heading">Success</h4>
                                    <div class="alert-body">{{ $message }}</div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="nav-vertical">
                                <ul class="nav nav-tabs nav-left flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="baseVerticalLeft-tab1" data-toggle="tab" aria-controls="tabVerticalLeft1" href="#tabVerticalLeft1" role="tab" aria-selected="true">Category</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft-tab2" data-toggle="tab" aria-controls="tabVerticalLeft2" href="#tabVerticalLeft2" role="tab" aria-selected="false">Expertise</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft-tab3" data-toggle="tab" aria-controls="tabVerticalLeft3" href="#tabVerticalLeft3" role="tab" aria-selected="false">Education</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft-tab4" data-toggle="tab" aria-controls="tabVerticalLeft4" href="#tabVerticalLeft4" role="tab" aria-selected="false">Employment</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft-tab5" data-toggle="tab" aria-controls="tabVerticalLeft5" href="#tabVerticalLeft5" role="tab" aria-selected="false">languages</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft-tab6" data-toggle="tab" aria-controls="tabVerticalLeft6" href="#tabVerticalLeft6" role="tab" aria-selected="false">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseVerticalLeft-tab7" data-toggle="tab" aria-controls="tabVerticalLeft7" href="#tabVerticalLeft7" role="tab" aria-selected="false">Address</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabVerticalLeft1" role="tabpanel" aria-labelledby="baseVerticalLeft-tab1">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3>Tell us about the work you do!</h3>
                                                <br>
                                                <h5>Select Category</h5>
                                                <div class="form-group">
                                                    <label class="form-label" for="register-username">Others</label>
                                                    <input class="form-control" id="" type="text" name="" placeholder="Type category that match on you ..." aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                                                </div>

                                                <h5>Select Sub Category</h5>
                                                <div class="form-group">
                                                    <select class="form-select form-control" aria-label="Default select example">
                                                        <option selected disabled>Open this select menu</option>
                                                        <option value="1">Sub One</option>
                                                        <option value="2">Sub Two</option>
                                                        <option value="3">Sub Three</option>
                                                    </select>
                                                </div>
                                                <div class="text-left ">
                                                    <a class="card-text" href="#"><small class="text-muted">Skip this
                                                            step</small></a>
                                                </div>

                                                <div class="text-right">
                                                    <button class="btn btn-primary ">Next: Expertise</button>
                                                    <button class="btn btn-outline-dark">Review & Save</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabVerticalLeft2" role="tabpanel" aria-labelledby="baseVerticalLeft-tab2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3>What is your skill?</h3>
                                                <br>
                                                <h5>Select skill</h5>
                                                <div class="form-group">
                                                    <select id="state" class="livesearch-plans form-control " name="#" placeholder="Type skill that match on you ..." multiple></select>
                                                    @error('')
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                                <div class="text-left ">
                                                    <a class="card-text" href="#"><small class="text-muted">Skip this
                                                            step</small></a>
                                                </div>

                                                <div class="text-right">
                                                    <button class="btn btn-primary ">Next: Expertise</button>
                                                    <button class="btn btn-outline-dark">Review & Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabVerticalLeft3" role="tabpanel" aria-labelledby="baseVerticalLeft-tab3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3>Add the schools you attended, areas of study, and degrees earned!
                                                </h3>
                                                <br>
                                                <h5>School</h5>
                                                <div class="form-group">
                                                    <input class="form-control" id="" type="text" name="" placeholder="ex. Oxford University" aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                                                </div>
                                                <h5>Field of study</h5>
                                                <div class="form-group">
                                                    <input class="form-control" id="" type="text" name="" placeholder="ex. Information System" aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                                                </div>
                                                <h5>Degree</h5>
                                                <div class="form-group">
                                                    <input class="form-control" id="" type="text" name="" placeholder="ex. Bachelor Degree" aria-describedby="" value="" autocomplete="" autofocus tabindex="1" />
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h5>Start Year</h5>

                                                        <div class="form-group">
                                                            <select class="form-control" name="provinsi" id="provinsi">
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
                                                            <select class="form-control" name="provinsi" id="provinsi">
                                                                <option disabled selected> Pilih </option>
                                                                <?php for ($i = 1950; $i < date('Y') + 5; $i++) {

                                                                    echo '<option value=' . $i . ' >' . $i . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabVerticalLeft4" role="tabpanel" aria-labelledby="baseVerticalLeft-tab4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p>
                                                        Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry
                                                        cotton candy
                                                        oat cake fruitcake
                                                        jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy.
                                                        Cookie
                                                        powder marshmallow donut.
                                                        Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o
                                                        pie cupcake.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabVerticalLeft5" role="tabpanel" aria-labelledby="baseVerticalLeft-tab5">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p>
                                                        Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry
                                                        cotton candy
                                                        oat cake fruitcake
                                                        jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy.
                                                        Cookie
                                                        powder marshmallow donut.
                                                        Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o
                                                        pie cupcake.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabVerticalLeft6" role="tabpanel" aria-labelledby="baseVerticalLeft-tab6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p>
                                                        Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry
                                                        cotton candy
                                                        oat cake fruitcake
                                                        jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy.
                                                        Cookie
                                                        powder marshmallow donut.
                                                        Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o
                                                        pie cupcake.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabVerticalLeft7" role="tabpanel" aria-labelledby="baseVerticalLeft-tab7">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p>
                                                        Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry
                                                        cotton candy
                                                        oat cake fruitcake
                                                        jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy.
                                                        Cookie
                                                        powder marshmallow donut.
                                                        Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o
                                                        pie cupcake.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </div> -->
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

<script type="text/javascript">
    $(function() {


        // popover
        $('[data-toggle="popover"]').popover({
            html: true,
            trigger: 'hover',
            placement: 'top',
            content: function() {
                return '<img src="' + $(this).data('img') + '" />';
            }
        });
        $(document).on('click', '#btn_edit_profil', function() {
            $('#modals_profil').modal('hide');
        })
        $(document).on('click', '#btn_edit_picture', function() {
            $('#modals_profil').modal('hide');
        })
        $(document).on('click', '#btn_edit_background', function() {
            $('#modals_profil').modal('hide');
        })

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