@extends('layouts.app')
@section('content')
<div class="content">
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Setting</h4>
    <div class="col-xl-12">
      <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3" role="tablist">
          <li class="nav-item">
            <button
              type="button"
              class="nav-link active"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#navs-pills-top-home"
              aria-controls="navs-pills-top-home"
              aria-selected="true"
            >
              Information
            </button>
          </li>
          <li class="nav-item">
            <button
              type="button"
              class="nav-link"
              role="tab"
              data-bs-toggle="tab"
              data-bs-target="#navs-pills-top-profile"
              aria-controls="navs-pills-top-profile"
              aria-selected="false"
            >
              Contact
            </button>
          </li>
        </ul>
        <div class="tab-content" style="min-height: 600px">
          <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
            <div class="form-grid">
              <p class="mt-1" style="font-weight: bold; width: 150px">Short Name</p>
              <input
                type="text"
                class="form-control"
                id="defaultFormControlInput"
                placeholder="John Doe"
                aria-describedby="defaultFormControlHelp"
              />
            </div>
            <div class="form-grid mt-2">
              <p class="mt-1" style="font-weight: bold; width: 150px"> Name</p>
              <input
                type="text"
                class="form-control"
                id="defaultFormControlInput"
                placeholder="John Doe"
                aria-describedby="defaultFormControlHelp"
              />
            </div>
          </div>
          <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
            <div class="form-grid mt-2">
              <p class="mt-1" style="font-weight: bold; width: 150px"> Map Location</p>
              <textarea
                class="form-control"
                id="FormTextArea"
                rows="3"
              ></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection