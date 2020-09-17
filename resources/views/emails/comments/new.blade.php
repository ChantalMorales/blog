@component('mail::message')
    # Hola!
    ## Tu artículo ha recibido nuevo comentario.
    {{$comment->text}}
    ![Imagen del Artículo]({{asset('storage/' . $comment->article->image)}}"Imagen")
    @component('mail::button', ['url' => URL::to('/')])
        Mira tu artículo aquí
    @endcomponent
    @component('mail::panel')
        This is the panel content.
    @endcomponent
    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
