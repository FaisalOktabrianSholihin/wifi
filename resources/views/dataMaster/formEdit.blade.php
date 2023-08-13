@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Tambah Data</h4>
                    <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                    </div>
                    <div class="card-body">
                      <form action="{{  route('dataMaster.save') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Nama Lengkap</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                              class="form-control"
                              id="namaUser"
                              name="namaUser"
                              value="{{ isset($user) ? $user->namaUser : '' }}"
                              placeholder="Nama Lengkap"
                              aria-label="John Doe"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-email">Email</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                            <input
                              type="text"
                              id="emailUser"
                              name="emailUser"
                              value="{{ isset($user) ? $user->emailUser : '' }}"
                              class="form-control"
                              placeholder="faisal22"
                              aria-label="faisal"
                              aria-describedby="basic-icon-default-email2"
                            />
                            <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                          </div>
                          <div class="form-text">Anda dapat menggunakan huruf, angka & titik</div>
                        </div>
                        <div class="mb-3">

                          <label class="form-label" for="basic-icon-default-fullname">Role</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <div class="btn-group ">
                              <select class="form-select" name="idposisi" id="idposisi">
                                <option value="" selected disabled hidden>Pilih</option>
                                <option value="Super Admin">Super Admin</option>
                                <option value="Admin">Admin</option>
                                <option value="Operator">Operator</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Password</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                              class="form-control"
                              id="passwordUser"
                              name="passwordUser"
                              placeholder="Password"
                              aria-label="John Doe"
                              aria-describedby="basic-icon-default-fullname2"
                            />
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary ">Tambah</button>
                      </form>
                    </div>
                  </div>
                </div>
</div>
@endsection