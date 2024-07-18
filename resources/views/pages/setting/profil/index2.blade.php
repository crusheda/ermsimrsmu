@extends('layouts.index')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboardx') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Profil Akun</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Profil Akun</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end --><!-- [ Main Content ] start -->
    <div class="row"><!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body py-0">
                    <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab"
                                href="#profile-1" role="tab" aria-selected="true">
                                <i class="ti ti-user me-2"></i>Profil Pengguna
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab"
                                href="#profile-2" role="tab" aria-selected="true">
                                <i class="ti ti-file-text me-2"></i>Ubah Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab"
                                href="#profile-3" role="tab" aria-selected="true">
                                <i class="ti ti-id me-2"></i><s>My Account</s>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab"
                                href="#profile-4" role="tab" aria-selected="true">
                                <i class="ti ti-lock me-2"></i>Ubah Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-5" data-bs-toggle="tab"
                                href="#profile-5" role="tab" aria-selected="true">
                                <i class="ti ti-users me-2"></i><s>Role</s>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-6" data-bs-toggle="tab"
                                href="#profile-6" role="tab" aria-selected="true">
                                <i class="ti ti-settings me-2"></i><s>Settings</s>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane show active" id="profile-1" role="tabpanel"
                    aria-labelledby="profile-tab-1">
                    <div class="row">
                        <div class="col-lg-4 col-xxl-3">
                            <div class="card">
                                <div class="card-body position-relative">
                                    {{-- <div class="position-absolute end-0 top-0 p-3">
                                        <span class="badge bg-primary">Pro</span>
                                    </div> --}}
                                    <div class="text-center">
                                        <div class="chat-avtar d-inline-flex mx-auto mb-2">
                                            @if (empty($list['foto']->filename))
                                                <img class="rounded-circle img-fluid wid-70" src="{{ asset('images/pku/user.png') }}" alt="User image">
                                                {{-- <a class="image-popup-no-margins" href="{{ asset('images/pku/user.png') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Tekan untuk memperbesar foto profil">
                                                    <img class="img-fluid avatar-sm rounded-circle img-thumbnail" alt="" src="{{ asset('images/pku/user.png') }}" width="75">
                                                </a> --}}
                                            @else
                                                <img class="rounded-circle img-fluid wid-70" src="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" alt="User image">
                                                {{-- <a class="image-popup-no-margins" href="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Tekan untuk memperbesar foto profil">
                                                    <img class="img-fluid avatar-sm rounded-circle img-thumbnail" alt="" src="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" width="75">
                                                </a> --}}
                                            @endif
                                        </div>
                                        <h5 class="mb-0">Anshan H.</h5>
                                        <p class="text-muted text-sm">Project Manager</p>
                                        <hr class="my-3 border border-secondary-subtle">
                                        <div class="row g-3">
                                            <div class="col-4">
                                                <h5 class="mb-0">86</h5><small class="text-muted">Post</small>
                                            </div>
                                            <div class="col-4 border border-top-0 border-bottom-0">
                                                <h5 class="mb-0">40</h5><small
                                                    class="text-muted">Project</small>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0">4.5K</h5><small
                                                    class="text-muted">Members</small>
                                            </div>
                                        </div>
                                        <hr class="my-3 border border-secondary-subtle">
                                        <div
                                            class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="ti ti-mail me-2"></i>
                                            <p class="mb-0"><a href="../cdn-cgi/l/email-protection.html"
                                                    class="__cf_email__"
                                                    data-cfemail="f5949b869d949bb59298949c99db969a98">[email&#160;protected]</a>
                                            </p>
                                        </div>
                                        <div
                                            class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="ti ti-phone me-2"></i>
                                            <p class="mb-0">(+1-876) 8654 239 581</p>
                                        </div>
                                        <div
                                            class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="ti ti-map-pin me-2"></i>
                                            <p class="mb-0">New York</p>
                                        </div>
                                        <div
                                            class="d-inline-flex align-items-center justify-content-start w-100">
                                            <i class="ti ti-link me-2"></i> <a href="#" class="link-primary">
                                                <p class="mb-0">https://anshan.dh.url</p>
                                            </a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Skills</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <p class="mb-0">Junior</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <div class="progress progress-primary" style="height: 6px">
                                                        <div class="progress-bar" style="width: 30%"></div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <p class="mb-0 text-muted">30%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <p class="mb-0">UX Researcher</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <div class="progress progress-primary" style="height: 6px">
                                                        <div class="progress-bar" style="width: 80%"></div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <p class="mb-0 text-muted">80%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <p class="mb-0">Wordpress</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <div class="progress progress-primary" style="height: 6px">
                                                        <div class="progress-bar" style="width: 90%"></div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <p class="mb-0 text-muted">90%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <p class="mb-0">HTML</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <div class="progress progress-primary" style="height: 6px">
                                                        <div class="progress-bar" style="width: 30%"></div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <p class="mb-0 text-muted">30%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <p class="mb-0">Graphic Design</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <div class="progress progress-primary" style="height: 6px">
                                                        <div class="progress-bar" style="width: 95%"></div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <p class="mb-0 text-muted">95%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <p class="mb-0">Code Style</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <div class="progress progress-primary" style="height: 6px">
                                                        <div class="progress-bar" style="width: 75%"></div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <p class="mb-0 text-muted">75%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xxl-9">
                            <div class="card">
                                <div class="card-header">
                                    <h5>About me</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">Hello, I’m Anshan Handgun Creative Graphic Designer & User
                                        Experience Designer based in Website, I create digital Products a more
                                        Beautiful and usable place. Morbid accusant ipsum. Nam nec tellus at.
                                    </p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Personal Details</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Full Name</p>
                                                    <p class="mb-0">Anshan Handgun</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Father Name</p>
                                                    <p class="mb-0">Mr. Deepen Handgun</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Phone</p>
                                                    <p class="mb-0">(+1-876) 8654 239 581</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Country</p>
                                                    <p class="mb-0">New York</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Email</p>
                                                    <p class="mb-0"><a href="../cdn-cgi/l/email-protection.html"
                                                            class="__cf_email__"
                                                            data-cfemail="2f4e415c474e41014b47171e6f48424e4643014c4042">[email&#160;protected]</a>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Zip Code</p>
                                                    <p class="mb-0">956 754</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <p class="mb-1 text-muted">Address</p>
                                            <p class="mb-0">Street 110-B Kalians Bag, Dewan, M.P. New York</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Education</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Master Degree (Year)</p>
                                                    <p class="mb-0">2014-2017</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Institute</p>
                                                    <p class="mb-0">-</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Bachelor (Year)</p>
                                                    <p class="mb-0">2011-2013</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Institute</p>
                                                    <p class="mb-0">Imperial College London</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">School (Year)</p>
                                                    <p class="mb-0">2009-2011</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Institute</p>
                                                    <p class="mb-0">School of London, England</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Employment</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Senior</p>
                                                    <p class="mb-0">Senior UI/UX designer (Year)</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Job Responsibility</p>
                                                    <p class="mb-0">Perform task related to project manager with
                                                        the 100+ team under my observation. Team management is
                                                        key role in this company.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Trainee cum Project Manager
                                                        (Year)</p>
                                                    <p class="mb-0">2017-2019</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Job Responsibility</p>
                                                    <p class="mb-0">Team management is key role in this company.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">School (Year)</p>
                                                    <p class="mb-0">2009-2011</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Institute</p>
                                                    <p class="mb-0">School of London, England</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Personal Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 text-center mb-3">
                                            <div class="user-upload wid-75"><img
                                                    src="../assets/images/user/avatar-4.jpg" alt="img"
                                                    class="img-fluid"> <label for="uplfile"
                                                    class="img-avtar-upload"><i
                                                        class="ti ti-camera f-24 mb-1"></i>
                                                    <span>Upload</span></label> <input type="file" id="uplfile"
                                                    class="d-none"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">First Name</label>
                                                <input type="text" class="form-control" value="Anshan"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Last Name</label> <input
                                                    type="text" class="form-control" value="Handgun"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Country</label> <input
                                                    type="text" class="form-control" value="New York"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Zip code</label> <input
                                                    type="text" class="form-control" value="956754"></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3"><label class="form-label">Bio</label> <textarea
                                                    class="form-control">Hello, I’m Anshan Handgun Creative Graphic Designer & User Experience Designer based in Website, I create digital Products a more Beautiful and usable place. Morbid accusant ipsum. Nam nec tellus at.</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3"><label class="form-label">Experience</label>
                                                <select class="form-control">
                                                    <option>Startup</option>
                                                    <option>2 year</option>
                                                    <option>3 year</option>
                                                    <option selected="selected">4 year</option>
                                                    <option>5 year</option>
                                                </select></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Social Network</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-grow-1 me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-twitter"><i
                                                            class="fab fa-twitter f-16"></i></div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">Twitter</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0"><button
                                                class="btn btn-link-primary">Connect</button></div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-grow-1 me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-facebook"><i
                                                            class="fab fa-facebook-f f-16"></i></div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">Facebook <small
                                                            class="text-muted f-w-400">/Anshan Handgun</small>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0"><button
                                                class="btn btn-link-danger">Remove</button></div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-linkedin"><i
                                                            class="fab fa-linkedin-in f-16"></i></div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">Linkedin</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0"><button
                                                class="btn btn-link-primary">Connect</button></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Contact Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Contact Phone</label>
                                                <input type="text" class="form-control"
                                                    value="(+99) 9999 999 999"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Email <span
                                                        class="text-danger">*</span></label> <input type="text"
                                                    class="form-control" value="demo@sample.com"></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3"><label class="form-label">Portfolio Url</label>
                                                <input type="text" class="form-control"
                                                    value="https://demo.com/"></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3"><label class="form-label">Address</label>
                                                <textarea
                                                    class="form-control">3379  Monroe Avenue, Fort Myers, Florida(33912)</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end btn-page">
                            <div class="btn btn-outline-secondary">Cancel</div>
                            <div class="btn btn-primary">Update Profile</div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>General Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Username <span
                                                        class="text-danger">*</span></label> <input type="text"
                                                    class="form-control" value="Ashoka_Tano_16"> <small
                                                    class="form-text text-muted">Your Profile URL:
                                                    https://pc.com/Ashoka_Tano_16</small></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Account Email <span
                                                        class="text-danger">*</span></label> <input type="text"
                                                    class="form-control" value="demo@sample.com"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Language</label> <select
                                                    class="form-control">
                                                    <option>Washington</option>
                                                    <option>India</option>
                                                    <option>Africa</option>
                                                    <option>New York</option>
                                                    <option>Malaysia</option>
                                                </select></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Sign in Using</label>
                                                <select class="form-control">
                                                    <option>Password</option>
                                                    <option>Face Recognition</option>
                                                    <option>Thumb Impression</option>
                                                    <option>Key</option>
                                                    <option>Pin</option>
                                                </select></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Advance Settings</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-1">Secure Browsing</p>
                                                    <p class="text-muted text-sm mb-0">Browsing Securely ( https
                                                        ) when it's necessary</p>
                                                </div>
                                                <div class="form-check form-switch p-0"><input
                                                        class="form-check-input h4 position-relative m-0"
                                                        type="checkbox" role="switch" checked=""></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-1">Login Notifications</p>
                                                    <p class="text-muted text-sm mb-0">Notify when login
                                                        attempted from other place</p>
                                                </div>
                                                <div class="form-check form-switch p-0"><input
                                                        class="form-check-input h4 position-relative m-0"
                                                        type="checkbox" role="switch" checked=""></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-1">Login Approvals</p>
                                                    <p class="text-muted text-sm mb-0">Approvals is not required
                                                        when login from unrecognized devices.</p>
                                                </div>
                                                <div class="form-check form-switch p-0"><input
                                                        class="form-check-input h4 position-relative m-0"
                                                        type="checkbox" role="switch" checked=""></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recognized Devices</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <p class="mb-2">Celt Desktop</p>
                                                    <p class="mb-0 text-muted">4351 Deans Lane</p>
                                                </div>
                                                <div class="">
                                                    <div class="text-success d-inline-block me-2"><i
                                                            class="fas fa-circle f-10 me-2"></i> Current Active
                                                    </div><a href="#!" class="text-danger"><i
                                                            class="feather icon-x-circle"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <p class="mb-2">Imco Tablet</p>
                                                    <p class="mb-0 text-muted">4185 Michigan Avenue</p>
                                                </div>
                                                <div class="">
                                                    <div class="text-muted d-inline-block me-2"><i
                                                            class="fas fa-circle f-10 me-2"></i> 5 days ago
                                                    </div><a href="#!" class="text-danger"><i
                                                            class="feather icon-x-circle"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <p class="mb-2">Albs Mobile</p>
                                                    <p class="mb-0 text-muted">3462 Fairfax Drive</p>
                                                </div>
                                                <div class="">
                                                    <div class="text-muted d-inline-block me-2"><i
                                                            class="fas fa-circle f-10 me-2"></i> 1 month ago
                                                    </div><a href="#!" class="text-danger"><i
                                                            class="feather icon-x-circle"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Active Sessions</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <p class="mb-2">Celt Desktop</p>
                                                    <p class="mb-0 text-muted">4351 Deans Lane</p>
                                                </div><button class="btn btn-link-danger">Logout</button>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <p class="mb-2">Moon Tablet</p>
                                                    <p class="mb-0 text-muted">4185 Michigan Avenue</p>
                                                </div><button class="btn btn-link-danger">Logout</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end"><button class="btn btn-outline-dark ms-2">Clear</button>
                            <button class="btn btn-primary">Update Profile</button></div>
                    </div>
                </div>
                <div class="tab-pane" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Change Password</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3"><label class="form-label">Old Password</label> <input
                                            type="password" class="form-control"></div>
                                    <div class="mb-3"><label class="form-label">New Password</label> <input
                                            type="password" class="form-control"></div>
                                    <div class="mb-3"><label class="form-label">Confirm Password</label> <input
                                            type="password" class="form-control"></div>
                                </div>
                                <div class="col-sm-6">
                                    <h5>New password must contain:</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><i
                                                class="ti ti-circle-check text-success f-16 me-2"></i> At least
                                            8 characters</li>
                                        <li class="list-group-item"><i
                                                class="ti ti-circle-check text-success f-16 me-2"></i> At least
                                            1 lower letter (a-z)</li>
                                        <li class="list-group-item"><i
                                                class="ti ti-circle-check text-success f-16 me-2"></i> At least
                                            1 uppercase letter(A-Z)</li>
                                        <li class="list-group-item"><i
                                                class="ti ti-circle-check text-success f-16 me-2"></i> At least
                                            1 number (0-9)</li>
                                        <li class="list-group-item"><i
                                                class="ti ti-circle-check text-success f-16 me-2"></i> At least
                                            1 special characters</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end btn-page">
                            <div class="btn btn-outline-secondary">Cancel</div>
                            <div class="btn btn-primary">Update Profile</div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile-5" role="tabpanel" aria-labelledby="profile-tab-5">
                    <div class="card">
                        <div class="card-header">
                            <h5>Invite Team Members</h5>
                        </div>
                        <div class="card-body">
                            <h4>5/10 <small>members available in your plan.</small></h4>
                            <hr class="my-3">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3"><label class="form-label">Email Address</label>
                                        <div class="row">
                                            <div class="col"><input type="email" class="form-control"></div>
                                            <div class="col-auto"><button class="btn btn-primary">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>MEMBER</th>
                                            <th>ROLE</th>
                                            <th class="text-end">STATUS</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-1.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Addie Bass</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="1974786b7c6f78597e74787075377a7674">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-primary">Owner</span></td>
                                            <td class="text-end"><span class="badge bg-success">Joined</span>
                                            </td>
                                            <td class="text-end"><a href="#"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-4.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Agnes McGee</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="f59d909794b59298949c99db969a98">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-info">Manager</span></td>
                                            <td class="text-end"><a href="#"
                                                    class="btn btn-link-danger">Resend</a> <span
                                                    class="badge bg-light-success">Invited</span></td>
                                            <td class="text-end"><a href="#"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-5.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Agnes McGee</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="036b66616243646e626a6f2d606c6e">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-warning">Staff</span></td>
                                            <td class="text-end"><span class="badge bg-success">Joined</span>
                                            </td>
                                            <td class="text-end"><a href="#"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-1.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Addie Bass</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="6d000c1f081b0c2d0a000c0401430e0200">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-primary">Owner</span></td>
                                            <td class="text-end"><span class="badge bg-success">Joined</span>
                                            </td>
                                            <td class="text-end"><a href="#"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-4.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Agnes McGee</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="ea828f888baa8d878b8386c4898587">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-info">Manager</span></td>
                                            <td class="text-end"><a href="#"
                                                    class="btn btn-link-danger">Resend</a> <span
                                                    class="badge bg-light-success">Invited</span></td>
                                            <td class="text-end"><a href="#"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-5.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Agnes McGee</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="fa929f989bba9d979b9396d4999597">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-warning">Staff</span></td>
                                            <td class="text-end"><span class="badge bg-success">Joined</span>
                                            </td>
                                            <td class="text-end"><a href="#"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-1.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Addie Bass</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="7c111d0e190a1d3c1b111d1510521f1311">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-primary">Owner</span></td>
                                            <td class="text-end"><span class="badge bg-success">Joined</span>
                                            </td>
                                            <td class="text-end"><a href="#"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-4.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Agnes McGee</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="cfa7aaadae8fa8a2aea6a3e1aca0a2">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-info">Manager</span></td>
                                            <td class="text-end"><a href="#"
                                                    class="btn btn-link-danger">Resend</a> <span
                                                    class="badge bg-light-success">Invited</span></td>
                                            <td class="text-end"><a href="#"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-5.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Agnes McGee</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="630b06010223040e020a0f4d000c0e">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-warning">Staff</span></td>
                                            <td class="text-end"><span class="badge bg-success">Joined</span>
                                            </td>
                                            <td class="text-end"><a href="#"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-end btn-page">
                            <div class="btn btn-link-danger">Cancel</div>
                            <div class="btn btn-primary">Update Profile</div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile-6" role="tabpanel" aria-labelledby="profile-tab-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Email Settings</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-4">Setup Email Notification</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Email Notification</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Send Copy To Personal Email</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Updates from System Notification</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-4">Email you with?</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">News about PCT-themes products and
                                                feature updates</p>
                                        </div>
                                        <div class="form-check p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Tips on getting more out of PCT-themes
                                            </p>
                                        </div>
                                        <div class="form-check p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Things you missed since you last logged
                                                into PCT-themes</p>
                                        </div>
                                        <div class="form-check p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch"></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">News about products and other services
                                            </p>
                                        </div>
                                        <div class="form-check p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch"></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Tips and Document business products</p>
                                        </div>
                                        <div class="form-check p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Activity Related Emails</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-4">When to email?</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Have new notifications</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">You're sent a direct message</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch"></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Someone adds you as a connection</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                    <hr class="my-4 border border-secondary-subtle">
                                    <h6 class="mb-4">When to escalate emails?</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Upon new order</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">New membership approval</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch"></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Member registration</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end btn-page">
                            <div class="btn btn-outline-secondary">Cancel</div>
                            <div class="btn btn-primary">Update Profile</div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- [ sample-page ] end -->
    </div><!-- [ Main Content ] end -->
@endsection
