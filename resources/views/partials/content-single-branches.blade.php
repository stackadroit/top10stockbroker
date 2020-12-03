<article @php post_class() @endphp>
  @php 
    $brokerObj =get_the_terms(get_the_ID(),'brokers');
         
         $cBroker ='';
         if($brokerObj && is_array($brokerObj)){
            // $parentObj= get_term_by('id',$brokerObj[0]->parent,'brokers');
            // if($parentObj){
            // }
                $cBroker = $brokerObj[0]->parent;
                $clocation = $brokerObj[0]->term_id;
         }
        
       @endphp
       <input type="hidden" value="{!! $cBroker !!}" id="cBroker" />
  <header>
    <h1 class="entry-title">{!! get_the_title() !!}</h1>
   <!--  @include('partials/entry-meta') -->
  </header>
  <div class="entry-content">
    @php 
 
    the_content() @endphp
  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'stockadroit'), 'after' => '</p></nav>']) !!}
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
