<!doctype html>
<html lang="pl">

@include('includes.head')

<body>

@include('includes.admin-header')

<div class="container-fluid">
    @include('includes.error')

    <div class="row">

        @include('includes.admin-sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edycja danych zdrowotnych użytkownika</h1>
            </div>

                <form method="POST" action="{{ route('administrator.updateUserHealthData', $healthData->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 align-items-center">
                        <div class="input">
                            <label for="weight" class="col-form-label">Waga</label>
                            <select name="weight" id="weight" class="form-control">
                                @for ($i = 30; $i <= 200; $i++)
                                    <option value="{{ $i }}" {{ $healthData->weight == $i ? 'selected' : '' }}>{{ $i }}
                                        kg
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="input">
                            <label for="diastolicBloodPressure" class="col-form-label">Rozkurczowe ciśnienie krwi</label>
                            <select name="diastolicBloodPressure" id="diastolicBloodPressure" class="form-control">
                                @for ($i = 70; $i <= 160; $i++)
                                    <option
                                        value="{{ $i }}" {{ $healthData->diastolicBloodPressure == $i ? 'selected' : '' }}>{{ $i }}
                                        mmHG
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="input">
                            <label for="systolicBloodPressure" class="col-form-label">Skurczowe ciśnienie krwi</label>
                            <select name="systolicBloodPressure" id="systolicBloodPressure" class="form-control">
                                @for ($i = 50; $i <= 110; $i++)
                                    <option
                                        value="{{ $i }}" {{ $healthData->systolicBloodPressure == $i ? 'selected' : '' }}>{{ $i }}
                                        mmHG
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="input">
                            <label for="pulse" class="col-form-label">Puls</label>
                            <select name="pulse" id="pulse" class="form-control">
                                @for ($i = 40; $i <= 100; $i++)
                                    <option
                                        value="{{ $i }}" {{ $healthData->pulse == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary my-3">Zapisz zmiany</button>
                </form>

        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#weight').select2();
        $('#diastolicBloodPressure').select2();
        $('#systolicBloodPressure').select2();
        $('#pulse').select2();
    });
</script>
<style>
    .input {
        width: 400px;
    }

    .select2-selection {
        border: none !important;
    }

    .select2 {
        width: 100% !important;
        padding: 0.375rem 2.25rem 0.375rem 0 !important;
        -moz-padding-start: calc(0.75rem - 3px) !important;
        font-size: 1rem !important;
        font-weight: 400 !important;
        line-height: 1.5 !important;
        color: #212529 !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 0.25rem !important;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
    }

    .select2-dropdown {
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem !important;
        padding: 0.375rem 0 0.375rem 0.75rem;
    }

    .select2-results__option {
        font-weight: normal !important;
        display: block !important;
        min-height: 1.2em !important;
        padding: 0 2px 1px !important;
    }

    .select2-search {
        background-color: #fff !important;
        -webkit-box-shadow: none !important;
        -moz-box-shadow: none !important;
        box-shadow: none !important;
        border: none !important;
        padding-right: 0.75rem;
    }

    .select2-search__field {
        outline: none !important;
        border: 1px solid #ced4da !important;
        border-radius: 0.25rem !important;
    }

    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #0d6efd !important;
        color: white !important;
    }

    .select2-selection__arrow b{
        display:none !important;
    }
</style>
