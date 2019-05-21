<?php
/**
 * View: List View
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/views/v2/list.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version TBD
 *
 */

$events_label_plural = tribe_get_event_label_plural();

$this->template( 'events-bar' );

$this->template( 'top-bar' );

?>

<div class="tribe-events-calendar-list">

	<?php $this->template( 'list/month-separator', [ 'month' => date( 'M' )] ); ?>

	<?php foreach ( $events as $event ) : ?>

		<?php $this->template( 'list/single-event', [ 'event' => $event ] ); ?>

	<?php endforeach; ?>

</div>

<?php $this->template( 'list/nav' ); ?>