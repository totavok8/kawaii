{header}
	<!-- Header -->
	{user}
	<div class="header_placeholder" style="background-image: url(<?=base_url('public/img/profile_covers/')?>{profile_cover_url});"></div>
	{/user}
	<header>
		<!-- Header Image -->
		<div class="header_wrapper">
			<!-- Links -->
			<ul class="links">
				<?php if(!empty($logged_in_user)): ?>
					<?php foreach($logged_in_user as $u): ?>
						<div class="user_profile">
							<a href="<?=base_url('profile/'.$u->username)?>">
								<img src="<?=base_url('public/img/profile_images/'.$u->profile_picture_url)?>" width="48" alt="<?=$u->firstname.' '.$u->lastname?>">
								<span><?=$u->username?></span>
							</a>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
				<?php foreach($links as $link): ?>
					<?php if($link->parent_id == 0 ): ?>
						<?php $child_links = $this->link_model->get_links_by_parent_id($link->id) ?>
						<li><a href="<?=$link->address?>"><?php echo $link->name; ?></a>
						<?php if(!empty($child_links)): ?>
							<ul>
								<?php foreach($child_links as $child): ?>
									<a href="<?=$link->address?>"><?php echo $child->name; ?></a>
								<?php endforeach; ?>
							</ul>
						</li>
						<?php else: ?>
						</li>
						<?php endif; ?>
					<?php endif;?>
				<?php endforeach; ?>
				<a class="logo" href="<?=base_url()?>">
					<img height="48" src="{settings}<?=base_url('{logo_url}')?>{/settings}" alt="">
				</a>
			</ul>
			<!-- Title and descriptions -->
			<h1 id="title">
			</h1>
			<h3 id="description">
			</h3>
		</div>
	</header>
	
	<section class="post_details post_details_ grid-noGutter profile_details">
		{user}
		<div class="detail_box empty_box detail_image_box">
			<div class="detail_image_box_placeholder" style="background-image: url(<?=base_url('public/img/profile_images')?>/{profile_picture_url});"></div>
			<div class="detail_image_box_img" style="background-image: url(<?=base_url('public/img/profile_images')?>/{profile_picture_url});"></div>
		</div>
		<div class="detail_box black_box detail_tags">
			<div class="detail_row">
				<span class="detail_column_tag">نام</span>
				<p class="detail_column_content">{firstname}</p>
			</div>
			<div class="detail_row">
				<span class="detail_column_tag">نام خانودادگی</span>
				<p class="detail_column_content">{lastname}</p>
			</div>

			<div class="detail_row">
				<span class="detail_column_tag">نقش</span>
				<p class="detail_column_content">
					
					<?php 
						switch ($user[0]->role) {
						 	case 1:
						 		echo "کاربر معمولی";
						 		break;
						 	case 2:
						 		echo "<i class='fas fa-star' style='color: orange'></i>&nbsp;&nbsp;";
						 		echo "مدیر";
						 		break;
						 	case 3:
						 		echo "کاربر مسدود شده";
						 		break;
						 	default:
						 		break;
						 } 
					 ?>
				</p>
			</div>

			<div class="detail_row">
				<span class="detail_column_tag">تاریخ ثبت نام</span>
				<p class="detail_column_content">
<?php 
$time = strtotime($user[0]->created_at);
$date = date('Y-m-d-H-i-s', $time);
$date_array = explode('-', $date);
$jalali_date = $this->jalalicalendar->gregorian_to_jalali($date_array[0],$date_array[1],$date_array[2]);
echo(implode('/', $jalali_date));
?>
				</p>
			</div>

			<div class="detail_row">
				<span class="detail_column_tag">فصل های خوانده</span>
				<p class="detail_column_content"><?=count($watched_chapters)?></p>
			</div>

		</div>
		{/user}
	</section>





	<section class="post_details descriptions_details grid-noGutter">

		<div class="detail_box black_box">
			<p class="detail_column_content detail_title">آخرین دیده ها</p>
			<ul class="post_chapters">

			<?php foreach($watched_chapters as $wc): ?>
				<li class="">
					<a href="<?=base_url()?><?=$wc['url_slug']?>/<?=$wc['article_id']?>/chapter/<?=$wc['chapter_id']?>">
						<?=$wc['article_name']?> - <?=$wc['name']?>
					</a>
					<span class="post_chapter_date">
						<?php 
$time = strtotime($wc['time']);
$date = date('Y-m-d-H-i-s', $time);
$date_array = explode('-', $date);
$jalali_date = $this->jalalicalendar->gregorian_to_jalali($date_array[0],$date_array[1],$date_array[2]);
echo(implode('/', $jalali_date));
						 ?>
					 </span>
				</li>
			<?php endforeach; ?>
		</div>

		<div class="detail_box black_box">
			<p class="detail_column_content detail_title">آخرین دیدگاه ها</p>
			<ul class="post_chapters">
			<?php foreach($comments as $comment): ?>
				<li class="">
					<a href="<?=base_url()?><?=$comment['url_slug']?>/<?=$comment['article_id']?>">
					<?php echo (strlen($comment['text']) > 100) ? substr($comment['text'], 0, 99) . '...' : $comment['text'] ?>
					</a>
					<span class="post_chapter_date">
						<?php 
$time = strtotime($comment['time']);
$date = date('Y-m-d-H-i-s', $time);
$date_array = explode('-', $date);
$jalali_date = $this->jalalicalendar->gregorian_to_jalali($date_array[0],$date_array[1],$date_array[2]);
echo(implode('/', $jalali_date));
						 ?>
					</span>
				</li>
			<?php endforeach; ?>
		</div>
	</section>








{footer}