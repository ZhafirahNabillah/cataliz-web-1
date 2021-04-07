@extends('layouts.layoutFull')

@section('title','Signup')

@section('content')

<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-wrapper">
    <div class="content-body">
      <div class="auth-wrapper auth-v2">
        <div class="auth-inner row m-0">
          <!-- Brand logo-->
          <a class="brand-logo" href="/">
            @include('panels.logo')
          </a>
          <!-- /Brand logo-->
          <!-- Left Text-->
          <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid"
                src="{{asset('assets/images/pages/login-v2.svg')}}" alt="Login V2" /></div>
          </div>
          <!-- /Left Text-->
          <!-- Register-->
          <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
              @if ($message = Session::get('success'))
              <div class="alert alert-success alert-dissmisable">
                <h4 class="alert-heading">Success</h4>
                <div class="alert-body">{{ $message }}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <spanaria-hidden="true">×</span>
                </button>
              </div>
              @endif
              @if ($message = Session::get('error'))
              <div class="alert alert-danger alert-dissmisable">
                <h4 class="alert-heading">Sorry</h4>
                <div class="alert-body">{{ $message }}</div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <spanaria-hidden="true">×</span>
                </button>
              </div>
              @endif
              <h4 class="card-title mb-1">Adventure starts here 🚀</h4>
              <p class="card-text mb-2">Create your own account and join with us!</p>
              <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                  <label class="form-label" for="register-username">Fullname</label>
                  <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name"
                    placeholder="John Doe" aria-describedby="name" value="{{ old('name') }}" autocomplete="name"
                    autofocus tabindex="1" />
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label" for="register-phone">Phone</label>
                  <div class="input-group input-group-merge mb-16">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon5">+62</span>
                    </div>
                    <input class="form-control @error('phone') is-invalid @enderror" id="phone" type="text"
                      onkeypress="return isNumberKey(event)" name="phone" placeholder="081xxxxx"
                      aria-describedby="phone" value="{{ old('phone') }}" autocomplete="phone" tabindex="2" />
                  </div>
                  @error('phone')
                  <strong class="text-danger">{{ $message }}</strong>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label" for="register-email">Email</label>
                  <input class="form-control @error('email') is-invalid @enderror" id="email" type="text" name="email"
                    placeholder="john@example.com" aria-describedby="email" value="{{ old('email') }}"
                    autocomplete="email" tabindex="3" />
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label" for="register-password">Password</label>
                  <div class="input-group input-group-merge form-password-toggle">
                    <input class="form-control form-control-merge @error('password') is-invalid @enderror" id="password"
                      type="password" name="password" autocomplete="new-password" placeholder="············"
                      aria-describedby="password" tabindex="3" />
                    <div class="input-group-append"><span class="input-group-text cursor-pointer "><i
                          data-feather="eye"></i></span></div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label" for="register-password">Confirm Password</label>
                  <div class="input-group input-group-merge form-password-toggle">
                    <input class="form-control form-control-merge" id="password-confirm" type="password"
                      name="password_confirmation" placeholder="············" aria-describedby="password_confirmation"
                      autocomplete="new-password" tabindex="4" />
                    <div class="input-group-append"><span class="input-group-text cursor-pointer"><i
                          data-feather="eye"></i></span></div>
                  </div>
                </div>
                <h5>Register as</h5>
                <div class="form-group demo-inline-spacing" style="margin-top: -18px;">
                  <div class="custom-control custom-radio col-3">
                    <input type="radio" id="role_coach" name="role"
                      class="custom-control-input @error('role') is-invalid @enderror" value="coach" />
                    <label class="custom-control-label" for="role_coach">Coach</label>
                  </div>
                  <div class="custom-control custom-radio col text-left">
                    <input type="radio" id="role_coachee" name="role"
                      class="custom-control-input @error('role') is-invalid @enderror" value="coachee" />
                    <label class="custom-control-label" for="role_coachee">Coachee</label>
                  </div>
                </div>
                <div class="form-group demo-inline-spacing" style="margin-top: -25px;">
                  <div class="custom-control custom-radio col-3">
                    <input type="radio" id="role_trainer" name="role"
                      class="custom-control-input @error('role') is-invalid @enderror" value="trainer" />
                    <label class="custom-control-label" for="role_trainer">Trainer</label>
                  </div>
                  <div class="custom-control custom-radio col text-left">
                    <input type="radio" id="role_mentor" name="role"
                      class="custom-control-input @error('role') is-invalid @enderror" value="mentor" />
                    <label class="custom-control-label" for="role_mentor">Mentor</label>
                  </div>
                  @error('role')
                  <strong class="text-danger">{{ $message }}</strong>
                  @enderror
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input @error('privacy') is-invalid @enderror"
                      id="register-privacy-policy" name="privacy" value="ok" type="checkbox" tabindex="4" />
                    <label class="custom-control-label" for="register-privacy-policy">I agree to<a href="javascript:;"
                        id="showPrivacy">&nbsp;privacy policy & terms</a></label>
                  </div>
                  @error('privacy')
                  <strong class="text-danger">{{ $message }}</strong>
                  @enderror
                </div>

                <!-- Modal Privacy policy & terms -->
                <div class="modal fade" id="privacy" tabindex="-1" aria-labelledby="exampleModalScrollableTitle"
                  aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <div class="card-body">
                          <ul class="nav nav-tabs justify-content-center" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="coach-tab" data-toggle="tab" href="#coach"
                                aria-controls="coach" role="tab" aria-selected="true">Privacy and Policy</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#coachee"
                                aria-controls="profile" role="tab" aria-selected="false">Terms and Conditions</a>
                            </li>
                          </ul>

                          <div class="tab-content">
                            <!-- Panel privacy -->
                            <div class="tab-pane active" id="coach" aria-labelledby="coach-tab" role="tabpanel">

                              <h2 class="text-warning">Privacy Policy for cataliz.id</h2>
                              <p class="text-justify">At cataliz.id, accessible from <a
                                  href="http://app.cataliz.id">http://app.cataliz.id</a> , one of our main priorities is
                                the privacy of our visitors. This Privacy Policy document contains types of information
                                that is collected and recorded by cataliz.id and how we use it.</p>
                              <p class="text-justify">If you have additional questions or require more information about
                                our Privacy Policy, do not hesitate to contact us.</p>
                              <h4 class="text-primary">Log Files </h4>
                              <p class="text-justify">cataliz.id follows a standard procedure of using log files. These
                                files log visitors when they visit websites. All hosting companies do this and a part of
                                hosting services' analytics. The information collected by log files include internet
                                protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time
                                stamp, referring/exit pages, and possibly the number of clicks. These are not linked to
                                any information that is personally identifiable. The purpose of the information is for
                                analyzing trends, administering the site, tracking users' movement on the website, and
                                gathering demographic information. Our Privacy Policy was created with the help of the
                                Privacy Policy Generator and the Privacy Policy Generator.</p>
                              <h4 class="text-primary">Cookies and Web Beacons</h4>
                              <p class="text-justify">Like any other website, cataliz.id uses 'cookies'. These cookies
                                are used to store information including visitors' preferences, and the pages on the
                                website that the visitor accessed or visited. The information is used to optimize the
                                users' experience by customizing our web page content based on visitors' browser type
                                and/or other information.</p>
                              <p class="text-justify">For more general information on cookies, please read the "What Are
                                Cookies" article on Cookie Consent website.</p>
                              <h4 class="text-primary">Privacy Policies</h4>
                              <p class="text-justify">You may consult this list to find the Privacy Policy for each of
                                the advertising partners of cataliz.id.</p>
                              <p class="text-justify">Third-party ad servers or ad networks uses technologies like
                                cookies, JavaScript, or Web Beacons that are used in their respective advertisements and
                                links that appear on cataliz.id, which are sent directly to users' browser. They
                                automatically receive your IP address when this occurs. These technologies are used to
                                measure the effectiveness of their advertising campaigns and/or to personalize the
                                advertising content that you see on websites that you visit.</p>
                              <p class="text-justify">Note that cataliz.id has no access to or control over these
                                cookies that are used by third-party advertisers.</p>
                              <h4 class="text-primary">Third Party Privacy Policies</h4>
                              <p class="text-justify">cataliz.id's Privacy Policy does not apply to other advertisers or
                                websites. Thus, we are advising you to consult the respective Privacy Policies of these
                                third-party ad servers for more detailed information. It may include their practices and
                                instructions about how to opt-out of certain options.</p>
                              <p class="text-justify">You can choose to disable cookies through your individual browser
                                options. To know more detailed information about cookie management with specific web
                                browsers, it can be found at the browsers' respective websites. What Are Cookies?</p>
                              <h4 class="text-primary">Children's Information</h4>
                              <p class="text-justify">Another part of our priority is adding protection for children
                                while using the internet. We encourage parents and guardians to observe, participate in,
                                and/or monitor and guide their online activity.</p>
                              <p class="text-justify">cataliz.id does not knowingly collect any Personal Identifiable
                                Information from children under the age of 13. If you think that your child provided
                                this kind of information on our website, we strongly encourage you to contact us
                                immediately and we will do our best efforts to promptly remove such information from our
                                records.</p>
                              <h4 class="text-primary">Online Privacy Policy Only</h4>
                              <p class="text-justify">This Privacy Policy applies only to our online activities and is
                                valid for visitors to our website with regards to the information that they shared
                                and/or collect in cataliz.id. This policy is not applicable to any information collected
                                offline or via channels other than this website.</p>
                              <h4 class="text-primary">Consent</h4>
                              <p class="text-justify">By using our website, you hereby consent to our Privacy Policy and
                                agree to its Terms and Conditions.</p>
                            </div>
                            <!-- /panel privacy -->


                            <!-- Panel term -->
                            <div class="tab-pane" id="coachee" aria-labelledby="coachee-tab" role="tabpanel">

                              <h2 class="text-warning">Terms and Conditions</h2>
                              <p class="text-justify">Welcome to cataliz.id!</p>
                              <p class="text-justify">These terms and conditions outline the rules and regulations for
                                the use of cataliz.id's Website, located at <a
                                  href="http://app.cataliz.id">http://app.cataliz.id</a>.</p>
                              <p class="text-justify">By accessing this website we assume you accept these terms and
                                conditions. Do not continue to use cataliz.id if you do not agree to take all of the
                                terms and conditions stated on this page.</p>
                              <p class="text-justify">The following terminology applies to these Terms and Conditions,
                                Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your"
                                refers to you, the person log on this website and compliant to the Company’s terms and
                                conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company.
                                "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms refer to
                                the offer, acceptance and consideration of payment necessary to undertake the process of
                                our assistance to the Client in the most appropriate manner for the express purpose of
                                meeting the Client’s needs in respect of provision of the Company’s stated services, in
                                accordance with and subject to, prevailing law of Netherlands. Any use of the above
                                terminology or other words in the singular, plural, capitalization and/or he/she or
                                they, are taken as interchangeable and therefore as referring to same. Our Terms and
                                Conditions were created with the help of the Terms & Conditions Generator and the
                                Privacy Policy Generator.</p>

                              <h4 class="text-primary">Cookies</h4>
                              <p class="text-justify">We employ the use of cookies. By accessing cataliz.id, you agreed
                                to use cookies in agreement with the cataliz.id's Privacy Policy.</p>
                              <p class="text-justify">Most interactive websites use cookies to let us retrieve the
                                user’s details for each visit. Cookies are used by our website to enable the
                                functionality of certain areas to make it easier for people visiting our website. Some
                                of our affiliate/advertising partners may also use cookies.</p>
                              <h4 class="text-primary">License</h4>
                              <p class="text-justify">Unless otherwise stated, cataliz.id and/or its licensors own the
                                intellectual property rights for all material on cataliz.id. All intellectual property
                                rights are reserved. You may access this from cataliz.id for your own personal use
                                subjected to restrictions set in these terms and conditions.</p>
                              <p class="text-justify">You must not:</p>
                              <ul class="list-unstyled">
                                <ul>
                                  <li>Republish material from cataliz.id</li>
                                  <li>Sell, rent or sub-license material from cataliz.id</li>
                                  <li>Reproduce, duplicate or copy material from cataliz.id</li>
                                  <li>Redistribute content from cataliz.id</li>
                                </ul>
                              </ul>
                              <p class="text-justify">This Agreement shall begin on the date hereof.</p>
                              <p class="text-justify">Parts of this website offer an opportunity for users to post and
                                exchange opinions and information in certain areas of the website. cataliz.id does not
                                filter, edit, publish or review Comments prior to their presence on the website.
                                Comments do not reflect the views and opinions of cataliz.id,its agents and/or
                                affiliates. Comments reflect the views and opinions of the person who post their views
                                and opinions. To the extent permitted by applicable laws, cataliz.id shall not be liable
                                for the Comments or for any liability, damages or expenses caused and/or suffered as a
                                result of any use of and/or posting of and/or appearance of the Comments on this
                                website.</p>
                              <p class="text-justify">cataliz.id reserves the right to monitor all Comments and to
                                remove any Comments which can be considered inappropriate, offensive or causes breach of
                                these Terms and Conditions.</p>
                              <p class="text-justify">You warrant and represent that:</p>
                              <ul class="list-unstyled">
                                <ul>
                                  <li>You are entitled to post the Comments on our website and have all necessary
                                    licenses and consents to do so;</li>
                                  <li>The Comments do not invade any intellectual property right, including without
                                    limitation copyright, patent or trademark of any third party;</li>
                                  <li>The Comments do not contain any defamatory, libelous, offensive, indecent or
                                    otherwise unlawful material which is an invasion of privacy</li>
                                  <li>The Comments will not be used to solicit or promote business or custom or present
                                    commercial activities or unlawful activity.</li>
                                </ul>
                              </ul>
                              <p class="text-justify">You hereby grant cataliz.id a non-exclusive license to use,
                                reproduce, edit and authorize others to use, reproduce and edit any of your Comments in
                                any and all forms, formats or media.</p>
                              <h4 class="text-primary">Hyperlinking to our Content</h4>
                              <p class="text-justify">The following organizations may link to our Website without prior
                                written approval:</p>
                              <ul class="list-unstyled">
                                <ul>
                                  <li>Government agencies;</li>
                                  <li>Search engines;</li>
                                  <li>News organizations;</li>
                                  <li>Online directory distributors may link to our Website in the same manner as they
                                    hyperlink to the Websites of other listed businesses; and</li>
                                  <li>System wide Accredited Businesses except soliciting non-profit organizations,
                                    charity shopping malls, and charity fundraising groups which may not hyperlink to
                                    our Web site.</li>
                                </ul>
                              </ul>
                              <p class="text-justify">These organizations may link to our home page, to publications or
                                to other Website information so long as the link: </p>
                              <ul>(a) is not in any way deceptive; </ul>
                              <ul>(b) does not falsely imply sponsorship, endorsement or approval of the linking party
                                and its products and/or services; and </ul>
                              <ul>(c) fits within the context of the linking party’s site.</ul>

                              <p class="text-justify">We may consider and approve other link requests from the following
                                types of organizations:</p>
                              <ul class="list-unstyled">
                                <ul>
                                  <li>commonly-known consumer and/or business information sources;</li>
                                  <li>dot.com community sites;</li>
                                  <li>associations or other groups representing charities;</li>
                                  <li>online directory distributors;</li>
                                  <li>internet portals;</li>
                                  <li>accounting, law and consulting firms; and</li>
                                  <li>educational institutions and trade associations.</li>
                                </ul>
                              </ul>
                              <p class="text-justify">We will approve link requests from these organizations if we
                                decide that:</p>
                              <ul>(a) the link would not make us look unfavorably to ourselves or to our accredited
                                businesses; </ul>
                              <ul>(b) the organization does not have any negative records with us;</ul>
                              <ul>(c) the benefit to us from the visibility of the hyperlink compensates the absence of
                                cataliz.id; and </ul>
                              <ul>(d) the link is in the context of general resource information.</ul>

                              <p class="text-justify">These organizations may link to our home page so long as the link:
                              </p>
                              <ul>(a) is not in any way deceptive; </ul>
                              <ul>(b) does not falsely imply sponsorship, endorsement or approval of the linking party
                                and its products or services; and</ul>
                              <ul>(c) fits within the context of the linking party’s site.</ul>
                              <p class="text-justify">If you are one of the organizations listed in paragraph 2 above
                                and are interested in linking to our website, you must inform us by sending an e-mail to
                                cataliz.id. Please include your name, your organization name, contact information as
                                well as the URL of your site, a list of any URLs from which you intend to link to our
                                Website, and a list of the URLs on our site to which you would like to link. Wait 2-3
                                weeks for a response.</p>
                              <p class="text-justify">Approved organizations may hyperlink to our Website as follows:
                              </p>
                              <ul class="list-unstyled">
                                <ul>
                                  <li>By use of our corporate name; or</li>
                                  <li>By use of the uniform resource locator being linked to; or</li>
                                  <li>By use of any other description of our Website being linked to that makes sense
                                    within the context and format of content on the linking party’s site.</li>
                                </ul>
                              </ul>
                              <p class="text-justify">No use of cataliz.id's logo or other artwork will be allowed for
                                linking absent a trademark license agreement.</p>


                              <h4 class="text-primary">iFrames</h4>
                              <p class="text-justify">Without prior approval and written permission, you may not create
                                frames around our Webpages that alter in any way the visual presentation or appearance
                                of our Website.</p>

                              <h4 class="text-primary">Content Liability</h4>
                              <p class="text-justify">We shall not be hold responsible for any content that appears on
                                your Website. You agree to protect and defend us against all claims that is rising on
                                your Website. No link(s) should appear on any Website that may be interpreted as
                                libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the
                                infringement or other violation of, any third party rights.</p>

                              <h4 class="text-primary">Reservation of Rights</h4>
                              <p class="text-justify">We reserve the right to request that you remove all links or any
                                particular link to our Website. You approve to immediately remove all links to our
                                Website upon request. We also reserve the right to amen these terms and conditions and
                                it’s linking policy at any time. By continuously linking to our Website, you agree to be
                                bound to and follow these linking terms and conditions.</p>

                              <h4 class="text-primary">Removal of links from our website</h4>
                              <p class="text-justify">If you find any link on our Website that is offensive for any
                                reason, you are free to contact and inform us any moment. We will consider requests to
                                remove links but we are not obligated to or so or to respond to you directly.</p>
                              <p class="text-justify">We do not ensure that the information on this website is correct,
                                we do not warrant its completeness or accuracy; nor do we promise to ensure that the
                                website remains available or that the material on the website is kept up to date.</p>
                              <h4 class="text-primary">Disclaimer</h4>
                              <p class="text-justify">To the maximum extent permitted by applicable law, we exclude all
                                representations, warranties and conditions relating to our website and the use of this
                                website. Nothing in this disclaimer will:</p>
                              <ul class="list-unstyled">
                                <ul>
                                  <li>limit or exclude our or your liability for death or personal injury;</li>
                                  <li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;
                                  </li>
                                  <li>limit any of our or your liabilities in any way that is not permitted under
                                    applicable law; or</li>
                                  <li>exclude any of our or your liabilities that may not be excluded under applicable
                                    law.r</li>
                                </ul>
                              </ul>

                              <p class="text-justify">The limitations and prohibitions of liability set in this Section
                                and elsewhere in this disclaimer:</p>
                              <ul> (a) are subject to the preceding paragraph; and </ul>
                              <ul>(b) govern all liabilities arising under the disclaimer, including liabilities arising
                                in contract, in tort and for breach of statutory duty.</ul>
                              <p class="text-justify">As long as the website and the information and services on the
                                website are provided free of charge, we will not be liable for any loss or damage of any
                                nature.</p>
                            </div>

                            <!-- /Panel term -->
                          </div>
                        </div>

                        <!-- /panel term -->
                      </div>
                      <div class="modal-footer">
                        <div class="col-sm-12 text-center">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">I Understand</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <button class="btn btn-primary btn-block" tabindex="5">Sign up</button>
              </form>
              <p class="text-center mt-2"><span>Already have an account?</span><a
                  href="{{route('login')}}"><span>&nbsp;Sign in instead</span></a></p>
            </div>
          </div>
          <!-- /Register-->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END: Content-->
@endsection

@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script> --}}
<script type="text/javascript">
  $(document).on('click', '#showPrivacy', function() {
    $('#privacy').modal('show');
  });

  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
    return true;
  }
</script>
@endpush