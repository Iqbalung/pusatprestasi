<?php
get_header();
$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
if ( isset( $thumb_src ) && ! empty( $thumb_src ) ) :
    $thumb_url = $thumb_src[0];
else :
    $thumb_url = get_template_directory_uri() . '/assets/images/no-image-found.png';
endif;
global $post;
$the_id    = get_the_ID();
$event_start_date      = get_post_meta( $the_id, 'eduvibe_simple_event_start_date', true );
$event_end_date      = get_post_meta( $the_id, 'eduvibe_simple_event_end_date', true );
$event_start_time     = get_post_meta( $the_id, 'eduvibe_simple_event_start_time', true );
$event_end_time      = get_post_meta( $the_id, 'eduvibe_simple_event_end_time', true );
$event_latitude  = get_post_meta( $the_id, 'eduvibe_simple_event_latitude', true );
$event_longitude = get_post_meta( $the_id, 'eduvibe_simple_event_longitude', true );
$event_ongoing_people = get_post_meta( $the_id, 'eduvibe_simple_event_perticipant', true );
$event_price = get_post_meta( $the_id, 'eduvibe_simple_event_price', true );
$event_purchase_link = get_post_meta( $the_id, 'eduvibe_simple_event_purchase_link', true );
$event_location = get_post_meta( $the_id, 'eduvibe_simple_event_location', true );

echo '<div class="eduvibe-simple-event-details">';
	echo '<div class="eduvibe-row">';
		echo '<div class="eduvibe-col-lg-12">';
			echo '<img class="eduvibe-single-event-thumbnail" src="' . esc_url( $thumb_url ) . '" />';
		echo '</div>';
	echo '</div>';

	echo '<div class="eduvibe-row">';
		echo '<div class="eduvibe-col-lg-7">';
			echo '<div class="eduvibe-event-details-content">';
				the_title( '<h1 class="title">', '</h1>' );
				the_content();
			echo '</div>';
		echo '</div>';

		echo '<div class="eduvibe-col-lg-5">';
			echo '<div class="eduvibe-event-details-sidebar">';
				echo '<div class="eduvibe-event-details-info">';
					
					if ( eduvibe_get_config( 'single_event_details_meta', true ) ) :
						echo '<h3 class="eduvibe-single-event-meta-title">' . __( 'Event Detail', 'eduvibe' ) . '</h3>';
						echo '<ul class="eduvibe-single-event-meta-info">';

							if ( $event_start_date ) :
								echo '<li><span><i class="icon-calendar-2-line"></i> ' . __( 'Start Date', 'eduvibe' ) . '</span><span>' . esc_html( $event_start_date ). '</span></li>';
							endif;

							if ( $event_start_time ) :
								echo '<li><span><i class="icon-time-line"></i> ' . __( 'Start Time', 'eduvibe' ) . '</span><span>' . esc_html( $event_start_time ). '</span></li>';
							endif;

							if ( $event_end_date ) :
								echo '<li><span><i class="icon-calendar-2-line"></i> ' . __( 'End Date', 'eduvibe' ) . '</span><span>' . esc_html( $event_end_date ). '</span></li>';
							endif;

							if ( $event_end_time ) :
								echo '<li><span><i class="icon-time-line"></i> ' . __( 'End Time', 'eduvibe' ) . '</span><span>' . esc_html( $event_end_time ). '</span></li>';
							endif;

							if ( $event_ongoing_people ) :
								echo '<li><span><i class="icon-user-line"></i> ' . __( 'Ongoing', 'eduvibe' ) . '</span><span>' . esc_html( $event_ongoing_people ). '</span></li>';
							endif;

							if ( $event_location ) :
								echo '<li><span><i class="icon-map-pin-line"></i> ' . __( 'Location', 'eduvibe' ) . '</span><span>' . esc_html( $event_location ). '</span></li>';
							endif;
							
						echo '</ul>';
					endif;

					if ( eduvibe_get_config( 'single_event_price', true ) ) :
						echo '<div class="eduvibe-event-details-price">';
							echo '<a class="edu-btn btn-bg-alt w-100 text-center" href="#">Price: ' . esc_html( $event_price ) . '</a>';
						echo '</div>';
					endif;

					if ( eduvibe_get_config( 'single_event_booking_button', true ) ) :	
						$book_now_button_text = eduvibe_get_config( 'single_event_booking_button_text', __( 'Book Your Seat Now', 'eduvibe' ) );	
						
						if ( ! empty ( $book_now_button_text ) ) :
							echo '<div class="eduvibe-event-details-purchase">';
								echo '<a class="edu-btn w-100 text-center" href="' . esc_url( $event_purchase_link ). '">' . wp_kses_post( $book_now_button_text ) . '</a>';
							echo '</div>';
						endif;
					endif;

					if ( eduvibe_get_config( 'single_event_social_share', true ) ) :
						echo '<div class="eduvibe-single-event-social-share">';
							echo '<span>' . __( 'Share: ', 'eduvibe' ) . '</span>';
							get_template_part( 'template-parts/social', 'share' );
						echo '</div>';
					endif;
				echo '</div>';

				if ( eduvibe_get_config( 'single_event_google_map', true ) ) :
					if ( ( isset( $event_latitude ) && ! empty( $event_latitude ) ) && ( isset( $event_longitude ) && ! empty( $event_longitude ) ) ) :
						echo '<div class="eduvibe-event-details-map">';
							echo '<h3 class="eduvibe-single-event-meta-title">' . __( 'Map', 'eduvibe' ) . '</h3>';
							echo '<div id="eduvibe-event-contact-map" class="eduvibe-single-event-google-map" data-latitude="' . esc_attr( $event_latitude ) . '" data-longitude="' . esc_attr( $event_longitude ) . '"></div>';
						echo '</div>';
					endif;
				endif;
			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</div>';
get_footer();