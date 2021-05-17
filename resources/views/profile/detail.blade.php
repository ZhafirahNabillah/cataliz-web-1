@extends('layouts.layoutVerticalMenu')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/page-profile.css') }}">
<link href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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


  .add {
    border: 2px solid #7367F0;
    color: #7367F0;
    padding: 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    border-radius: 50%;
    background-color: white;
    padding: 8px;
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
              <img class="align-text  width=" 15" height="15"" src=" {{asset('assets\images\icons\popovers.png')}}" alt="Card image cap" data-toggle="popover" data-placement="top" data-content="Pada halaman ini, ditampilkan detail profile dari pemilik akun. Pada halaman ini pula, pengguna dapat mengubah kata sandi dan detail informasi akunnya." />
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
            <fieldset id="categories_fieldset">

              <h2 class="fs-title">Tell us about the work you do!</h2>
              <h5 class="text-left">Select Category</h5>
              <div class="text-left">
                @foreach ($main_categories as $category)
                <label for="primary{{$loop->iteration}}" class="btn btn-outline-dark text-left">{{$category->category}}
                  <input name="categories[]" type="checkbox" id="primary{{$loop->iteration}}" class="badgebox" value="{{$category->id}}">
                  <span class="badge" id="checked{{$loop->iteration}}">&check;</span>
                </label>
                @endforeach
              </div>
              <br>
              <div class="form-group text-left">
                <label class="form-label" for="register-username">Others</label>
                <select class="category-select form-control @error('category') is-invalid @enderror" name="categories[]" multiple>
                  @foreach ($other_categories as $category)
                  <option value="{{ $category->id }}">{{ $category->category }}</option>
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

              <input type="button" name="next" class="next action-button " value="Next" id="saveCategoriesBtn" />
            </fieldset>

            {{-- fieldset skill --}}
            <fieldset id="skills_fieldset">
              <h2 class="fs-title">What is your skill?</h2>
              <br>
              <h5>Select skill</h5>
              <div class="form-group">
                <select id="skill-select" class="form-control @error('category') is-invalid @enderror" name="skill[]" multiple>
                  @foreach ($all_skills as $skill)
                  <option id="skill-{{$skill->id}}" value="{{ $skill->id }}">{{ $skill->skill_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="text-left ">
                <a class="card-text" href="#"><small class="text-muted">Skip this step</small></a>
              </div>
              <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Next" id="saveSkillsBtn" />
            </fieldset>

            {{-- fieldset education --}}
            <fieldset id="education_fieldset">
              <h2 class="fs-title">Add the schools you attended, areas of study, and degrees earned!</h2>
              <br>
              <div class="eduacation_wrapper">
                <div class="form-group">
                  <h5>University</h5>
                  <input class="form-control" id="university" type="text" name="education[0][university]" placeholder="ex. Oxford University" />
                </div>
                <div class="form-group">
                  <h5>Field of study</h5>
                  <input class="form-control" id="field_of_study" type="text" name="education[0][field_of_study]" placeholder="ex. Information System" />
                </div>
                <div class="form-group">
                  <h5>Degree</h5>
                  <input class="form-control" id="degree" type="text" name="education[0][degree]" placeholder="ex. Bachelor Degree" />
                </div>
                <div class="row">
                  <div class="col-6">
                    <h5>Start Year</h5>

                    <div class="form-group">
                      <select class="form-control" name="education[0][start_year]" id="start_year">
                        <option disabled selected> Pilih </option>
                        @for ($i=1950; $i < date('Y')+1; $i++) <option value="{{ $i }}">{{ $i }}</option>
                          @endfor
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <h5>End Year(or expected)</h5>
                    <div class="form-group">
                      <select class="form-control" name="education[0][end_year]" id="end_year">
                        <option disabled selected> Pilih </option>
                        @for ($i=1950; $i < date('Y')+5; $i++) <option value="{{ $i }}">{{ $i }}</option>
                          @endfor
                      </select>
                    </div>
                  </div>
                </div>
                <hr class="mt-0">
              </div>
              <div class="text-center">
                <input type="button" id="addOthersEducationBtn" class="add" value="+">
              </div>

              <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Next" id="saveEducationBtn" />
            </fieldset>

            {{-- fieldset work experience --}}
            <fieldset id="work_experiences_fieldset">
              <h2 class="fs-title">Add your past work experience</h2>
              <br>

              <div class="form-group text-left" id="beginner_form">
                <h5>Are you beginner?</h5>

                <input type="radio" name="beginner" id="beginner_yes" value="1">
                <label class="form-check-label" for="beginner_yes">Yes</label>

                <input type="radio" name="beginner" id="beginner_no" value="0">
                <label class="form-check-label" for="beginner_no">No</label>
              </div>

              <h5>Add Employment</h5>
              <hr>
              <div class="work_experiences_wrapper">
                <div class="form-group">
                  <h5>Company</h5>
                  <input class="form-control" id="company" type="text" name="work_experiences[0][company]" placeholder="ex. PT. Wahana Integra Nusantara" />
                </div>
                <div class="form-group">
                  <h5>Location</h5>
                  <input class="form-control" id="location" type="text" name="work_experiences[0][location]" placeholder="ex. Street name, City, Province, Nation" />
                </div>
                <div class="form-group">
                  <h5>Current Position</h5>
                  <input class="form-control" id="current_position" type="text" name="work_experiences[0][position]" placeholder="ex. Manager" />
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
                        @for ($i=1950; $i < date('Y'); $i++) <option value="{{ $i }}">{{ $i }}</option>
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
                      <input class="form-check-input" type="radio" name="work_experiences[0][is_currently_work]" id="is_currently_work" value="Yes">
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
                        @for ($i=1950; $i < date('Y'); $i++) <option value="{{ $i }}">{{ $i }}</option>
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

              <div class="text-center">
                <input type="button" id="addOthersWorkExperienceBtn" class="add" value="+">
              </div>

              <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Next" id="saveWorkExperienceBtn" />
            </fieldset>

            {{-- fieldset language --}}
            <fieldset id="languages_fieldset">
              <div class="form-group text-left">
                <h5>What is your English proficiency?</h5>
                <input type="hidden" name="languages[0][language]" value="English">
                <input type="radio" name="languages[0][proficiency]" id="englist_basic" value="Basic">
                <label class="form-check-label" for="englist_basic">Basic</label>

                <input type="radio" name="languages[0][proficiency]" id="english_good" value="Good">
                <label class="form-check-label" for="english_good">Good</label>

                <input type="radio" name="languages[0][proficiency]" id="english_fluent" value="Fluent">
                <label class="form-check-label" for="english_fluent">Fluent</label>

                <input type="radio" name="languages[0][proficiency]" id="english_native" value="Native">
                <label class="form-check-label" for="english_native">Native</label>
              </div>

              <h5>What other languages do you speak?</h5>
              <div class="others_languange_wrapper">
                <div class="form-group">
                  <h5>Language</h5>
                  <input class="form-control" id="other_language" type="text" name="languages[1][language]" placeholder="ex. Arabian" />
                </div>
                <div class="form-group text-left">
                  <h5>Proficiency</h5>
                  <input type="radio" name="languages[1][proficiency]" id="others_1_basic" value="Basic">
                  <label class="form-check-label" for="others_1_basic">Basic</label>

                  <input type="radio" name="languages[1][proficiency]" id="others_1_good" value="Good">
                  <label class="form-check-label" for="others_1_good">Good</label>

                  <input type="radio" name="languages[1][proficiency]" id="others_1_fluent" value="Fluent">
                  <label class="form-check-label" for="others_1_fluent">Fluent</label>

                  <input type="radio" name="languages[1][proficiency]" id="others_1_native" value="Native">
                  <label class="form-check-label" for="others_1_native">Native</label>
                </div>
              </div>
              <div class="text-center">
                <input type="button" id="addOthersLanguangeBtn" class="add" value="+">
              </div>
              <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Next" id="saveLanguagesBtn" />
            </fieldset>

            {{-- fieldset skills description --}}
            <fieldset id="skill_description_fieldset">
              <h2 class="fs-title">Write a great profile or description about your skills in your category!</h2>
              <div class="form-group">
                <h5>Title</h5>
                <input class="form-control" id="title" type="text" name="description_title" placeholder="Enter tittle" />
              </div>
              <div class="form-group">
                <h5>Overview</h5>
                <textarea class="form-control" id="overview" type="text" name="description_overview"></textarea>
              </div>

              <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Next" id="saveSkillsDescriptionBtn" />
            </fieldset>

            {{-- fieldset adress --}}
            <fieldset id="address_fieldset">
              <h2 class="fs-title">Where are you based?</h2>
              <div class="form-group">
                <h5>Street</h5>
                <input class="form-control" id="street" type="text" name="location[street]" placeholder="ex. 1234 Main Street, Apartment 101" />
              </div>
              <div class="form-group">
                <h5>City</h5>
                <input class="form-control" id="city" type="text" name="location[city]" placeholder="ex. Malang" />
              </div>
              <div class="form-group">
                <h5>Country</h5>
                <input class="form-control" id="country" type="text" name="location[country]" placeholder="ex. Indonesia" />
              </div>
              <div class="form-group">
                <h5>Postal Code</h5>
                <input class="form-control" id="postal_code" type="text" name="location[postal_code]" placeholder="ex. 098811" />
              </div>

              <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
              <input type="button" name="next" class="next action-button" value="Next" data-id="{{ auth()->user()->id }}" id="saveAddressBtn" />
            </fieldset>

            {{-- fieldset review --}}
            <fieldset id="review_fieldset">
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
                        <div id="category_review_wrapper" class="row">

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div id="headingCollapse2" class="card-header" data-toggle="collapse" role="button" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                      <span class="lead collapse-title"><b>Expertise</b></span>
                    </div>
                    <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" class="collapse" data-parent="#accordionExample">
                      <div class="card-body text-left">
                        <div id="skills_review_wrapper" class="row">

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div id="headingCollapse3" class="card-header" data-toggle="collapse" role="button" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                      <span class="lead collapse-title"><b>Education</b></span>
                    </div>
                    <div id="collapse3" role="tabpanel" aria-labelledby="headingCollapse3" class="collapse" data-parent="#accordionExample">
                      <div class="card-body">
                        <div id="educations_review_wrapper">

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
                        <div id="work_experiences_review_wrapper">

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
                        <div id="languages_review_wrapper">
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
                            <h5><b>Title</b></h5>
                          </div>
                          <div class="col-8">
                            <h5 id="description_title_review"></h5>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-4">
                            <h5><b>Overview</b></h5>
                          </div>
                          <div class="col-8">
                            <h5 id="description_overview_review"></h5>
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
                            <h5><b>Street</b></h5>
                          </div>
                          <div class="col-8">
                            <h5 id="address_street_review"></h5>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-4">
                            <h5><b>City</b></h5>
                          </div>
                          <div class="col-8">
                            <h5 id="address_city_review"></h5>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-4">
                            <h5><b>Country</b></h5>
                          </div>
                          <div class="col-8">
                            <h5 id="address_country_review"></h5>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-4">
                            <h5><b>Postal Code</b></h5>
                          </div>
                          <div class="col-8">
                            <h5 id="address_postal_code_review"></h5>
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
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>
<script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
  $('.category-select').select2({
    placeholder: 'Type category that match on you ...',
    tags: true
  });

  $("#skill-select").select2({
    placeholder: 'Type skill that match on you ...',
    tags: false
  });

  //jQuery time
  var current_fs, next_fs, previous_fs; //fieldsets
  var left, opacity, scale; //fieldset properties which we will animate
  var animating; //flag to prevent quick multi-click glitches

  $(".next").click(function() {
    change_form_next($(this));
  });

  $(".previous").click(function() {
    change_form_previous($(this));
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  //submit categories fieldset
  $("#saveCategoriesBtn").click(function() {
    var data = $('#categories_fieldset').serialize();
    console.log(data);

    $.ajax({
      data: data,
      url: "{{ route('profile.save_categories', auth()->user()->id) }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        console.log(data);
      },
      error: function(reject) {
        // if (reject.status === 422) {
        //   var errors = JSON.parse(reject.responseText);
        //   if (errors.client) {
        //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
        //   }
        //   if (errors.group_code) {
        //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
        //   }
        //   if (errors.date) {
        //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
        //   }
        //   if (errors.objective) {
        //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
        //   }
        //   if (errors.success_indicator) {
        //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
        //   }
        //   if (errors.development_areas) {
        //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
        //   }
        //   if (errors.support) {
        //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
        //   }
        // }
      }
    });
    /**Ajax code ends**/
  });

  //submit skills fieldset
  $("#saveSkillsBtn").click(function() {
    var data = $('#skills_fieldset').serialize();
    console.log(data);

    $.ajax({
      data: data,
      url: "{{ route('profile.save_skills', auth()->user()->id) }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        console.log(data);
      },
      error: function(reject) {
        // if (reject.status === 422) {
        //   var errors = JSON.parse(reject.responseText);
        //   if (errors.client) {
        //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
        //   }
        //   if (errors.group_code) {
        //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
        //   }
        //   if (errors.date) {
        //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
        //   }
        //   if (errors.objective) {
        //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
        //   }
        //   if (errors.success_indicator) {
        //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
        //   }
        //   if (errors.development_areas) {
        //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
        //   }
        //   if (errors.support) {
        //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
        //   }
        // }
      }
    });
  });

  //submit education fieldset
  $("#saveEducationBtn").click(function() {
    var data = $('#education_fieldset').serialize();
    console.log(data);

    $.ajax({
      data: data,
      url: "{{ route('profile.save_educations', auth()->user()->id) }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        console.log(data);
      },
      error: function(reject) {
        // if (reject.status === 422) {
        //   var errors = JSON.parse(reject.responseText);
        //   if (errors.client) {
        //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
        //   }
        //   if (errors.group_code) {
        //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
        //   }
        //   if (errors.date) {
        //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
        //   }
        //   if (errors.objective) {
        //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
        //   }
        //   if (errors.success_indicator) {
        //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
        //   }
        //   if (errors.development_areas) {
        //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
        //   }
        //   if (errors.support) {
        //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
        //   }
        // }
      }
    });
  });

  //submit work experience fieldset
  $("#saveWorkExperienceBtn").click(function() {
    var data = $('#work_experiences_fieldset').serialize();
    console.log(data);

    $.ajax({
      data: data,
      url: "{{ route('profile.save_employments', auth()->user()->id) }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        console.log(data);
      },
      error: function(reject) {
        // if (reject.status === 422) {
        //   var errors = JSON.parse(reject.responseText);
        //   if (errors.client) {
        //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
        //   }
        //   if (errors.group_code) {
        //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
        //   }
        //   if (errors.date) {
        //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
        //   }
        //   if (errors.objective) {
        //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
        //   }
        //   if (errors.success_indicator) {
        //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
        //   }
        //   if (errors.development_areas) {
        //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
        //   }
        //   if (errors.support) {
        //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
        //   }
        // }
      }
    });
  });

  //submit languages fieldset
  $("#saveLanguagesBtn").click(function() {
    var data = $('#languages_fieldset').serialize();
    console.log(data);

    $.ajax({
      data: data,
      url: "{{ route('profile.save_languages', auth()->user()->id) }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        console.log(data);
      },
      error: function(reject) {
        // if (reject.status === 422) {
        //   var errors = JSON.parse(reject.responseText);
        //   if (errors.client) {
        //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
        //   }
        //   if (errors.group_code) {
        //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
        //   }
        //   if (errors.date) {
        //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
        //   }
        //   if (errors.objective) {
        //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
        //   }
        //   if (errors.success_indicator) {
        //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
        //   }
        //   if (errors.development_areas) {
        //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
        //   }
        //   if (errors.support) {
        //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
        //   }
        // }
      }
    });
  });

  //submit skills description fieldset
  $("#saveSkillsDescriptionBtn").click(function() {
    var data = $('#skill_description_fieldset').serialize();
    console.log(data);

    $.ajax({
      data: data,
      url: "{{ route('profile.save_overview', auth()->user()->id) }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        console.log(data);
      },
      error: function(reject) {
        // if (reject.status === 422) {
        //   var errors = JSON.parse(reject.responseText);
        //   if (errors.client) {
        //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
        //   }
        //   if (errors.group_code) {
        //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
        //   }
        //   if (errors.date) {
        //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
        //   }
        //   if (errors.objective) {
        //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
        //   }
        //   if (errors.success_indicator) {
        //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
        //   }
        //   if (errors.development_areas) {
        //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
        //   }
        //   if (errors.support) {
        //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
        //   }
        // }
      }
    });
  });

  //submit address fieldset
  $("#saveAddressBtn").click(function() {
    var data = $('#address_fieldset').serialize();
    console.log(data);

    $.ajax({
      data: data,
      url: "{{ route('profile.save_address', auth()->user()->id) }}",
      type: "POST",
      dataType: 'json',
      success: function(data) {
        console.log(data);
      },
      error: function(reject) {
        // if (reject.status === 422) {
        //   var errors = JSON.parse(reject.responseText);
        //   if (errors.client) {
        //     $('#client-error').html('<strong class="text-danger">' + errors.client[0] + '</strong>'); // and so on
        //   }
        //   if (errors.group_code) {
        //     $('#group_code-error').html('<strong class="text-danger">' + errors.group_code[0] + '</strong>'); // and so on
        //   }
        //   if (errors.date) {
        //     $('#date-error').html('<strong class="text-danger">' + errors.date[0] + '</strong>'); // and so on
        //   }
        //   if (errors.objective) {
        //     $('#objective-error').html('<strong class="text-danger">' + errors.objective[0] + '</strong>'); // and so on
        //   }
        //   if (errors.success_indicator) {
        //     $('#success_indicator-error').html('<strong class="text-danger">' + errors.success_indicator[0] + '</strong>'); // and so on
        //   }
        //   if (errors.development_areas) {
        //     $('#development_areas-error').html('<strong class="text-danger">' + errors.development_areas[0] + '</strong>'); // and so on
        //   }
        //   if (errors.support) {
        //     $('#support-error').html('<strong class="text-danger">' + errors.support[0] + '</strong>'); // and so on
        //   }
        // }
      }
    });
  });

  //show review in the review fieldset
  $(".next").last().click(function() {
    var user_id = $(this).data('id');

    $.get("" + '/profile/' + user_id + '/review', function(data) {

      //append data to category review
      jQuery.each(data.categories, function(i, val) {
        $('#category_review_wrapper').append('<div class="col-12">' + val + '</div>');
      });

      //append data to skills review
      jQuery.each(data.skills, function(i, val) {
        $('#skills_review_wrapper').append('<div class="col-12">' + val + '</div>');
      });

      //append data to educations review
      jQuery.each(data.educations, function(i, val) {
        if (i > 0) {
          $('#educations_review_wrapper').append(`<hr>`);
        }

        $('#educations_review_wrapper').append(
          `<div class="row">
                <div class="col-4">
                  <h5><b>University</b></h5>
                </div>
                <div class="col-8">
                  <h5>: ` + data.educations[i].university + `</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <h5><b>Field of Study</b></h5>
                </div>
                <div class="col-8">
                  <h5>: ` + data.educations[i].field_of_study + `</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <h5><b>Degree</b></h5>
                </div>
                <div class="col-8">
                  <h5>: ` + data.educations[i].degree + `</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <h5><b>Start Year</b></h5>
                </div>
                <div class="col-8">
                  <h5>: ` + data.educations[i].start_year + `</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <h5><b>End Year</b></h5>
                </div>
                <div class="col-8">
                  <h5>: ` + data.educations[i].end_year + `</h5>
                </div>
              </div>`
        );
      });

      //append data to work experiences review
      jQuery.each(data.work_experiences, function(i, val) {
        if (i > 0) {
          $('#work_experiences_review_wrapper').append(`<hr>`);
        }
        $('#work_experiences_review_wrapper').append(
          `<div class="row">
                <div class="col-4">
                  <h5><b>Company</b></h5>
                </div>
                <div class="col-8">
                  <h5>: ` + data.work_experiences[i].company + `</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <h5><b>Location</b></h5>
                </div>
                <div class="col-8">
                  <h5>: ` + data.work_experiences[i].location + `</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <h5><b>Position</b></h5>
                </div>
                <div class="col-8">
                  <h5>: ` + data.work_experiences[i].position + `</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <h5><b>Entry</b></h5>
                </div>
                <div class="col-8">
                  <h5>: ` + data.work_experiences[i].entry_month + `, ` + data.work_experiences[i].entry_year + `</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <h5><b>Until</b></h5>
                </div>
                <div class="col-8">
                  <h5>: ` + data.work_experiences[i].out_month + `, ` + data.work_experiences[i].out_year + `</h5>
                </div>
              </div>
              <div class="row">
                <div class="col-4">
                  <h5><b>Description</b></h5>
                </div>
                <div class="col-8">
                  <h5>: ` + data.work_experiences[i].description + `</h5>
                </div>
              </div>`
        );
      });

      //append data languages review
      jQuery.each(data.languages, function(i, val) {

        if (i > 0) {
          $('#languages_review_wrapper').append(`<hr>`);
        }

        $('#languages_review_wrapper').append(
          `<div class="row">
                <div class="col-4">
                  <h5><b>` + data.languages[i].language + `</b></h5>
                </div>
                <div class="col-8">
                  <h5>` + data.languages[i].proficiency + `</h5>
                </div>
              </div>`
        );
      });

      //append data to skills description review
      $('#description_title_review').text(data.description_title);
      $('#description_overview_review').text(data.description_overview);

      //append data to address review
      $('#address_street_review').text(data.location.street);
      $('#address_city_review').text(data.location.city);
      $('#address_country_review').text(data.location.country);
      $('#address_postal_code_review').text(data.location.postal_code);
    });
  });

  $(".submit").click(function() {
    window.location.href = "{{route('profil', Auth::user()->id)}}";
    return false;
  });

  $('#addOthersLanguangeBtn').click(function() {
    append_language();
  });

  $('#addOthersEducationBtn').click(function() {
    append_education();
  });

  $('#addOthersWorkExperienceBtn').click(function() {
    append_work_experience();
  });

  // method to go next fieldset
  function change_form_next(current) {
    if (animating) return false;
    animating = true;

    current_fs = current.parent();
    next_fs = current.parent().next();

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
  }

  // method to go previous fieldset
  function change_form_previous(current) {
    if (animating) return false;
    animating = true;

    current_fs = current.parent();
    previous_fs = current.parent().prev();

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
  }

  var index_language = 1;
  // method to append new language
  function append_language() {
    index_language++;
    var others_language_html = '<div class="form-group"><h5>Language</h5><input class="form-control" type="text" name="languages[' + index_language + '][language]" placeholder="ex. Arabian"/></div>';
    others_language_html += '<div class="form-group text-left">';
    others_language_html += '<h5>Proficiency</h5>';
    others_language_html += '<input type="radio" name="languages[' + index_language + '][proficiency]" id="others_' + index_language + '_basic" value="Basic"> <label class="form-check-label" for="others_' + index_language + '_basic">Basic</label> ';
    others_language_html += '<input type="radio" name="languages[' + index_language + '][proficiency]" id="others_' + index_language + '_good" value="Good"> <label class="form-check-label" for="others_' + index_language + '_good">Good</label> ';
    others_language_html += '<input type="radio" name="languages[' + index_language + '][proficiency]" id="others_' + index_language + '_fluent" value="Fluent"> <label class="form-check-label" for="others_' + index_language + '_fluent">Fluent</label> ';
    others_language_html += '<input type="radio" name="languages[' + index_language + '][proficiency]" id="others_' + index_language + '_native" value="Native"> <label class="form-check-label" for="others_' + index_language + '_native">Native</label> ';
    others_language_html += '</div>';

    $('.others_languange_wrapper').append(others_language_html);
  }

  var date_now = new Date();
  var year = date_now.getFullYear();
  index_education = 1;

  // method to append new education
  function append_education() {
    index = index_education++;
    var others_education_html = '<div class="form-group"><h5>University</h5><input class="form-control" id="university" type="text" name="education[' + index + '][university]" placeholder="ex. Oxford University"/></div>';
    others_education_html += '<div class="form-group"><h5>Field of study</h5><input class="form-control" id="field_of_study" type="text" name="education[' + index + '][field_of_study]" placeholder="ex. Information System"/></div>';
    others_education_html += '<div class="form-group"><h5>Degree</h5><input class="form-control" id="degree" type="text" name="education[' + index + '][degree]" placeholder="ex. Bachelor Degree"/></div>';
    others_education_html += '<div class="row">';
    others_education_html += '<div class="col-6"><h5>Start Year</h5><div class="form-group"><select class="form-control" name="education[' + index + '][start_year]" id="start_year"><option disabled selected>Pilih</option>';
    for (var i = 1950; i < year; i++) {
      others_education_html += '<option value="' + i + '">' + i + '</option>';
    }
    others_education_html += '</select></div></div>';
    others_education_html += '<div class="col-6"><h5>End Year(or expected)</h5><div class="form-group"><select class="form-control" name="education[' + index + '][end_year]" id="end_year"><option disabled selected> Pilih </option>';
    for (var i = 1950; i < year + 5; i++) {
      others_education_html += '<option value="' + i + '">' + i + '</option>';
    }
    others_education_html += '</select></div></div>';
    others_education_html += '</div><hr class="mt-0">';

    $('.eduacation_wrapper').append(others_education_html);
  }

  //method to append new work experiences
  index_work_experience = 1;

  function append_work_experience() {
    index = index_work_experience++;

    var others_work_experience_html =
      `<div class="form-group">
          <h5>Company</h5>
          <input class="form-control" id="company" type="text" name="work_experiences[` + index + `][company]" placeholder="ex. PT. Wahana Integra Nusantara"/>
        </div>
        <div class="form-group">
          <h5>Location</h5>
          <input class="form-control" id="location" type="text" name="work_experiences[` + index + `][location]" placeholder="ex. Street name, City, Province, Nation" />
        </div>
        <div class="form-group">
          <h5>Current Position</h5>
          <input class="form-control" id="current_position" type="text" name="work_experiences[` + index + `][position]" placeholder="ex. Manager"/>
        </div>
        <div class="row">
          <div class="col-3">
            <h5>Entry</h5>
            <div class="form-group">
              <select class="form-control" name="work_experiences[` + index + `][entry_month]" id="entry_month">
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
              <select class="form-control" name="work_experiences[` + index + `][entry_year]" id="entry_year">
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
              <select class="form-control" name="work_experiences[` + index + `][out_month]" id="out_month">
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
              <input class="form-check-input" type="radio" name="work_experiences[` + index + `][is_currently_work]"
              id="is_currently_work" value="Yes">
              <label class="form-check-label" for="is_currently_work">
                No, I currently work here
              </label>
            </div>
          </div>
          <div class="col-3">
            <h5>&nbsp;</h5>
            <div class="form-group">
              <select class="form-control" name="work_experiences[` + index + `][out_year]" id="out_year">
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
          <textarea class="form-control" id="description" type="text" name="work_experiences[` + index + `][description]"></textarea>
        </div>
        <hr class="mt-0">`;

    $('.work_experiences_wrapper').append(others_work_experience_html);
  }
</script>
@endpush
