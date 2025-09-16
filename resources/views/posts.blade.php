<h1>Halaman Blog</h1>
@foreach ($posts as $post)
    <article>
        <h2>
            <a href="/posts/{{ $post['slug'] }}">{{ $post['title'] }}</a>
        </h2>
        <p>By: {{ $post['author'] }}</p>
        <p>{{ $post['body'] }}</p>
    </article>
@endforeach