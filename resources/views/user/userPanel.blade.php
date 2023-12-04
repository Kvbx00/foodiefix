<!doctype html>
<html lang="pl">

@include('includes.head')
<link rel="stylesheet" href="{{ asset('css/user/userPanel.css') }}">
<body class="pt-5">

@include('includes.header')
@include('includes.success')
@include('includes.error')
<div class="container-fluid">
    <div class="mt-5">
        <div class="row ps-5 pe-5 d-flex justify-content-center">
            <div class="col-12 d-flex justify-content-center mb-2">
                <p class="fw-normal text-center" style="font-size:40px; letter-spacing: 1px">Dane zdrowotne</p>
            </div>
            <div class="card col-md-8 mb-5">
                <canvas class="m-5" id="health-chart"></canvas>
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                <div class="card col-10 d-flex h-100 align-items-center justify-content-center">
                    <form class="col-10" method="POST" action="{{ route('measurements.store') }}">
                        @csrf
                        <div class="d-flex align-items-center justify-content-center mb-2 mt-4">
                            <div class="col-6 d-flex justify-content-center">
                                <label for="weight">Waga</label>
                            </div>
                            <div class="col-6 d-flex justify-content-center">
                                <select name="weight" id="weight" class="select2" data-select-search="true">
                                    @for ($i = 30; $i <= 200; $i++)
                                        <option
                                            value="{{ $i }}" {{ old('weight', $lastValues['weight']) == $i ? 'selected' : '' }}>{{ $i }}
                                            kg
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <div class="col-6 d-flex justify-content-center">
                                <label for="diastolicBloodPressure">Rozkurczowe ciśnienie krwi</label>
                            </div>
                            <div class="col-6 d-flex justify-content-center">
                                <select name="diastolicBloodPressure" id="diastolicBloodPressure" class="select2"
                                        data-select-search="true">
                                    @for ($i = 70; $i <= 160; $i++)
                                        <option
                                            value="{{ $i }}" {{ old('diastolicBloodPressure', $lastValues['diastolicBloodPressure']) == $i ? 'selected' : '' }}>{{ $i }}
                                            mmHG
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <div class="col-6 d-flex justify-content-center">
                                <label for="systolicBloodPressure">Skurczowe ciśnienie krwi</label>
                            </div>
                            <div class="col-6 d-flex justify-content-center">
                                <select name="systolicBloodPressure" id="systolicBloodPressure" class="select2"
                                        data-select-search="true">
                                    @for ($i = 50; $i <= 110; $i++)
                                        <option
                                            value="{{ $i }}" {{ old('systolicBloodPressure', $lastValues['systolicBloodPressure']) == $i ? 'selected' : '' }}>{{ $i }}
                                            mmHG
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="col-6 d-flex justify-content-center">
                                <label for="pulse">Puls</label>
                            </div>
                            <div class="col-6 d-flex justify-content-center">
                                <select name="pulse" id="pulse" class="select2" data-select-search="true">
                                    @for ($i = 40; $i <= 100; $i++)
                                        <option
                                            value="{{ $i }}" {{ old('pulse', $lastValues['pulse']) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end pt-3 mb-4">
                            <button class="btn btn-dark btn-block" type="submit"
                                    style="background-color: #6FAD55; border: none">Zapisz
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6 d-flex align-items-center justify-content-center" id="health-table">
                <div class="table-responsive card d-flex col-10">
                    <table class="table table-borderless text-center">
                        <thead>
                        <tr class="d-flex">
                            <th class="col-2">Data</th>
                            <th class="col-2">Waga</th>
                            <th class="col-3">Ciśnienie roz.</th>
                            <th class="col-3">Ciśnienie skur.</th>
                            <th class="col-2">Puls</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($userMeasurements as $measurement)
                            <tr class="d-flex">
                                <td class="col-2">{{ $measurement->date }}</td>
                                <td class="col-2">{{ $measurement->weight }}</td>
                                <td class="col-3">{{ $measurement->diastolicBloodPressure }}</td>
                                <td class="col-3">{{ $measurement->systolicBloodPressure }}</td>
                                <td class="col-2">{{ $measurement->pulse }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pagination d-flex justify-content-center mb-3">
                        @if ($userMeasurements->onFirstPage())
                            <span>&laquo;</span>
                            <span>&lsaquo;</span>
                        @else
                            <a href="{{ $userMeasurements->url(1) }}">&laquo;</a>
                            <a href="{{ $userMeasurements->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                        @endif

                        <span
                            class="pagination-middle">{{ $userMeasurements->currentPage() }} z {{ $userMeasurements->lastPage() }}</span>

                        @if ($userMeasurements->hasMorePages())
                            <a href="{{ $userMeasurements->nextPageUrl() }}" rel="next">&rsaquo;</a>
                            <a href="{{ $userMeasurements->url($userMeasurements->lastPage()) }}">&raquo;</a>
                        @else
                            <span>&rsaquo;</span>
                            <span>&raquo;</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <hr class="m-5" style="color: rgba(0, 0, 0, .2);">
    </div>
</div>

<div class="container">
    <div class="row px-5 justify-content-center">

        <div class="col-12 d-flex justify-content-center mb-2">
            <p class="fw-normal text-center" style="font-size:40px; letter-spacing: 1px">Choroby</p>
        </div>

        <div class="card py-5">
            <div class="row my-3 align-items-center">
                <div class="col-md-6 mb-5 mb-md-0 d-flex flex-column align-items-center">
                    @if (auth()->user()->diseases->count() < 3)
                        <div>
                            <p class="fw-normal text-center" style="font-size:30px; letter-spacing: 1px">Dostępne
                                choroby</p>
                        </div>
                        <form method="post" action="{{ route('diseases.store') }}">
                            <div class="mt-3">
                                @csrf
                                <select name="diseases_id" id="disease_name" class="select2" style="width: 180px">
                                    @foreach($availableDiseases as $disease)
                                        <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-dark btn-block ms-3" type="submit"
                                        style="background-color: #6FAD55; border: none">Zapisz
                                </button>
                            </div>
                        </form>
                    @else
                        <p>Osiągnąłeś limit wybranych chorób (maksymalnie 3).</p>
                    @endif
                </div>
                <div class="col-md-6 d-flex flex-column align-items-center">
                    <div>
                        <p class="fw-normal text-center" style="font-size:30px; letter-spacing: 1px">Twoje
                            choroby</p>
                    </div>
                    <div>
                        @if(auth()->check() && auth()->user()->diseases->count() > 0)
                            @foreach(auth()->user()->diseases as $userDisease)
                                <div class="d-flex flex-row mt-3 justify-content-between align-items-center">
                                    &#x2022; {{ $userDisease->name }}
                                    <form action="{{ route('diseases.destroy', $userDisease->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-dark btn-block ms-5" type="submit"
                                                style="background-color: #FF0A54; border: none">Usuń
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        @else
                            <p>Brak przypisanych chorób.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="m-5" style="color: rgba(0, 0, 0, .2);">

    <div class="row px-5 justify-content-center">

        <div class="col-12 d-flex justify-content-center mb-2">
            <p class="fw-normal text-center" style="font-size:40px; letter-spacing: 1px">Preferencje składników</p>
        </div>

        <div class="card py-5">
            <div class="row my-3 align-items-center">
                <div class="col-md-6 mb-5 mb-md-0 d-flex flex-column align-items-center">
                    @if (auth()->user()->ingredientPreferences->count() < 3)
                        <div>
                            <p class="fw-normal text-center" style="font-size:30px; letter-spacing: 1px">Dostępne
                                składniki</p>
                        </div>
                        <form method="post" action="{{ route('ingredients.store') }}">
                            <div class="mt-3">
                                @csrf
                                <select name="ingredient_id" id="ingredient_name" class="select2" style="width: 180px">
                                    @foreach($availableIngredients as $ingredient)
                                        <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-dark btn-block ms-3" type="submit"
                                        style="background-color: #6FAD55; border: none">Zapisz
                                </button>
                            </div>
                        </form>
                    @else
                        <p>Osiągnąłeś limit wybranych składników (maksymalnie 3).</p>
                    @endif
                </div>
                <div class="col-md-6 d-flex flex-column align-items-center">
                    <div>
                        <p class="fw-normal text-center" style="font-size:30px; letter-spacing: 1px">Wybrane
                            składniki</p>
                    </div>
                    <div>
                        @if(auth()->check() && auth()->user()->ingredientPreferences->count() > 0)
                            @foreach(auth()->user()->ingredientPreferences as $userIngredient)
                                <div class="d-flex flex-row mt-3 justify-content-between align-items-center">
                                    &#x2022; {{ $userIngredient->name }}
                                    <form action="{{ route('ingredients.destroy', $userIngredient->id) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-dark btn-block ms-5" type="submit"
                                                style="background-color: #FF0A54; border: none">Usuń
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        @else
                            <p>Brak przypisanych składników.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#weight').select2();
        $('#diastolicBloodPressure').select2();
        $('#systolicBloodPressure').select2();
        $('#pulse').select2();
        $('#disease_name').select2();
        $('#ingredient_name').select2();
    });

    $(document).ready(function () {
        $(".select2").select2({'allowClear': false});
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('health-chart');
    const chartData = @json($chartData);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Ciśnienie rozkurczowe',
                data: chartData.diastolicBloodPressure,
                borderColor: 'rgba(249, 220, 92, 1)',
                backgroundColor: 'rgba(249, 220, 92, 0.5)',
                fill: false,
                pointStyle: 'circle',
                pointRadius: 5,
                pointHoverRadius: 10,
            }, {
                label: 'Ciśnienie skurczowe',
                data: chartData.systolicBloodPressure,
                borderColor: 'rgba(79, 214, 109, 1)',
                backgroundColor: 'rgba(79, 214, 109, 0.5)',
                fill: false,
                pointStyle: 'circle',
                pointRadius: 5,
                pointHoverRadius: 10,
            }, {
                label: 'Waga',
                data: chartData.weight,
                borderColor: 'rgba(72, 202, 228, 1)',
                backgroundColor: 'rgba(72, 202, 228, 0.5)',
                fill: false,
                pointStyle: 'circle',
                pointRadius: 5,
                pointHoverRadius: 10,
            }, {
                label: 'Puls',
                data: chartData.pulse,
                borderColor: 'rgba(255, 10, 84, 1)',
                backgroundColor: 'rgba(255, 10, 84, 0.5)',
                fill: false,
                pointStyle: 'circle',
                pointRadius: 5,
                pointHoverRadius: 10,
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        padding: 25,
                        usePointStyle: true,
                    },
                    position: 'bottom',
                }
            }
        }
    });
</script>

