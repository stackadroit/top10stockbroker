@php the_content() @endphp
{!! do_shortcode(' [socialPostShare] ') !!}
{!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'stockadroit'), 'after' => '</p></nav>']) !!}
@php comments_template('/partials/comments.blade.php') @endphp