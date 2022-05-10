@if($fuel_figures->count() > 0)
  {{-- Modal Button --}}
  <div class="row">
    <div class="col">
      <div class="card p-0 mb-2 border-0">
        <button type="button" class="btn btn-sm btn-warning text-black" data-toggle="modal" data-target="#fuel_calc">
          <b>Fuel Calculator</b>
          <i class="fas fa-gas-pump ml-1 mr-1"></i>
        </button>
      </div>
    </div>
  </div>

  {{-- Modal Body --}}
  <div class="modal" id="fuel_calc" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="Fuel Calculator" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content shadow-none p-0" style="border-radius: 5px;">
        <div class="modal-header card-header border-1 p-1">
          <h5 class="m-1 p-0">Fuel Calculator</h5>
          <span class="close m-1 p-0">
            <i class="fas fa-times-circle" title="Close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></i>
          </span>
        </div>
        <div class="modal-body border-1 p-1">
          <form class="form-group" id="fuelcalculator">
            <div class="row row-cols-3 mb-1">
                <div class="col">
                  <label for="icao_type">ICAO Type</label>
                  <select id="icao_type" class="form-control select2" style="width: 100%">
                    @foreach($fuel_figures as $ff)
                      <option value="{{ $ff->icao.'#'.$ff->avg_fuel }}">{{ $ff->icao }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col">
                  <label for="flight_time">Flight Time (minutes)</label>
                  <input id="flight_time" type="number" class="form-control form-control-sm" maxlength="4"/>
                </div>
                <div class="col">
                  <label for="avg_fuel">Avg. Consumption (per minute)</label>
                  <div class="input-group">
                    <input id="avg_fuel" type="text" class="form-control form-control-sm" disabled/>
                    @if($metric)
                      <input id="avg_fuel_kg" type="text" class="form-control form-control-sm" disabled/>
                    @endif
                  </div>
                </div>
            </div>
            <div class="row row-cols-3 mb-1">
              <div class="col">
                <label for="fuel_burn">Fuel Burn</label>
                <input id="fuel_burn" type="text" class="form-control form-control-sm" disabled/>
              </div>
              <div class="col">
                <label for="fuel_reserve">Reserve (30 mins)</label>
                <input id="fuel_reserve" type="text" class="form-control form-control-sm" disabled/>
              </div>
              <div class="col">
                <label for="fuel_total">Total Required</label>
                <input id="fuel_total" type="text" class="form-control form-control-sm" disabled/>
              </div>
            </div>
            @if($metric)
              <div class="row row-cols-3 mb-0">
                <div class="col">
                  <input id="fuel_burn_kg" type="text" class="form-control form-control-sm" disabled/>
                </div>
                <div class="col">
                  <input id="fuel_reserve_kg" type="text" class="form-control form-control-sm" disabled/>
                </div>
                <div class="col">
                  <input id="fuel_total_kg" type="text" class="form-control form-control-sm" disabled/>
                </div>
              </div>
            @endif
          </form>
        </div>
        <div class="modal-footer card-header p-1 text-right">
          <button type="button" class="btn btn-sm btn-warning text-black" id="calc_button" onclick="FuelCalculator()">
            <b>Calculate</b>
            <i class="fas fa-gas-pump ml-1 mr-1" style="color: black;"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  {{-- Fuel Calculator Script --}}
  <script type="text/javascript">
    function FuelCalculator() {
      var selected = document.getElementById('icao_type').value.split('#') ;
      var icao = selected[0];
      var fuel = Number(selected[1] / 60);
      var flight_time = Number(document.getElementById('flight_time').value);
      metric = {{ $metric }};
      // Calculate
      if (flight_time > 0) {
        var fuel_burn = Math.round(fuel * flight_time);
        var fuel_reserve = Math.round(fuel * 30);
        var fuel_total = Math.round(fuel_burn + fuel_reserve);
        // Display Results (Imperial)
        document.getElementById('fuel_burn').value = String(fuel_burn) + ' lbs';
        document.getElementById('fuel_reserve').value = String(fuel_reserve) + ' lbs';
        document.getElementById('fuel_total').value = String(fuel_total) + ' lbs';
        document.getElementById('avg_fuel').value = String(Number(fuel).toFixed(2)) + ' lbs';
      }
      if (metric === 1 && flight_time > 0) {
        fuel_kg = fuel / 2.20462262185;
        var fuel_burn_kg = Math.round(fuel_kg * flight_time);
        var fuel_reserve_kg = Math.round(fuel_kg * 30);
        var fuel_total_kg = Math.round(fuel_burn_kg + fuel_reserve_kg);
        // Display Result (Metric)
        document.getElementById('fuel_burn_kg').value = String(fuel_burn_kg) + ' kgs';
        document.getElementById('fuel_reserve_kg').value = String(fuel_reserve_kg) + ' kgs';
        document.getElementById('fuel_total_kg').value = String(fuel_total_kg) + ' kgs';
        document.getElementById('avg_fuel_kg').value = String(Number(fuel_kg).toFixed(2)) + ' kgs';
      }
    }
  </script>
@endif