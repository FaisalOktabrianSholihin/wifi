@extends('layouts.app')

@push('styles')
    <link href="{{ asset('vendor/file-manager/css/file-manager.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">File Manager</h4>
          <div class="container">
            <div class="row">
              <div class="col-md-12" id="fm-main-block">
                <div style="height: 600px;">
                  <div id="fm"></div>
              </div>
              </div>
            </div>
          </div>
        <!-- File manager -->
        <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // document.getElementById('fm-main-block').setAttribute('style','height:'+window.innerHeight+'px');
                fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
                    window.opener.fmSetLink(fileUrl);
                    window.close();
                });
            });
        </script>
      </div>
    </div>
@endsection
