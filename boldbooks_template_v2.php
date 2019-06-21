<?php /* Template Name: boldbooks-template-v2 */ ?>

<?php get_header(); ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php // Wordpress post checkage

			while ( have_posts() ) : the_post();


			echo '<h1 class="leme-main-title">' . $post->post_title . '</h1>';
			echo '<h5 class="leme-main-meta">' . the_author_meta('display_name', $post->post_author) . $post->post_date . '</h5>';
			echo '<div class="leme-main-content">' . $post->post_content . '</div>';
			
			// Criteria of comments to get
			$post_comments = array(
				'post_id' => $post->ID,
				'status' => 'approve',
			);

			$comments = get_comments($post_comments);

			$comments = array_reverse($comments); // Reverse the array so that the oldest comment is first
			foreach ($comments as $comment) {
				echo '<div class="container"><div><h3> Brukernavn: ' . $comment->comment_author . '</h3> <h5> ' . $comment->comment_date . 
				'</h5></div><div><h4>Kommentar: </h4><p class="leme-comment-text">' . $comment->comment_content . '</p></div><br /></div>';
			};
			endwhile; 
			?>

		<?php 
			// Comment data to store
			$commentdata = array(
				'comment_author' => $_POST['your_name'],
				'comment_content'=> $_POST['comments'],
				'comment_post_ID' => $post ->ID,
			);
			// Form submitz
			if(isset($_POST['submit'])){
				$flag=1;
				// Some form validation
				if($_POST['your_name']=='' || !preg_match('/[a-zA-Z_x7f-xff][a-zA-Z0-9_x7f-xff]*/', $_POST['your_name'])) {
					$flag=0; 
					echo '<h4 class="leme-form-alert">Vennligst fyll ut ditt Brukernavn</h4><br>'; 
				} 
				if($_POST['comments']=='')
				{
					$flag=0;
					echo '<h4 class="leme-form-alert">Vennligst kommenter</h4>';
				}

				if($flag==1) { 
					$comment_id = wp_new_comment($commentdata);
					echo "Done the Deed"; 
				}
			}
		?>
			<form class="leme-comment-form" name="contact-form" action="" method="post" id="contact-form">
				<div class="form-group">
					<label for="Brukernavn">Brukernavn</label>
					<div>
						<input type="text" class="form-control" name="your_name" placeholder="Brukernavn" required>
					</div>
				</div>
				<div class="form-group">
					<label for="Kommentar">Kommentar</label>
					<textarea name="comments" class="form-control" rows="4" cols="28"  placeholder="Kommentar"></textarea> 
				</div>
				<div>
					<button type="submit" class="btn btn-primary" name="submit" value="Submit" id="submit_form">Legg igjen en kommentar</button>
				</div>
			</form>
		</main><!-- #main -->
	</section><!-- #primary -->