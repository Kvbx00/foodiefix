<div class="container">
    <h1>Edytuj profil użytkownika</h1>
    <form method="POST" action="{{ route('administrator.updateUserHealthData', $healthData->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="weight">Waga</label>
            <select name="weight" id="weight" class="form-control">
                @for ($i = 30; $i <= 200; $i++)
                    <option value="{{ $i }}" {{ $healthData->weight == $i ? 'selected' : '' }}>{{ $i }}
                        kg
                    </option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="diastolicBloodPressure">Rozkurczowe ciśnienie krwi</label>
            <select name="diastolicBloodPressure" id="diastolicBloodPressure" class="form-control">
                @for ($i = 70; $i <= 160; $i++)
                    <option
                        value="{{ $i }}" {{ $healthData->diastolicBloodPressure == $i ? 'selected' : '' }}>{{ $i }}
                        mmHG
                    </option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="systolicBloodPressure">Skurczowe ciśnienie krwi</label>
            <select name="systolicBloodPressure" id="systolicBloodPressure" class="form-control">
                @for ($i = 50; $i <= 110; $i++)
                    <option
                        value="{{ $i }}" {{ $healthData->systolicBloodPressure == $i ? 'selected' : '' }}>{{ $i }}
                        mmHG
                    </option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="pulse">Puls</label>
            <select name="pulse" id="pulse" class="form-control">
                @for ($i = 40; $i <= 100; $i++)
                    <option
                        value="{{ $i }}" {{ $healthData->pulse == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
    </form>
</div>
