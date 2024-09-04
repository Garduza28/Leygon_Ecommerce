@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
<br>

 {{-- Muestra los comentarios existentes --}}
 @if ($comments->count() > 0)
 <h3 class="font-weight-bold">Comentarios anteriores:</h3>
 <ul>
     @foreach ($comments as $comment)
         <li style="color: black">
             Comentario {{ $loop->iteration }}:
             {{ $comment->comment }}
         </li>
     @endforeach
     @foreach($comments as $comment)
    <p>{{ $comment->body }}</p>
@endforeach
 </ul>
@else
 <p>No hay comentarios aún.</p>
@endif
</div>
@endsection
