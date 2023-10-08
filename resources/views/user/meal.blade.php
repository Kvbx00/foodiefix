<h1>{{ $meal->name }}</h1>
Przepis:
<ul>
    @foreach(preg_split("/\d+\./", $meal->recipe, -1, PREG_SPLIT_NO_EMPTY) as $instruction)
        @if(trim($instruction) !== '')
            <li>{{ trim($instruction) }}</li>
        @endif
    @endforeach
</ul>
<p>Wartości odżywcze:</p>
<ul>
    <li>Kalorie: {{ $meal->nutritionalvalues->calories }}</li>
    <li>Białko: {{ $meal->nutritionalvalues->protein }}</li>
    <li>Tłuszcze: {{ $meal->nutritionalvalues->fats }}</li>
    <li>Węglowodany: {{ $meal->nutritionalvalues->carbohydrates }}</li>
</ul>
