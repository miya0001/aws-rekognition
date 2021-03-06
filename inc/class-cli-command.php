<?php

namespace HM\AWS_Rekognition;

use WP_CLI_Command;

class CLI_Commands extends WP_CLI_Command {

	/**
	 * List rekognition keyworkds for a given attachment.
	 *
	 * @subcommand list-labels-for-attachment <attachment-id>
	 */
	public function list_labels_for_attachment( array $args, array $args_assoc ) {
		print_r( fetch_labels_for_attachment( $args[0] ) );
	}

	/**
	 * Update keywords for attachments.
	 *
	 * @subcommand update-keywords
	 * @synopsis [--attachments=<ids>]
	 */
	public function update_keywords( array $args, array $args_assoc ) {
		if ( isset( $args_assoc['attachments'] ) ) {
			$attachments = explode( ',', $args_assoc['attachments'] );
		} else {
			$attachments = get_posts( [ 'post_type' => 'attachment', 'fields' => 'ids' ] );
		}

		foreach ( $attachments as $attachment ) {
			update_attachment_keywords( $attachment );
		}
	}
}
