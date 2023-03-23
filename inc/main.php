<div class="wp-cat-filter_continer">
  <div class="wp-cat-loading" style=" display: flex;">
    <img src="<?php echo plugin_dir_url( __FILE__ ) ."loding.svg"?>" alt="">
  </div>
  <div class="filter_tabs">
  <button style="background-color : #121212; color: #f7f7f7 ;" class="button-23 tabsfilter" data-tabs_id="all">All</button>
  </div>
  <div class="post_grid">
  </div>
</div>
<template data-grid-item-templte>
<div class="post_item" data-tabs_id>
      <div class="post_img">
        <img src="http://127.0.0.1/port/wp-content/uploads/2023/03/maxresdefault.jpg" alt="" />
      </div>
      <div class="post_content">
        <div class="title_des">
          <h1 id="title">Post title</h1>
          <h1 id="title_des">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex,
            mollitia.
          </h1>
          <h1 id="wp-cat-categories" style="font-size : 1.08rem;">cat : [1,2,3,4,5]</h1>
        </div>
        <div class="readmore">
          <a href="#" class="button-23 readmorebutton">Read More</a>
        </div>
      </div>
    </div>
</template>