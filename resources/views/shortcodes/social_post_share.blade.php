<div class="social-wrapper " data-info="social-share">
    <ul class="socials">
        {{-- Facebook --}}
        <li class="social-share-facebook">
            <a href="http://www.facebook.com/sharer.php?u={!!$ele_permalink!!}&t={!!$ele_title!!}" target="blank" aria-label="Facebook Share" title="Facebook Share" rel="noopener nofollow">
                <i class="fab fa-facebook-f"></i>
            </a>
        </li>
        {{-- Twitter --}}
        <li class="social-share-twitter">
            <a class="twitter" href="https://twitter.com/intent/tweet?original_referer={{$ele_permalink}}&text={{$ele_title}}&tw_p=tweetbutton&url={!!$ele_permalink!!}{!!isset( $twitter_user ) ? '&via=' . $twitter_user : '' !!}" target="_blank" aria-label="Twitter Share" title="Twitter Share" rel="noopener nofollow">
                <i class="fab fa-twitter"></i>
            </a>
        </li>
        {{-- LinkedIn --}}
        <li class="social-share-linkedin">
            <a href="http://www.linkedin.com/shareArticle?mini=true&url={!!$ele_permalink!!}" target="_blank" aria-label="Linkedin Share" title="Linkedin Share" rel="noopener nofollow">
                <i class="fab fa-linkedin"></i>
            </a> 
        </li>
        {{-- Pinterest --}}
        <li class="social-share-pinterest">
            <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" aria-label="Pinterest Share" title="Pinterest Share" rel="noopener nofollow">
                <i class="fab fa-pinterest"></i>
            </a>
        </li>
        {{-- Rreddit --}}
        <li class="social-share-reddit">
            <a href="http://reddit.com/submit?url={!!$ele_permalink!!}" target="_blank" aria-label="Reddit Share" title="Reddit Share" rel="noopener nofollow">
                <i class="fab fa-reddit"></i>
            </a> 
        </li>
        {{-- WhatsApp --}}
        <li class="social-share-whatsapp">
            <a href="https://api.whatsapp.com/send?text={!! $ele_title !!} Click Here-> {!!$ele_permalink!!}" target="_blank" aria-label="Whatsapp Share" title="Whatsapp Share" rel="noopener nofollow">
                <i class="fab fa-whatsapp"></i>
            </a> 
        </li>
        {{-- Telegram --}}
        <li class="social-share-telegram">
            <a href="https://t.me/share/url?url={!!$ele_permalink!!}" target="_blank" aria-label="Telegram Share" title="Telegram Share" rel="noopener nofollow">
                <i class="fab fa-telegram"></i>
            </a> 
        </li>
        {{-- Tumblr --}}
        <li class="social-share-tumblr">
            <a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl={!!$ele_permalink!!}" target="_blank" aria-label="Tumblr Share" title="Tumblr Share" rel="noopener nofollow">
                <i class="fab fa-tumblr"></i>
            </a> 
        </li>
        {{-- share-mix --}}
        <li class="social-share-mix">
            <a href="https://mix.com/add?url={!!$ele_permalink!!}" target="_blank" aria-label="Mix Share" title="Mix Share" rel="noopener nofollow">
                <i class="fab fa-mixcloud"></i>
            </a> 
        </li>
    </ul>
</div>