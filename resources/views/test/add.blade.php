@extends('layouts.app')
@section('title', translate('Add Diagnosis & Tests'))
@section('content')
    <section id="basic-horizontal-layouts">
        <section id="multiple-column-form">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">{{ translate('Add Diagnosis & Tests') }}</h4>
                </div>
                <div class="card-body">
                  <form class="form" method="POST">
                      @csrf
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <div class="mb-1">
                          <label class="form-label" for="first-name-column">{{ __('pages.name') }}</label>
                          <input type="text" id="first-name-column" class="form-control" placeholder="{{ __('pages.name') }}" name="name" required>
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="mb-1">
                          <label class="form-label" for="first-name-column">{{ translate('Center') }}</label>
                          <input type="text" id="first-name-column" class="form-control" placeholder="{{ translate('Center') }}" name="center" required>
                        </div>
                      </div>
                      <div class="col-12">
                        <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">{{ __('pages.submit') }}</button>
                        <button type="reset" class="btn btn-outline-secondary waves-effect">{{ __('pages.reset') }}</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
    </section>
@endsection