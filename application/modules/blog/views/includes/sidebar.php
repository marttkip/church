<?php
$recent_query = $this->blog_model->get_recent_posts();
$recent_posts ='';
if($recent_query->num_rows() > 0)
{
	$row = $recent_query->row();
	
	$post_id = $row->post_id;
	$post_title = $row->post_title;
	$web_name = $this->site_model->create_web_name($post_title);
	$image = base_url().'assets/images/posts/thumbnail_'.$row->post_image;
	$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
	$description = $row->post_content;
	$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 50));
	
	$recent_posts = '
		<h6>Medical Alert - Jan 5, 2014</h6>
            
		<div class="pm-sidebar-padding">
		
			<p><strong>'.$post_title.'</strong></p>
		
			<p>'.$mini_desc.'</p>
			<a href="'.site_url().'blog/view-single/'.$web_name.'" class="pm-sidebar-link">Read More <i class="fa fa-plus"></i></a>
		
		</div>
	';

}

else
{
	$recent_posts = 'No posts yet';
}

$categories_query = $this->blog_model->get_all_active_category_parents();
$categories = '';
if($categories_query->num_rows() > 0)
{

	foreach($categories_query->result() as $res)
	{
		$category_id = $res->blog_category_id;
		$category_name = $res->blog_category_name;
		$web_name = $this->site_model->create_web_name($category_name);
		
		$children_query = $this->blog_model->get_all_active_category_children($category_id);
		
		//if there are children
		$categories .= '<li><a href="'.site_url().'blog/category/'.$web_name.'">'.$category_name.'</a> (2)</li>';
	}
}

else
{
	$categories = 'No Categories';
}
$popular_query = $this->blog_model->get_popular_posts();

if($popular_query->num_rows() > 0)
{
	$popular_posts = '';
	
	foreach ($popular_query->result() as $row)
	{
		$post_id = $row->post_id;
		$post_title = $row->post_title;
		$web_name = $this->site_model->create_web_name($post_title);
		$image = base_url().'assets/images/posts/thumbnail_'.$row->post_image;
		$comments = $this->users_model->count_items('post_comment', 'post_id = '.$post_id);
		$description = $row->post_content;
		$mini_desc = implode(' ', array_slice(explode(' ', $description), 0, 10));
		$created = date('jS M Y',strtotime($row->created));
		
		$popular_posts .= '
			<li>
				<div class="pm-recent-blog-post-thumb" style="background-image:url('.$image.');"></div>
				<div class="pm-recent-blog-post-details">
					<a href="'.site_url().'blog/view-single/'.$web_name.'">'.$mini_desc.'</a>
					<p class="pm-date">'.$created.'</p>
				</div>
			</li>
		';
	}
}

else
{
	$popular_posts = 'No posts views yet';
}
?>

<div class="widget sidebar-widget widget_categories">
	<h3 class="widgettitle">Post Categories</h3>
		<ul>
			<?php echo $categories;?>
		</ul>
</div>