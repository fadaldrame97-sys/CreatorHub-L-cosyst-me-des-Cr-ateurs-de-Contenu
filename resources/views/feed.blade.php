<!DOCTYPE html>
<html>
<head>
    <title>Feed</title>
</head>
<body>

<h1>CreatorHub Feed</h1>

@foreach($realisations as $realisation)

<div style="border:1px solid #ddd;padding:20px;margin-bottom:20px">

    <h2>{{ $realisation->title }}</h2>

    <p>{{ $realisation->description }}</p>

    <p>
        <strong>Créateur :</strong>
        {{ $realisation->user->name }}
    </p>

    <p>
        <strong>Media :</strong>
        {{ $realisation->media_url }}
    </p>

    <p>

        <strong>Skills :</strong>

        @foreach($realisation->skills as $skill)

            {{ $skill->name }}

        @endforeach

    </p>

    <p>

        ❤️ {{ $realisation->likes->count() }}

        🔖 {{ $realisation->saves->count() }}

    </p>

</div>

@endforeach

</body>
</html>
