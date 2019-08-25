<?php 

class most_popular_post_widget extends WP_Widget{
	public function __construct(){
		parent:: __construct('most_popular_post_widget', 'Popular Post Widget',array(
          'description'=> 'Shown your most viwes post'
			));
	}

 public	function widget($args,$instance){
  
		  $title=$instance['title'];
		  $post_per_page=$instance['post_per_page'];
		  $displayviews=$instance['displayviews'];
		  $cmtcount=$instance['cmtcount'];
		  $dauthor=$instance['dauthor'];

      $plr_posts = new WP_Query( array(
			"posts_per_page" => $post_per_page,
			"post_type" => "post",
			"meta_key" => "views",
			"orderby" => "meta_value_num",
			"order" => "DESC",
			"ignore_sticky_posts" => true,
		) );

      echo $args['before_widget'];
      echo $args['before_title'];
      echo $title;
        echo $args['after_title'];
 	if ( $plr_posts->have_posts() ) {
			echo '<ul>';
			while ( $plr_posts->have_posts() ) {
				$plr_posts->the_post();
				$count = get_post_meta(get_the_id(),'views', true);
				echo '<div>';
				echo '<a href="'.get_the_permalink().'">';
				echo  get_the_title();
				echo '</a>';
				echo '<br>';
				if($displayviews == 1){
				echo $count. ' views ';}
				if($cmtcount == 1){
				 comments_popup_link( '0 comment', '1 comment', '% comments', 'comments-link', 'Comment off'); echo '&nbsp'; }
				if($dauthor == 1){
				echo the_author_posts_link();}
				echo '</div><br>';
		}
			echo '</ul>';
		} else {
			echo 'Click or visit a post of your website to show it as popular post';
		}
      echo $args['after_widget'];

	}

 public	function form($instance){

 	  if(isset($instance['title'])){
 	  	$title = $instance['title'];
 	  }else{
 	   $title = 'Most Popular Post';
 	  }  

 	  if(isset($instance['post_per_page'])){
 	  	$post_per_page = $instance['post_per_page'];
 	  }else{
 	   $post_per_page = 5;
 	  }  
 
 	if(isset($instance['displayviews'])){
 	  	$displayviews = $instance['displayviews'];
 	  }else{
 	   $displayviews = 0;
 	  }
 	  if(isset($instance['cmtcount'])){
 	  	$cmtcount = $instance['cmtcount'];
 	  }else{
 	   $cmtcount = 0;
 	  } 
 	  if(isset($instance['dauthor'])){
 	  	$dauthor = $instance['dauthor'];
 	  }else{
 	   $dauthor = 0;
 	  }  


 	  
		?>
       <p>
       	<label for="<?php echo $this->get_field_id('title') ?>">Widget Title:</label>
       	<input type="text" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>"
       	value="<?php echo esc_attr ($title); ?>" class="widefat">
       </p>

		<p>
       	<label for="<?php echo $this->get_field_id('post_per_page') ?>">Posts Per Page:</label>
       	<input type="text" id="<?php echo $this->get_field_id('post_per_page') ?>" name="<?php echo $this->get_field_name('post_per_page') ?>"
       	value="<?php echo esc_attr ($post_per_page); ?>" class="widefat">
       </p>

       <p>
       <input type="checkbox" id="<?php echo $this->get_field_id('displayviews') ?>" name="<?php echo $this->get_field_name('displayviews') ?>"
       	value="1" <?php checked($displayviews,1); ?> class="widefat">
       	<label for="<?php echo $this->get_field_id('displayviews') ?>">Display Views Count:</label>
       	</p>

       <p>
       	<input type="checkbox" id="<?php echo $this->get_field_id('cmtcount') ?>" name="<?php echo $this->get_field_name('cmtcount') ?>"
       	value="1" <?php checked($cmtcount,1); ?> class="widefat">
       	<label for="<?php echo $this->get_field_id('cmtcount') ?>">Display Comment Count :</label>
       	</p>

     	  <p>
       	  <input type="checkbox" id="<?php echo $this->get_field_id('dauthor') ?>" name="<?php echo $this->get_field_name('dauthor') ?>"value="1" <?php checked($dauthor,1); ?> class="widefat">
       	<label for="<?php echo $this->get_field_id('dauthor') ?>">Display Author :</label>
       </p>
 
  

		<?php
	}

       public function update($new_instance, $old_instance){
      $instance = array();
      $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
      $instance['post_per_page'] = (!empty($new_instance['post_per_page'])) ? strip_tags($new_instance['post_per_page']) : '';
      $instance['displayviews'] = (!empty($new_instance['displayviews'])) ? strip_tags($new_instance['displayviews']) : '';
      $instance['cmtcount'] = (!empty($new_instance['cmtcount'])) ? strip_tags($new_instance['cmtcount']) : '';
      $instance['dauthor'] = (!empty($new_instance['dauthor'])) ? strip_tags($new_instance['dauthor']) : '';
      
      return $instance;
	 }


}