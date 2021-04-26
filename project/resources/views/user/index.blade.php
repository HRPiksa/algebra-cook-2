<div class="card">
    <div class="card-header">
        Dobro došli {{Auth::user()->firstname }} {{ Auth::user()->lastname}}, u nastavku se nalaze vaši recepti
    </div>
    <div class="card-body">
        <h5 class="card-title">Osobni podaci:</h5>
        <p class="card-text">
            {{Auth::user()->firstname }} {{ Auth::user()->lastname}}
        </p>
        <p class="card-text">
            Email: {{ Auth::user()->email}}
        </p>
        <hr>
        <a href="{{route('recipes.index')}}" class="btn btn-primary">View recipes</a>
    </div>
</div>