<?php get_header() ?>

<div class="page-content max-w-[1240px] w-full  px-4 ">
<?php
if(have_posts()):while(have_posts()):
    the_post();
  the_title();  
endwhile;
endif;
?> 
<div class="aaa">
  asdasdasd
</div>
  front page 
</div>


<?php get_footer() ?>

