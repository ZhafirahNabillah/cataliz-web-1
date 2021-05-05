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

            <!-- fieldset category -->
            <fieldset>
              <h2 class="fs-title">Tell us about the work you do!</h2>
              <h5 class="text-left">Select Category</h5>
              <div class="text-left">
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
                  name="category">
                  @foreach ($category as $ctg)
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

            {{-- fieldset skill --}}
            <fieldset>
              <h2 class="fs-title">What is your skill?</h2>
              <br>
              <h5>Select skill</h5>
              <div class="form-group">
                <select id="skill-select" class="livesearch-plans form-control @error('category') is-invalid @enderror" name="skill[]" multiple>
                  @foreach ($all_skills as $all_skill)
                    <option id="skill-{{$all_skill->id}}">{{ $all_skill->skill_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="text-left ">
                <a class="card-text" href="#"><small class="text-muted">Skip this step</small></a>
              </div>
              <input type="button" name="previous" class="previous action-button-previous"value="Previous" />
              <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>

            {{-- fieldset education --}}
            <fieldset>
              <h2 class="fs-title">Add the schools you attended, areas of study, and degrees earned!</h2>
              <br>
              <div class="eduacation_wrapper">
                <div class="form-group">
                  <h5>University</h5>
                  <input class="form-control" id="university" type="text" name="education[0][university]" placeholder="ex. Oxford University"/>
                </div>
                <div class="form-group">
                  <h5>Field of study</h5>
                  <input class="form-control" id="field_of_study" type="text" name="education[0][field_of_study]" placeholder="ex. Information System"/>
                </div>
                <div class="form-group">
                  <h5>Degree</h5>
                  <input class="form-control" id="degree" type="text" name="education[0][degree]" placeholder="ex. Bachelor Degree"/>
                </div>
                <div class="row">
                  <div class="col-6">
                    <h5>Start Year</h5>

                    <div class="form-group">
                      <select class="form-control" name="education[0][start_year]" id="start_year">
                        <option disabled selected> Pilih </option>
                        @for ($i=1950; $i < date('Y')+1; $i++)
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <h5>End Year(or expected)</h5>
                    <div class="form-group">
                      <select class="form-control" name="education[0][end_year]" id="end_year">
                        <option disabled selected> Pilih </option>
                        @for ($i=1950; $i < date('Y')+5; $i++)
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                </div>
                <hr class="mt-0">
              </div>
              <div class="text-left">
                <input type="button" id="addOthersEducationBtn" class="btn btn-primary" value="+ Add Others Education">
              </div>

              <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
              <input type="button" name="next" class="next action-button" value="Next"/>
            </fieldset>

            {{-- fieldset work experience --}}
            <fieldset>
              <h2 class="fs-title">Add your past work experience</h2>
              <br>

              <div class="form-group text-left" id="beginner_form">
                <h5>Are you beginner?</h5>

                <input type="radio" name="beginner" id="beginner_yes" value="Yes">
                <label class="form-check-label" for="beginner_yes">Yes</label>

                <input type="radio" name="beginner" id="beginner_no" value="No">
                <label class="form-check-label" for="beginner_no">No</label>
              </div>

              <h5>Add Employment</h5>
              <hr>
              <div class="work_experiences_wrapper">
                <div class="form-group">
                  <h5>Company</h5>
                  <input class="form-control" id="company" type="text" name="work_experiences[0][company]" placeholder="ex. PT. Wahana Integra Nusantara"/>
                </div>
                <div class="form-group">
                  <h5>Location</h5>
                  <input class="form-control" id="location" type="text" name="work_experiences[0][location]" placeholder="ex. Street name, City, Province, Nation" />
                </div>
                <div class="form-group">
                  <h5>Current Position</h5>
                  <input class="form-control" id="current_position" type="text" name="work_experiences[0][position]" placeholder="ex. Manager"/>
                </div>
                <div class="row">
                  <div class="col-3">
                    <h5>Entry</h5>
                    <div class="form-group">
                      <select class="form-control" name="work_experiences[0][entry_month]" id="entry_month">
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
                      <select class="form-control" name="work_experiences[0][entry_year]" id="entry_year">
                        <option disabled selected> Select year </option>
                        @for ($i=1950; $i < date('Y'); $i++)
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                  <div class="col-3">
                    <h5>Out</h5>
                    <div class="form-group">
                      <select class="form-control" name="work_experiences[0][out_month]" id="out_month">
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
                      <input class="form-check-input" type="radio" name="work_experiences[0][is_currently_work]"
                      id="is_currently_work" value="Yes">
                      <label class="form-check-label" for="is_currently_work">
                        No, I currently work here
                      </label>
                    </div>
                  </div>
                  <div class="col-3">
                    <h5>&nbsp;</h5>
                    <div class="form-group">
                      <select class="form-control" name="work_experiences[0][out_year]" id="out_year">
                        <option disabled selected> Select year </option>
                        @for ($i=1950; $i < date('Y'); $i++)
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <h5>Description (Optional)</h5>
                  <textarea class="form-control" id="description" type="text" name="work_experiences[0][description]"></textarea>
                </div>
                <hr class="mt-0">
              </div>

              <div class="text-left">
                <input type="button" id="addOthersWorkExperienceBtn" class="btn btn-primary" value="+ Add Others Work Experience">
              </div>

              <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>

            {{-- fieldset language --}}
            <fieldset>
              <div class="form-group text-left">
                <h5>What is your English proficiency?</h5>
                <input type="radio" name="ep_radio" id="englist_basic" value="Basic">
                <label class="form-check-label" for="englist_basic">Basic</label>

                <input type="radio" name="ep_radio" id="english_good" value="Good">
                <label class="form-check-label" for="english_good">Good</label>

                <input type="radio" name="ep_radio" id="english_fluent" value="Fluent">
                <label class="form-check-label" for="english_fluent">Fluent</label>

                <input type="radio" name="ep_radio" id="english_native" value="Native">
                <label class="form-check-label" for="english_native">Native</label>
              </div>

              <h5>What other languages do you speak?</h5>
              <div class="others_languange_wrapper">
                <div class="form-group">
                  <h5>Language</h5>
                  <input class="form-control" id="other_language" type="text" name="other_language[]" placeholder="ex. Arabian"/>
                </div>
                <div class="form-group text-left">
                  <h5>Proficiency</h5>
                  <input type="radio" name="ol_proficiency[]" id="others_1_basic" value="Basic">
                  <label class="form-check-label" for="others_1_basic">Basic</label>

                  <input type="radio" name="ol_proficiency[]" id="others_1_good" value="Good">
                  <label class="form-check-label" for="others_1_good">Good</label>

                  <input type="radio" name="ol_proficiency[]" id="others_1_fluent" value="Fluent">
                  <label class="form-check-label" for="others_1_fluent">Fluent</label>

                  <input type="radio" name="ol_proficiency[]" id="others_1_native" value="Native">
                  <label class="form-check-label" for="others_1_native">Native</label>
                </div>
              </div>
              <div class="text-left">
                <input type="button" id="addOthersLanguangeBtn" class="btn btn-primary" value="+ Add Others Languange">
              </div>
              <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>

            {{-- fieldset skills description --}}
            <fieldset>
              <h2 class="fs-title">Write a great profile or description about your skills in your category!</h2>
              <div class="form-group">
                <h5>Title</h5>
                <input class="form-control" id="title" type="text" name="description_title" placeholder="Enter tittle"/>
              </div>
              <div class="form-group">
                <h5>Overview</h5>
                <textarea class="form-control" id="overview" type="text" name="description_overview"></textarea>
              </div>

              <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>

            {{-- fieldset adress --}}
            <fieldset>
              <h2 class="fs-title">Where are you based?</h2>
              <div class="form-group">
                <h5>Street</h5>
                <input class="form-control" id="street" type="text" name="loaction_street" placeholder="ex. 1234 Main Street, Apartment 101"/>
              </div>
              <div class="form-group">
                <h5>City</h5>
                <input class="form-control" id="city" type="text" name="location_city" placeholder="ex. Malang"/>
              </div>
              <div class="form-group">
                <h5>Country</h5>
                <input class="form-control" id="country" type="text" name="location_country" placeholder="ex. Indonesia"/>
              </div>
              <div class="form-group">
                <h5>Postal Code</h5>
                <input class="form-control" id="postal_code" type="text" name="location_postal_code" placeholder="ex. 098811"/>
              </div>

              <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Next" />
            </fieldset>

            {{-- fieldset review --}}
            <fieldset>
              <h2 class="fs-title">Review Profile</h2>
              <br>
              <div class="collapse-icon">
                <div class="accordion" id="accordionExample">
                  <div class="card">
                    <div id="headingCollapse1" class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                      <span class="lead collapse-title"><b>Category</b></span>
                    </div>
                    <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse show" data-parent="#accordionExample">
                      <div class="card-body text-left">
                        <div class="row">
                          <div id="category_review_wrapper">: -</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div id="headingCollapse2" class="card-header" data-toggle="collapse" role="button" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                      <span class="lead collapse-title"><b>Expertise</b></span>
                    </div>
                    <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse" data-parent="#accordionExample">
                      <div class="card-body">
                        <h5 id="skill_new">: -</h5>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div id="headingCollapse3" class="card-header" data-toggle="collapse" role="button" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                      <span class="lead collapse-title"><b>Education</b></span>
                    </div>
                    <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="collapse" data-parent="#accordionExample">
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
                    <div id="headingCollapse4" class="card-header" data-toggle="collapse" role="button" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                      <span class="lead collapse-title"><b>Employment</b></span>
                    </div>
                    <div id="collapse4" role="tabpanel" aria-labelledby="headingCollapse4" class="collapse" data-parent="#accordionExample">
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
                    <div id="headingCollapse5" class="card-header" data-toggle="collapse" role="button" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                      <span class="lead collapse-title"><b>Languages</b></span>
                    </div>
                    <div id="collapse5" role="tabpanel" aria-labelledby="headingCollapse5" class="collapse" data-parent="#accordionExample">
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
                    <div id="headingCollapse6" class="card-header" data-toggle="collapse" role="button" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                      <span class="lead collapse-title"><b>Overview</b></span>
                    </div>
                    <div id="collapse6" role="tabpanel" aria-labelledby="headingCollapse6" class="collapse" data-parent="#accordionExample">
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
                    <div id="headingCollapse7" class="card-header" data-toggle="collapse" role="button" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                      <span class="lead collapse-title"><b>Address</b></span>
                    </div>
                    <div id="collapse7" role="tabpanel" aria-labelledby="headingCollapse7" class="collapse" data-parent="#accordionExample">
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

              <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
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

    $(".next").last().click(function() {
        console.log($('#skill').val());
        // CATEGORY FIELD
        $("#category_review_wrapper").empty();
        $('input[name="category"]:checked').each(function() {
           $("#category_review_wrapper").append('<div class="col-12">'+this.value+'</div>');
        });

        // $("h5#category_review_wrapper").html(': ');
        $('#category-select option:selected').each(function() {
            $("h5#category_review_wrapper").empty();
            $("#category_review_wrapper").append('<div class="col-12">'+this.text+'</div>');
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
        window.location.href = "{{route('profil', Auth::user()->id)}}";
        return false;
    });


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
        
    $('#addOthersLanguangeBtn').click(function() {
      append_language();
    });

    $('#addOthersEducationBtn').click(function() {
      append_education();
    });

    $('#addOthersWorkExperienceBtn').click(function() {
      append_work_experience();
    });

    var index_language = 1;
    // method to append new language
    function append_language(){
      index = index_language++;
      var others_language_html = '<div class="form-group"><h5>Language</h5><input class="form-control" id="other_language[]" type="text" name="other_language" placeholder="ex. Arabian"/></div>';
      others_language_html += '<div class="form-group text-left">';
      others_language_html += '<h5>Proficiency</h5>';
      others_language_html += '<input type="radio" name="ol_proficiency[]" id="others_'+index+'_basic" value="Basic"> <label class="form-check-label" for="others_'+index+'_basic">Basic</label> ';
      others_language_html += '<input type="radio" name="ol_proficiency[]" id="others_'+index+'_good" value="Good"> <label class="form-check-label" for="others_'+index+'_good">Good</label> ';
      others_language_html += '<input type="radio" name="ol_proficiency[]" id="others_'+index+'_fluent" value="Fluent"> <label class="form-check-label" for="others_'+index+'_fluent">Fluent</label> ';
      others_language_html += '<input type="radio" name="ol_proficiency[]" id="others_'+index+'_native" value="Native"> <label class="form-check-label" for="others_'+index+'_native">Native</label> ';
      others_language_html += '</div>';

      $('.others_languange_wrapper').append(others_language_html);
    }

    var date_now = new Date();
    var year = date_now.getFullYear();
    index_education = 1;
    // method to append new education
    function append_education(){
      index = index_education++;
      var others_education_html = '<div class="form-group"><h5>University</h5><input class="form-control" id="university" type="text" name="education['+index+'][university]" placeholder="ex. Oxford University"/></div>';
      others_education_html += '<div class="form-group"><h5>Field of study</h5><input class="form-control" id="field_of_study" type="text" name="education['+index+'][field_of_study]" placeholder="ex. Information System"/></div>';
      others_education_html += '<div class="form-group"><h5>Degree</h5><input class="form-control" id="degree" type="text" name="education['+index+'][degree]" placeholder="ex. Bachelor Degree"/></div>';
      others_education_html += '<div class="row">';
      others_education_html += '<div class="col-6"><h5>Start Year</h5><div class="form-group"><select class="form-control" name="education['+index+'][start_year]" id="start_year"><option disabled selected>Pilih</option>';
      for (var i = 1950; i < year; i++) {
        others_education_html += '<option value="'+i+'">'+i+'</option>';
      }
      others_education_html += '</select></div></div>';
      others_education_html += '<div class="col-6"><h5>End Year(or expected)</h5><div class="form-group"><select class="form-control" name="education['+index+'][end_year]" id="end_year"><option disabled selected> Pilih </option>';
      for (var i = 1950; i < year+5; i++) {
        others_education_html += '<option value="'+i+'">'+i+'</option>';
      }
      others_education_html += '</select></div></div>';
      others_education_html += '</div><hr class="mt-0">';

      $('.eduacation_wrapper').append(others_education_html);
    }

    //method to append new work experiences
    index_work_experience = 1;
    function append_work_experience(){
      index = index_work_experience++;

      var others_work_experience_html =
        `<div class="form-group">
          <h5>Company</h5>
          <input class="form-control" id="company" type="text" name="work_experiences[`+index+`][company]" placeholder="ex. PT. Wahana Integra Nusantara"/>
        </div>
        <div class="form-group">
          <h5>Location</h5>
          <input class="form-control" id="location" type="text" name="work_experiences[`+index+`][location]" placeholder="ex. Street name, City, Province, Nation" />
        </div>
        <div class="form-group">
          <h5>Current Position</h5>
          <input class="form-control" id="current_position" type="text" name="work_experiences[`+index+`][position]" placeholder="ex. Manager"/>
        </div>
        <div class="row">
          <div class="col-3">
            <h5>Entry</h5>
            <div class="form-group">
              <select class="form-control" name="work_experiences[`+index+`][entry_month]" id="entry_month">
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
              <select class="form-control" name="work_experiences[`+index+`][entry_year]" id="entry_year">
                <option disabled selected> Select year </option>
                @for ($i=1950; $i < date('Y'); $i++)
                  <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>
          </div>
          <div class="col-3">
            <h5>Out</h5>
            <div class="form-group">
              <select class="form-control" name="work_experiences[`+index+`][out_month]" id="out_month">
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
              <input class="form-check-input" type="radio" name="work_experiences[`+index+`][is_currently_work]"
              id="is_currently_work" value="Yes">
              <label class="form-check-label" for="is_currently_work">
                No, I currently work here
              </label>
            </div>
          </div>
          <div class="col-3">
            <h5>&nbsp;</h5>
            <div class="form-group">
              <select class="form-control" name="work_experiences[`+index+`][out_year]" id="out_year">
                <option disabled selected> Select year </option>
                @for ($i=1950; $i < date('Y'); $i++)
                  <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <h5>Description (Optional)</h5>
          <textarea class="form-control" id="description" type="text" name="work_experiences[`+index+`][description]"></textarea>
        </div>
        <hr class="mt-0">`
      ;

      $('.work_experiences_wrapper').append(others_work_experience_html);
    }

    $(".submit").click(function() {
        return false;
    })


    // multistep
</script>
@endpush
